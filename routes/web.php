<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [
    App\Http\Controllers\adminController::class,
    'dashboard',
])->name('home');
