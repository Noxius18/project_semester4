<?php

use App\Http\Controllers\UserCOntroller;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('home');
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
    Route::get('/jadwal/{jadwal}/assign', [JadwalController::class,'assign'])->name('jadwal.assign');
    Route::post('/jadwal/{jadwal}/assign', [JadwalController::class,'storeAssign'])->name('jadwal.assign.store');

    // Route Resource
    Route::resources([
        'jadwal' => JadwalController::class,
        'user' => UsersController::class,
    ]);
});