<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NilaiController;


Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::get( '/unauthenticated', [AuthController::class, 'unauthenticated'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::get('/divisions', [DivisionController::class, 'index']);

    // Route::apiResource('employees', EmployeeController::class);
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->middleware('multipart.put');
});

Route::get('/nilaiRT', [NilaiController::class, 'nilaiRT']);
Route::get('/nilaiST', [NilaiController::class, 'nilaiST']);
