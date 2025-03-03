<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\PlantController;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles-filter', [ArticleController::class, 'filter'])->name('articles.filter');
Route::get('/articles/{title}', [ArticleController::class, 'show'])->name('articles.show');