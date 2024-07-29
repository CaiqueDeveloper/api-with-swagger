<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {

    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/auth/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
});

Route::controller(UserController::class)->group(function () {

    Route::get('/users', [UserController::class, 'all']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'create']);
    Route::put('/users', [UserController::class, 'update']);
    Route::delete('/users', [UserController::class, 'delete']);
})->middleware('auth:sanctum');
