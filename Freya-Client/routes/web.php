<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::resource('plants', PlantController::class);
Route::resource('users', UserController::class);
Route::resource('userplants', UserPlantController::class);
