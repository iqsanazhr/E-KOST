<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\OwnerKostController;
use App\Http\Controllers\AdminVerificationController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Publik
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/fitur', [PublicController::class, 'features'])->name('features');
Route::get('/bantuan', [PublicController::class, 'help'])->name('help');
Route::get('/kost/{id}', [PublicController::class, 'show'])->name('kost.show');
Route::get('/privacy', [PublicController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PublicController::class, 'terms'])->name('terms');
Route::get('/safety', [PublicController::class, 'safety'])->name('safety');

// Dashboard Routes (Perlu Middleware Auth di implementasi nyata)
Route::middleware(['auth'])->group(function () {

    // Route untuk Pemilik
    Route::prefix('owner')->name('owner.')->middleware('role:pemilik')->group(function () {
        Route::resource('kosts', OwnerKostController::class);
        Route::delete('/kost-images/{image}', [OwnerKostController::class, 'destroyImage'])->name('kost-images.destroy');
    });

    // Route untuk Admin
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/verification', [AdminVerificationController::class, 'index'])->name('verification.index');
        Route::post('/verification/{id}/approve', [AdminVerificationController::class, 'approve'])->name('verification.approve');
        Route::post('/verification/{id}/reject', [AdminVerificationController::class, 'reject'])->name('verification.reject');
        Route::delete('/verification/{id}', [AdminVerificationController::class, 'destroy'])->name('verification.destroy');
        Route::get('/feedbacks', [App\Http\Controllers\FeedbackController::class, 'index'])->name('feedbacks.index');
        Route::get('/feedbacks/export', [App\Http\Controllers\FeedbackController::class, 'export'])->name('feedbacks.export');
    });
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/feedback', [App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback.store');

Route::middleware(['auth'])->group(function () {
    Route::post('/kost/{kost}/favorite', [App\Http\Controllers\FavoriteController::class, 'toggle'])->name('kost.favorite');
    Route::post('/kost/{kost}/comment', [App\Http\Controllers\CommentController::class, 'store'])->name('kost.comment.store');
    Route::delete('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/favorites', [App\Http\Controllers\FavoriteController::class, 'index'])->name('favorites.index');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
