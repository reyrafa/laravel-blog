<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');

    /**
     * posts routes
     */
    Route::prefix('/posts')
        ->name('posts.')
        ->group(function () {
            Route::view('/create', 'posts.create')->name('create');
            Route::get('/archive', [PostController::class, 'archive'])->name('archive');
            Route::put('/restore/{post}', [PostController::class, 'restore'])->name('restore');
            // Route::post('/store',[PostController::class , 'store'])->name('store');
        });
    Route::resource('posts', PostController::class)->except(['create', 'index']);

    /**
     * comments routes
     */
    Route::prefix('comments')->name('comments.')->group(function () {
        Route::post('/store/{post_uuid}', [CommentController::class, 'store'])->name('store');
    });
    Route::resource('comments', CommentController::class)->except('store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__ . '/auth.php';
