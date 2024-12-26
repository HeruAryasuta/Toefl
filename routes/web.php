<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalTestController;
use Illuminate\Support\Facades\Route;

// Halaman utama (landing page)
Route::get('/', function () {
    return view('frontend.home'); // Mengarahkan ke frontend.home.blade.php
});

// Halaman home setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home'); // Rute untuk halaman home setelah login

Route::get('/', [HomeController::class, 'index']);

Route::get('/', [JadwalTestController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


// Rute untuk otentikasi (login/register)
Auth::routes();