<?php

use App\Http\Controllers\Api\AuthApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::post('/register', [AuthApiController::class, 'register'])->middleware('throttle:5,1'); // 5 requests per minute
Route::post('/login', [AuthApiController::class, 'login'])->middleware('throttle:5,1'); // 5 requests per minute
Route::middleware(['auth:sanctum', 'throttle:10,1'])->post('/logout', [AuthApiController::class, 'logout']); // 10 requests per minute

Route::middleware(['auth:sanctum', 'throttle:20,1'])->group(function () {
    Route::apiResource('/posts', PostController::class);
});

