<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('auth.login');
});

// Login End-point
Route::get('/login', [AuthController::class,'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/logout', [AuthController::class,'logout'])->name('auth.logout');

// Middleware Login admin end-point
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard');
    });
});