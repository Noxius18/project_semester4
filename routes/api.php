<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JadwalController;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/jadwal', [JadwalController::class, 'index']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
