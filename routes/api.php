<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MakulController;


Route::middleware('auth:sanctum', 'throttle:60,1')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum', 'throttle:60,1')->group(function () {
    Route::apiResource('/dosens', DosenController::class);
    Route::apiResource('/mahasiswas', MahasiswaController::class);
    Route::apiResource('/makuls', MakulController::class);

    Route::get('/makul/{kode_makul}/dosens', [MakulController::class, 'getDosensByMakul']);

    Route::post('/logout', [AuthController::class, 'logout']);
});