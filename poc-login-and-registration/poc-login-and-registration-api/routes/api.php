<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthenticateApi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| 
| NOTE: This POC uses stateless token authentication (Sanctum-like pattern).
| Real Sanctum would use: Route::middleware('auth:sanctum')
|
*/

// Public routes (no authentication required)
Route::post('/login', [UserController::class, 'loginUser']);

// Protected routes (authentication required)
Route::middleware(AuthenticateApi::class)->group(function () {
    // Get current user
    Route::get('/me', [UserController::class, 'me']);

    // Logout
    Route::post('/logout', [UserController::class, 'logout']);

    // Register new user (only admin and superAdmin can register new users)
    Route::post('/register', [UserController::class, 'registerUser'])
        ->middleware(AuthenticateApi::class . ':admin,superAdmin');
});
