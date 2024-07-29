<?php

namespace App\Services\API;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function update(array $payload): JsonResponse
    {

        $user = Auth::user()->update($payload);

        $user = Auth::user();

        return response()->json([
            'meta' => [
                'code' => Response::HTTP_ACCEPTED,
                'status' => 'success',
                'message' => 'User updated successfully!',
            ],
            'data' => [
                'user' => $user
            ],
            'access_token' => [
                'token' => $user->createToken($payload['email'])->plainTextToken,
                'type' => 'Bearer'
            ],
        ], Response::HTTP_ACCEPTED);
    }
}
