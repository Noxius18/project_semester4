<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DashboardController;

// Testing Route
Route::get('/test', function () {
    return view('layouts.app');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/tambah-jadwal', function () {
    return view('jadwal.create');
});

// Login End-point
Route::get('/login', [AuthController::class,'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/logout', [AuthController::class,'logout'])->name('auth.logout');

// Middleware Login admin end-point
Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Route Dashboard
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    
    // Route Jadwal
    Route::get('/jadwal/reguler', [JadwalController::class,'indexReguler'])->name('jadwal.reguler');
    Route::get('/jadwal/pengganti', [JadwalController::class,'indexPengganti'])->name('jadwal.pengganti');
    Route::get('/jadwal/pertandingan', [JadwalController::class,'indexPertandingan'])->name('jadwal.pertandingan');

    Route::resource('jadwal', JadwalController::class)->except('index');
});