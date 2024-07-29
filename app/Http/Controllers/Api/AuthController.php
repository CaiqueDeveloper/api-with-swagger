<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use App\Http\Requests\Api\Auth\{RegisterRequest, LoginRequest};

use App\Services\API\AuthServices;
use Illuminate\Http\JsonResponse;
use App\Traits\Http\Controllers\Api\SwaggerAuth;

class AuthController extends Controller
{
    use SwaggerAuth;

    public function register(RegisterRequest $request): JsonResponse
    {

        $payload = $request->validated();

        return AuthServices::register($payload);
    }
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        return AuthServices::attempt($credentials);
    }
    public function logout(): JsonResponse
    {
        return AuthServices::logout();
    }
    public function me(): JsonResponse
    {
        return AuthServices::me();
    }
}
