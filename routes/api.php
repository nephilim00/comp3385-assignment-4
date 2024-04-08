<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/v1/movies', [MovieController::class, 'index']);
Route::post('/v1/movies', [MovieController::class, 'store']);
Route::get('/api/v1/movies', [MovieController::class, 'index']);

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
