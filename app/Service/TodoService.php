<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TodoService
{
    public static function store(array $payload): JsonResponse
    {

        $todo = Auth::user()->todos()->updateOrCreate(
            $payload,
            $payload
        );

        return response()->json([
            'meta' => [
                'code' => Response::HTTP_CREATED,
                'status' => 'success',
                'message' => 'Todo updated successfully!',
            ],
            'data' => [
                'todo' => $todo
            ],
        ], Response::HTTP_CREATED);
    }
}
