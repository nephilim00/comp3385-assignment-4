<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;

// Add middleware to all movie-related routes
Route::middleware('auth:api')->group(function () {
    Route::get('/v1/movies', [MovieController::class, 'index']);
    Route::post('/v1/movies', [MovieController::class, 'store']);
    // If you have more movie routes, add them here
});

// Publicly accessible routes
Route::post('/v1/login', [AuthController::class, 'login']);

// Protected route for logout
Route::middleware('auth:api')->post('/v1/logout', [AuthController::class, 'logout']);

// Example route to get user information using Sanctum
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
