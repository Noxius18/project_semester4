<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\Api\AbsenController;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/jadwal', [JadwalController::class, 'index']);

// End Point buka tutup absen
Route::post('/jadwal/{id}/buka-absen', [JadwalController::class, 'bukaAbsen']);
Route::post('/jadwal/{id}/tutup-absen', [JadwalController::class, 'tutupAbsen']);

Route::post('/absen', [AbsenController::class, 'absen']);

Route::get('/rekap-absen/{id}', [AbsenController::class, 'rekap']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
