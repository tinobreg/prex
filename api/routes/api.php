<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GifController;

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login')->name('login');
});

Route::middleware('auth:api')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('user', 'user');
    });

    Route::prefix('gifs')->controller(GifController::class)->group(function () {
        Route::get('/search', 'search');
        Route::get('/{id}', 'view');
        Route::post('/fav', 'addFavourite');
    });
});
