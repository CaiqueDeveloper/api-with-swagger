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

    Route::put('/user', 'update')->middleware('auth:sanctum');
    Route::delete('/user', 'delete')->middleware('auth:sanctum');
});
