<?php

use App\Http\Controllers\external\ExternalController;
use Illuminate\Support\Facades\Route;

Route::prefix('external')->group(function () {
	Route::middleware('auth:sanctum')->group(function () {
		Route::get('/users', [ExternalController::class, 'getAllUsers']);
		Route::get('/users/{id}', [ExternalController::class, 'getUserDetails']);
	});
});
