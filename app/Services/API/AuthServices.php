<?php

namespace App\Services\API;

use App\Models\User;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

    public static function attempt(array $credentials): JsonResponse
    {

        if (!Auth::attempt($credentials)) {

            return response()->json([
                'meta' => [
                    'code' => Response::HTTP_UNAUTHORIZED,
                    'status' => 'fail',
                    'message' => 'The provided credentials are incorrect.',
                ],
                'data' => [
                    'user' => []
                ],
                'access_token' => [
                    'token' => '',
                    'type' => 'Bearer'
                ],
            ], Response::HTTP_UNAUTHORIZED);
        }

        static::revokingTokens();

        return response()->json([
            'meta' => [
                'code' => Response::HTTP_ACCEPTED,
                'status' => 'success',
                'message' => 'Login success.',
            ],
            'data' => [
                'user' => Auth::user()
            ],
            'access_token' => [
                'token' => Auth::user()->createToken($credentials['email'])->plainTextToken,
                'type' => 'Bearer'
            ],
        ], Response::HTTP_ACCEPTED);
    }
    private static function revokingTokens(?int $id = null): void
    {
        if ($id) {
            Auth::user()->tokens('id', $id)->delete();
        }
        Auth::user()->tokens()->delete();
    }
}
