<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/articles', function () {
    return view('articles');
});

// Show single article
Route::get('/article/{title}', function ($title) {
    return view('article', ['title' => $title]);
});

Route::resource('plants', PlantController::class);
Route::resource('users', UserController::class);
Route::resource('userplants', UserPlantController::class);