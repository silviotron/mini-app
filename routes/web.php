<?php

use App\Http\Controllers\SaveController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/saves', [SaveController::class, 'saves'])->name('saves');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::post('/save-results', [SaveController::class, 'saveResults'])->name('saveResults');
