<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\PlantController;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('home');
})->name('home');



//Controllerek nélküli meg resource stuff idk mi ez hogy meg miert

// Route::get('/articles', function () {
//     return view('articles');
// });

// Route::get('/articles-filter', function () {
//     return view('articles-filter');
// });

// // Show single article
// Route::get('/article/{title}', function ($title) {
//     return view('article', ['title' => $title]);
// });


// Route::resource('articles', ArticleController::class);
// Route::resource('plants', PlantController::class);
// Route::resource('users', UserController::class);
// Route::resource('userplants', UserPlantController::class);


Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles-filter', [ArticleController::class, 'filter'])->name('articles.filter');
// Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');