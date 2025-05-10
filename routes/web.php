<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Testing Route
Route::get('/test', function () {
    return view('layouts.app');
});

Route::get('/', function () {
    return view('home');
});

// Login End-point
Route::get('/login', [AuthController::class,'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/logout', [AuthController::class,'logout'])->name('auth.logout');

// Middleware Login admin end-point
Route::middleware(['auth', 'role:Admin'])->group(function () {
    
});