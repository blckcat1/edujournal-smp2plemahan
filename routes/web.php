<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManuscriptController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CertificateController;

/*
|--------------------------------------------------------------------------
| EduJournal Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [ManuscriptController::class, 'home']);
Route::get('/search', [ManuscriptController::class, 'search']);
Route::get('/article/{id}', [ManuscriptController::class, 'show']);
Route::post('/article/{id}/like', [ManuscriptController::class, 'like']);
Route::post('/article/{id}/comment', [ManuscriptController::class, 'comment']);
Route::get('/certificate/{hash}', [CertificateController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Protected by standard 'auth' middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // Author Dashboard (Siswa)
    Route::get('/author', [DashboardController::class, 'authorIndex']);
    Route::get('/author/submit', [ManuscriptController::class, 'showSubmitForm']);
    Route::post('/author/submit', [ManuscriptController::class, 'store']);
    Route::get('/author/submission/{id}/complete', [ManuscriptController::class, 'complete']);
    Route::get('/author/submission/{id}/summary', [ManuscriptController::class, 'summary']);
    Route::post('/author/manuscript/{id}/revision', [ManuscriptController::class, 'uploadRevision']);

    // Reviewer Dashboard (Guru)
    Route::get('/reviewer', [DashboardController::class, 'reviewerIndex']);
    Route::get('/reviewer/review/{id}', [ReviewerController::class, 'showReviewForm']);
    Route::post('/reviewer/review/{id}', [ReviewerController::class, 'submitReview']);

    // Partner Dashboard (Mitra Universitas / Dosen)
    Route::get('/partner', [DashboardController::class, 'partnerIndex']);

    // Admin Dashboard
    Route::get('/admin', [DashboardController::class, 'adminIndex']);
    Route::post('/admin/user/{id}/role', [AdminController::class, 'updateUserRole']);
    Route::post('/admin/rubric', [AdminController::class, 'storeRubric']);
    Route::get('/admin/rubric/{id}/delete', [AdminController::class, 'deleteRubric']);
    Route::post('/admin/issue', [AdminController::class, 'storeIssue']);
    Route::get('/admin/issue/{id}/publish', [AdminController::class, 'publishIssue']);
    Route::post('/admin/manuscript/{id}/assign', [AdminController::class, 'assignReviewer']);
    Route::post('/admin/manuscript/{id}/publish', [AdminController::class, 'publishManuscript']);
});
