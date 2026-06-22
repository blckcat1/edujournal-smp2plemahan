<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manuscript;
use App\Models\Issue;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Notification;
use App\Models\User;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ManuscriptController extends Controller
{
    /**
     * Homepage with stats and latest publications.
     */
    public function home()
    {
        $stats = [
            'articles' => Manuscript::where('status', 'published')->count(),
            'authors' => User::where('role', 'author')->count(),
            'issues' => Issue::where('status', 'published')->count(),
            'publications' => Manuscript::where('status', 'published')->count(),
        ];

        $latestPublications = Manuscript::where('status', 'published')
            ->with(['author', 'issue'])
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        $issues = Issue::where('status', 'published')->orderBy('year', 'desc')->get();

        return view('home', compact('stats', 'latestPublications', 'issues'));
    }

    /**
     * Search page with advanced filters.
     */
    public function search(Request $request)
    {
        $query = Manuscript::where('status', 'published')->with(['author', 'issue']);

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'like', "%$keyword%")
                  ->orWhere('abstract', 'like', "%$keyword%")
                  ->orWhere('keywords', 'like', "%$keyword%");
            });
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('author')) {
            $authorName = $request->author;
            $query->whereHas('author', function($q) use ($authorName) {
                $q->where('name', 'like', "%$authorName%");
            });
        }

        if ($request->filled('doi')) {
            $query->where('doi', 'like', '%' . $request->doi . '%');
        }

        if ($request->filled('subject')) {
            $query->where('subject', $request->subject);
        }

        if ($request->filled('year')) {
            $year = $request->year;
            $query->whereHas('issue', function($q) use ($year) {
                $q->where('year', $year);
            });
        }

        $results = $query->orderBy('published_at', 'desc')->paginate(10);

        return view('search', compact('results'));
    }

    /**
     * Show article detail.
     */
    public function show($id)
    {
        $manuscript = Manuscript::with(['author', 'issue', 'reviews.reviewer', 'comments.user'])
            ->findOrFail($id);

        // Readers can only see published manuscripts, except authors, reviewers, partners, and admins
        if ($manuscript->status !== 'published') {
            $user = Auth::user();
            if (!$user || ($user->role !== 'admin' && $user->id !== $manuscript->author_id && 
                !$manuscript->reviews->contains('reviewer_id', $user->id) && $user->role !== 'partner')) {
                abort(403, 'Akses ditolak. Manuskrip ini belum dipublikasikan.');
            }
        }

        $comments = Comment::where('manuscript_id', $manuscript->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        $alreadyLiked = false;
        if (Auth::check()) {
            $alreadyLiked = Like::where('manuscript_id', $manuscript->id)
                ->where('user_id', Auth::id())
                ->exists();
        }

        return view('article', compact('manuscript', 'comments', 'alreadyLiked'));
    }

    /**
     * Submit form.
     */
    public function showSubmitForm()
    {
        return view('manuscripts.submit');
    }

    /**
     * Store submitted manuscript.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'abstract' => 'required|string',
            'keywords' => 'required|string',
            'subject' => 'required|string',
            'pdf_file' => 'required|file|mimes:pdf|max:10240', // PDF files only
            'article_component' => 'required|in:Article Text',
            'supporting_files' => 'nullable|file|max:10240',
            'comments_to_editor' => 'nullable|string',
            'contributors' => 'required|json',
            'references' => 'nullable|string',
        ], [
            'pdf_file.required' => 'File manuskrip utama wajib diunggah.',
            'pdf_file.mimes' => 'Format file naskah harus berupa PDF (.pdf). File Word dan format lainnya ditolak.',
            'article_component.required' => 'Komponen artikel wajib dipilih.',
            'article_component.in' => 'Komponen artikel harus bernilai "Article Text".',
            'title.required' => 'Judul artikel wajib diisi.',
            'abstract.required' => 'Abstrak artikel wajib diisi.',
            'keywords.required' => 'Kata kunci wajib diisi.',
            'subject.required' => 'Subjek pelajaran wajib diisi.',
        ]);

        $contributors = json_decode($request->contributors, true);
        if (!is_array($contributors) || count($contributors) === 0) {
            return back()->withErrors(['contributors' => 'Minimal harus ada 1 kontributor/penulis.'])->withInput();
        }

        $hasPrincipal = false;
        foreach ($contributors as $c) {
            if (isset($c['principal']) && ($c['principal'] === true || $c['principal'] === 'true' || $c['principal'] == 1)) {
                $hasPrincipal = true;
                break;
            }
        }

        if (!$hasPrincipal) {
            return back()->withErrors(['contributors' => 'Harus ada satu penulis yang ditunjuk sebagai Kontak Utama (Principal Contact) untuk korespondensi.'])->withInput();
        }

        $pdfPath = null;
        $supportingPath = null;

        // Process doc/docx as the primary submission file (storing in pdf_path)
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $uploadPath = public_path('uploads/manuscripts');
            
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            $file->move($uploadPath, $fileName);
            $pdfPath = 'uploads/manuscripts/' . $fileName;
        }

        // Process Supporting Files
        if ($request->hasFile('supporting_files')) {
            $file = $request->file('supporting_files');
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $uploadPath = public_path('uploads/supporting');
            
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            $file->move($uploadPath, $fileName);
            $supportingPath = 'uploads/supporting/' . $fileName;
        }

        $manuscript = Manuscript::create([
            'author_id' => Auth::id(),
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'abstract' => $request->abstract,
            'keywords' => $request->keywords,
            'subject' => $request->subject,
            'pdf_path' => $pdfPath,
            'supporting_files' => $supportingPath,
            'comments_to_editor' => $request->comments_to_editor,
            'contributors' => $contributors,
            'references' => $request->references,
            'status' => 'submitted',
        ]);

        // Notify Admins
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => 'Manuskrip Baru Terkirim',
                'message' => 'Siswa ' . Auth::user()->name . ' telah mengunggah manuskrip baru berjudul: "' . $manuscript->title . '"',
            ]);
        }

        return redirect('/author/submission/' . $manuscript->id . '/complete')->with('success', 'Submisi berhasil dikirim!');
    }

    /**
     * Show submission success / next steps page (Step 5).
     */
    public function complete($id)
    {
        $manuscript = Manuscript::findOrFail($id);

        if ($manuscript->author_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('manuscripts.complete', compact('manuscript'));
    }

    /**
     * Show submission printable summary screen.
     */
    public function summary($id)
    {
        $manuscript = Manuscript::with('author')->findOrFail($id);

        if ($manuscript->author_id !== Auth::id() && Auth::user()->role !== 'admin' && Auth::user()->role !== 'partner') {
            abort(403, 'Akses ditolak.');
        }

        return view('manuscripts.summary', compact('manuscript'));
    }

    /**
     * Like an article.
     */
    public function like($id)
    {
        $manuscript = Manuscript::findOrFail($id);
        $userId = Auth::id();
        $ip = request()->ip();

        if (Auth::check()) {
            $like = Like::where('manuscript_id', $manuscript->id)
                ->where('user_id', $userId)
                ->first();

            if ($like) {
                $like->delete();
                $manuscript->decrement('likes');
                $liked = false;
            } else {
                Like::create([
                    'manuscript_id' => $manuscript->id,
                    'user_id' => $userId,
                ]);
                $manuscript->increment('likes');
                $liked = true;
            }
        } else {
            // Guest likes by IP
            $like = Like::where('manuscript_id', $manuscript->id)
                ->where('ip_address', $ip)
                ->first();

            if ($like) {
                $like->delete();
                $manuscript->decrement('likes');
                $liked = false;
            } else {
                Like::create([
                    'manuscript_id' => $manuscript->id,
                    'ip_address' => $ip,
                ]);
                $manuscript->increment('likes');
                $liked = true;
            }
        }

        return response()->json([
            'success' => true,
            'likes' => $manuscript->likes,
            'liked' => $liked,
        ]);
    }

    /**
     * Comment on an article.
     */
    public function comment(Request $request, $id)
    {
        $manuscript = Manuscript::findOrFail($id);

        $request->validate([
            'content' => 'required|string|max:1000',
            'type' => 'required|in:public,academic',
        ]);

        // Secure partner validation for academic comments
        if ($request->type === 'academic' && (!Auth::check() || Auth::user()->role !== 'partner')) {
            return back()->with('error', 'Hanya mitra universitas yang diizinkan menulis komentar akademik.');
        }

        Comment::create([
            'manuscript_id' => $manuscript->id,
            'user_id' => Auth::id(),
            'author_name' => Auth::check() ? Auth::user()->name : ($request->author_name ?: 'Guest Reader'),
            'content' => $request->content,
            'type' => $request->type,
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    /**
     * Upload revised manuscript.
     */
    public function uploadRevision(Request $request, $id)
    {
        $manuscript = Manuscript::findOrFail($id);
        if ($manuscript->author_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'pdf_file' => 'required|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $fileName = time() . '_revision_' . str_replace(' ', '_', $file->getClientOriginalName());
            $uploadPath = public_path('uploads/manuscripts');
            
            $file->move($uploadPath, $fileName);
            
            // Delete old file if exists
            if ($manuscript->pdf_path && File::exists(public_path($manuscript->pdf_path))) {
                File::delete(public_path($manuscript->pdf_path));
            }

            $manuscript->update([
                'pdf_path' => 'uploads/manuscripts/' . $fileName,
                'status' => 'revised_submission',
            ]);

            // Notify reviewer
            $reviews = $manuscript->reviews()->where('status', 'assigned')->get();
            foreach ($reviews as $review) {
                Notification::create([
                    'user_id' => $review->reviewer_id,
                    'title' => 'Revisi Manuskrip Diunggah',
                    'message' => 'Siswa telah mengunggah revisi baru untuk manuskrip: "' . $manuscript->title . '"',
                ]);
            }

            // Notify admin
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'title' => 'Revisi Manuskrip Baru',
                    'message' => 'Author mengunggah revisi manuskrip: "' . $manuscript->title . '"',
                ]);
            }
        }

        return back()->with('success', 'Naskah revisi berhasil diunggah.');
    }
}
