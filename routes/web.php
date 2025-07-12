<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Enable default auth routes (Login, Register, Logout, etc.)
Auth::routes();

// Ganti HomeController dengan PostController
Route::get('/home', [PostController::class, 'index'])->middleware('auth')->name('home');

// Posting routes
Route::post('/posts', [PostController::class, 'store'])->middleware('auth');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('auth');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->middleware('auth');
Route::put('/posts/{post}', [PostController::class, 'update'])->middleware('auth');



Route::post('/posts/{post}/like', [LikeController::class, 'like'])->middleware('auth');
Route::delete('/posts/{post}/like', [LikeController::class, 'unlike'])->middleware('auth');


Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->middleware('auth');

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::put('/profile/{user}', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');


Route::get('/explore', [ExploreController::class, 'index'])->middleware('auth')->name('explore');

Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->middleware('auth')->name('follow');
Route::delete('/users/{user}/unfollow', [FollowController::class, 'unfollow'])->middleware('auth')->name('unfollow');

Route::get('/profile/{user}/followers', [App\Http\Controllers\ProfileController::class, 'followers'])->name('profile.followers');
Route::get('/profile/{user}/following', [App\Http\Controllers\ProfileController::class, 'following'])->name('profile.following');
