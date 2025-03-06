<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PasswordResetController;

Route::get('/', [ArticleController::class, 'home'])->name('home');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles-filter', [ArticleController::class, 'filter'])->name('articles.filter');
Route::get('/articles/{title}', [ArticleController::class, 'show'])->name('articles.show');

// Password reset routes
Route::get('/reset-password', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');