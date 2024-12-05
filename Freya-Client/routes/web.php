<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::resource('plants', PlantController::class);
Route::resource('users', UserController::class);
Route::resource('userplants', UserPlantController::class);
