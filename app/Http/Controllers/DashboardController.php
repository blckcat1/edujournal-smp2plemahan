<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Manuscript;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Issue;
use App\Models\Rubric;
use App\Models\Certificate;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function authorIndex()
    {
        $user = Auth::user();
        if ($user->role !== 'author') {
            abort(403, 'Akses khusus untuk Siswa (Author).');
        }
        
        $stats = [
            'submissions' => Manuscript::where('author_id', $user->id)->count(),
            'published' => Manuscript::where('author_id', $user->id)->where('status', 'published')->count(),
            'revisions' => Manuscript::where('author_id', $user->id)->where('status', 'revision_required')->count(),
            'likes' => Manuscript::where('author_id', $user->id)->sum('likes'),
        ];

        $manuscripts = Manuscript::where('author_id', $user->id)
            ->with(['issue'])
            ->orderBy('updated_at', 'desc')
            ->get();

        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $certificates = Certificate::where('author_id', $user->id)
            ->with(['manuscript'])
            ->get();

        return view('dashboard.author', compact('stats', 'manuscripts', 'notifications', 'certificates'));
    }

    public function reviewerIndex()
    {
        $user = Auth::user();
        if ($user->role !== 'reviewer') {
            abort(403, 'Akses khusus untuk Reviewer.');
        }
        
        $assignedReviews = Review::where('reviewer_id', $user->id)
            ->where('status', 'assigned')
            ->with(['manuscript.author'])
            ->get();

        $completedReviews = Review::where('reviewer_id', $user->id)
            ->where('status', 'completed')
            ->with(['manuscript.author'])
            ->get();

        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.reviewer', compact('assignedReviews', 'completedReviews', 'notifications'));
    }

    public function partnerIndex()
    {
        $user = Auth::user();
        if ($user->role !== 'partner') {
            abort(403, 'Akses khusus untuk Mitra Universitas.');
        }
        
        // Partner acts as academic reviewer, comments and logs comments
        $assignedManuscripts = Manuscript::whereIn('status', ['submitted', 'under_review'])
            ->with(['author'])
            ->orderBy('created_at', 'desc')
            ->get();

        $commentsHistory = Comment::where('user_id', $user->id)
            ->where('type', 'academic')
            ->with(['manuscript'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.partner', compact('assignedManuscripts', 'commentsHistory'));
    }

    public function adminIndex()
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            abort(403, 'Akses khusus untuk Administrator.');
        }

        $stats = [
            'users' => User::count(),
            'manuscripts' => Manuscript::count(),
            'published' => Manuscript::where('status', 'published')->count(),
            'under_review' => Manuscript::where('status', 'under_review')->count(),
            'revisions' => Manuscript::where('status', 'revision_required')->count(),
        ];

        $users = User::orderBy('created_at', 'desc')->get();
        $manuscripts = Manuscript::with(['author', 'issue'])->orderBy('created_at', 'desc')->get();
        $issues = Issue::withCount('manuscripts')->orderBy('year', 'desc')->orderBy('volume', 'desc')->get();
        $rubrics = Rubric::all();

        // Get reviewers
        $reviewers = User::where('role', 'reviewer')->get();

        return view('dashboard.admin', compact('stats', 'users', 'manuscripts', 'issues', 'rubrics', 'reviewers'));
    }
}
