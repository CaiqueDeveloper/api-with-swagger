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
    public static function delete(int $id): JsonResponse
    {

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'meta' => [
                    'code' => Response::HTTP_NOT_FOUND,
                    'status' => 'fails',
                    'message' => 'User not found!',
                ],
                'data' => [
                    'user' => []
                ],
                'access_token' => [],
            ], Response::HTTP_NOT_FOUND);
        }
        
        $user->delete();

        return response()->json([
            'meta' => [
                'code' => Response::HTTP_OK,
                'status' => 'success',
                'message' => 'User deleted successfully!',
            ],
            'data' => [
                'user' => []
            ],
            'access_token' => [],
        ], Response::HTTP_OK);
    }
}
