<?php
require __DIR__.'/external.php';
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', [ProfileController::class, 'getAllUsers']);
    Route::get('/users/{id}', [ProfileController::class, 'getUserDetails']);
    Route::post('/users', [ProfileController::class, 'createUser']);
    Route::put('/users/{id}', [ProfileController::class, 'updateUser']);
    Route::delete('/users/{id}', [ProfileController::class, 'deleteUser']);
});