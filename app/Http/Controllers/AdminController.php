<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Manuscript;
use App\Models\Issue;
use App\Models\Rubric;
use App\Models\Review;
use App\Models\Certificate;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private function validateAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses dibatasi hanya untuk Admin.');
        }
    }

    /**
     * Users Management
     */
    public function updateUserRole(Request $request, $id)
    {
        $this->validateAdmin();

        $user = User::findOrFail($id);
        $request->validate([
            'role' => 'required|in:reader,author,reviewer,partner,admin',
        ]);

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Role pengguna ' . $user->name . ' berhasil diubah menjadi ' . $request->role);
    }

    /**
     * Rubric Management
     */
    public function storeRubric(Request $request)
    {
        $this->validateAdmin();

        $request->validate([
            'criteria_name' => 'required|string|max:255',
            'weight' => 'required|integer|min:1|max:100',
            'max_score' => 'required|integer|min:1|max:100',
        ]);

        Rubric::create($request->all());

        return back()->with('success', 'Kriteria penilaian rubrik berhasil ditambahkan.');
    }

    public function deleteRubric($id)
    {
        $this->validateAdmin();

        $rubric = Rubric::findOrFail($id);
        $rubric->delete();
        return back()->with('success', 'Kriteria penilaian berhasil dihapus.');
    }

    /**
     * Issue Management
     */
    public function storeIssue(Request $request)
    {
        $this->validateAdmin();

        $request->validate([
            'volume' => 'required|integer',
            'issue_number' => 'required|integer',
            'year' => 'required|integer',
            'title' => 'required|string|max:255',
        ]);

        Issue::create([
            'volume' => $request->volume,
            'issue_number' => $request->issue_number,
            'year' => $request->year,
            'title' => $request->title,
            'status' => 'draft',
        ]);

        return back()->with('success', 'Nomor/Volume Issue Jurnal baru berhasil ditambahkan.');
    }

    public function publishIssue($id)
    {
        $this->validateAdmin();

        $issue = Issue::findOrFail($id);
        $issue->update(['status' => 'published']);

        return back()->with('success', 'Issue Jurnal ' . $issue->title . ' telah diterbitkan secara online.');
    }

    /**
     * Reviewer Assignment
     */
    public function assignReviewer(Request $request, $manuscriptId)
    {
        $this->validateAdmin();

        $request->validate([
            'reviewer_id' => 'required|exists:users,id',
        ]);

        $manuscript = Manuscript::findOrFail($manuscriptId);
        
        // Create review assignment
        Review::create([
            'manuscript_id' => $manuscriptId,
            'reviewer_id' => $request->reviewer_id,
            'status' => 'assigned',
        ]);

        $manuscript->update(['status' => 'reviewer_assigned']);

        // Notify Reviewer
        Notification::create([
            'user_id' => $request->reviewer_id,
            'title' => 'Penugasan Reviewer Baru',
            'message' => 'Anda ditugaskan untuk meninjau manuskrip: "' . $manuscript->title . '"',
        ]);

        // Notify Author
        Notification::create([
            'user_id' => $manuscript->author_id,
            'title' => 'Reviewer Ditugaskan',
            'message' => 'Manuskrip Anda "' . $manuscript->title . '" telah ditugaskan ke reviewer sekolah.',
        ]);

        return back()->with('success', 'Reviewer berhasil ditugaskan.');
    }

    /**
     * Publish Manuscript
     */
    public function publishManuscript(Request $request, $id)
    {
        $this->validateAdmin();

        $request->validate([
            'issue_id' => 'required|exists:issues,id',
        ]);

        $manuscript = Manuscript::findOrFail($id);
        $issue = Issue::findOrFail($request->issue_id);

        // Generate custom DOI: Format EDU-[YEAR]-V[VOL]-I[ISSUE]-[ID_PADDED]
        $doi = 'EDU-' . $issue->year . '-V' . $issue->volume . '-I' . $issue->issue_number . '-' . str_pad($manuscript->id, 4, '0', STR_PAD_LEFT);

        $manuscript->update([
            'issue_id' => $issue->id,
            'status' => 'published',
            'doi' => $doi,
            'published_at' => now(),
        ]);

        // Generate Certificate Entry
        $certHash = sha1($manuscript->id . '-' . Auth::id() . '-' . time());
        Certificate::create([
            'manuscript_id' => $manuscript->id,
            'author_id' => $manuscript->author_id,
            'hash' => $certHash,
        ]);

        // Notify Author
        Notification::create([
            'user_id' => $manuscript->author_id,
            'title' => 'Artikel Resmi Dipublikasikan!',
            'message' => 'Selamat! Karya ilmiah Anda "' . $manuscript->title . '" telah resmi dipublikasikan di jurnal ilmiah. DOI: ' . $doi . '. Sertifikat publikasi Anda kini dapat diunduh di dashboard.',
        ]);

        return back()->with('success', 'Artikel berhasil dipublikasikan secara resmi dengan DOI: ' . $doi);
    }
}
