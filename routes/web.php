<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('auth.login');
});

Route::get('/dashboard', function() {
    return view('dashboard');
});

Route::get('/login', [AuthController::class,'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/logout', [AuthController::class,'logout'])->name('auth.logout');