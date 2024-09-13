<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('profile')->middleware('auth');
    Route::get('/dashboard/forum', [DashboardController::class, 'forum'])->name('forum')->middleware('auth');
    Route::get('/forum', [PostController::class, 'index'])->name('forum.index')->middleware('auth');
    Route::get('/forum/create', [PostController::class, 'create'])->name('forum.create')->middleware('auth');
    Route::post('/forum', [PostController::class, 'store'])->name('forum.store')->middleware('auth');
    Route::get('/forum/{id_post}', [PostController::class, 'show'])->name('forum.show')->middleware('auth');
    Route::post('/forum/reply', [PostController::class, 'storeReply'])->name('forum.storeReply')->middleware('auth');

    Route::post('/forum/like', [PostController::class, 'like'])->name('forum.like')->middleware('auth');
    Route::post('forum/share', [PostController::class, 'share'])->name('forum.share')->middleware('auth'); 
});