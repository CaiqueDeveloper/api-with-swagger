<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {

    Route::post('/auth/login',  'login');
    Route::post('/auth/register',  'register');
    Route::post('/auth/logout',  'logout')->middleware('auth:sanctum');
    Route::get('/auth/me',  'me')->middleware('auth:sanctum');
});

Route::controller(UserController::class)->group(function () {

    Route::get('/users', 'all')->middleware('auth:sanctum');
    Route::get('/users/{user}', 'show')->middleware('auth:sanctum');
    Route::post('/users', 'create')->middleware('auth:sanctum');
    Route::put('/users', 'update')->middleware('auth:sanctum');
    Route::delete('/users', 'delete')->middleware('auth:sanctum');
});
