<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NilaiController;
use \Illuminatech\MultipartMiddleware\MultipartFormDataParser;

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');
    Route::get('/unauthenticated', [AuthController::class, 'unauthenticated'])->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
        Route::get('/divisions', [DivisionController::class, 'index']);
        Route::get('/employees', [EmployeeController::class, 'index']);
        Route::post('/employees', [EmployeeController::class, 'store']);
        Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
        Route::put('/employees/{id}', [EmployeeController::class, 'update'])->middleware(MultipartFormDataParser::class);
    });

    Route::get('/nilaiRT', [NilaiController::class, 'nilaiRT']);
    Route::get('/nilaiST', [NilaiController::class, 'nilaiST']);
});

Route::fallback(function () {
    return response()->json(['status' => 'false', 'message' => 'page not found'], 404);
});
