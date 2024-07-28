<?php

namespace App\Services\API;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthServices
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function register(array $data): JsonResponse
    {
        $user = User::create($data);

        Auth::login($user);

        return response()->json([
            'meta' => [
                'code' => Response::HTTP_CREATED,
                'status' => 'success',
                'message' => 'User created successfully!',
            ],
            'data' => [
                'user' => $user
            ],
            'access_token' => [
                'token' => $user->createToken($data['email'])->plainTextToken,
                'type' => 'Bearer'
            ],
        ], Response::HTTP_CREATED);
    }
}
