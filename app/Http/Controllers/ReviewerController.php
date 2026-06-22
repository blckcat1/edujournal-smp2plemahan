<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Manuscript;
use App\Models\Rubric;
use App\Models\RubricScore;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ReviewerController extends Controller
{
    public function showReviewForm($id)
    {
        if (Auth::user()->role !== 'reviewer') {
            abort(403);
        }

        $review = Review::with(['manuscript.author'])->findOrFail($id);
        $rubrics = Rubric::all();

        return view('reviewer.evaluate', compact('review', 'rubrics'));
    }

    public function submitReview(Request $request, $id)
    {
        if (Auth::user()->role !== 'reviewer') {
            abort(403);
        }

        $review = Review::findOrFail($id);
        $manuscript = Manuscript::findOrFail($review->manuscript_id);
        $rubrics = Rubric::all();

        $rules = [
            'comments' => 'required|string',
            'recommendation' => 'required|in:approve,revision,reject',
            'status_update' => 'required|in:under_review,revision_required,accepted,rejected',
        ];

        foreach ($rubrics as $rubric) {
            $rules['score_' . $rubric->id] = 'required|integer|min:0|max:' . $rubric->max_score;
            $rules['comment_' . $rubric->id] = 'nullable|string';
        }

        $request->validate($rules);

        // Update Review details
        $review->update([
            'comments' => $request->comments,
            'recommendation' => $request->recommendation,
            'status' => 'completed',
        ]);

        // Save Rubric Scores
        foreach ($rubrics as $rubric) {
            RubricScore::updateOrCreate(
                [
                    'review_id' => $review->id,
                    'rubric_id' => $rubric->id,
                ],
                [
                    'score' => $request->input('score_' . $rubric->id),
                    'comments' => $request->input('comment_' . $rubric->id),
                ]
            );
        }

        // Map status_update input to manuscript status values
        $manuscriptStatus = match ($request->status_update) {
            'under_review' => 'under_review',
            'revision_required' => 'revision_required',
            'accepted' => 'accepted',
            'rejected' => 'rejected',
        };

        $manuscript->update([
            'status' => $manuscriptStatus,
        ]);

        // Notify Author
        $message = match ($manuscriptStatus) {
            'under_review' => 'Manuskrip Anda "' . $manuscript->title . '" sedang dalam peninjauan reviewer.',
            'revision_required' => 'Reviewer meminta revisi untuk manuskrip Anda: "' . $manuscript->title . '". Silakan periksa komentar reviewer di Dashboard.',
            'accepted' => 'Selamat! Manuskrip Anda "' . $manuscript->title . '" telah DITERIMA dan sedang dalam antrean publikasi.',
            'rejected' => 'Reviewer telah menolak publikasi manuskrip Anda: "' . $manuscript->title . '".',
        };

        Notification::create([
            'user_id' => $manuscript->author_id,
            'title' => 'Pembaruan Status Peninjauan',
            'message' => $message,
        ]);

        return redirect('/reviewer')->with('success', 'Penilaian dan review naskah berhasil dikirim.');
    }
}
