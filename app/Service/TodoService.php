<?php

namespace App\Service;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
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
                'message' => 'Todo created successfully!',
            ],
            'data' => [
                'todo' => $todo
            ],
        ], Response::HTTP_CREATED);
    }
    public static function all(): JsonResponse
    {
        $todos = Auth::user()->todos;

        return response()->json([
            'meta' => [
                'code' => Response::HTTP_CREATED,
                'status' => 'success',
                'message' => 'List all todos successfully!',
            ],
            'data' => [
                'todo' => $todos
            ],
        ], Response::HTTP_CREATED);
    }
    public static function todo($id): JsonResponse
    {

        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                'meta' => [
                    'code' => Response::HTTP_NOT_FOUND,
                    'status' => 'fails',
                    'message' => 'Todo not found!',
                ],
                'data' => [
                    'todo' => []
                ],
                'access_token' => [],
            ], Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'meta' => [
                'code' => Response::HTTP_OK,
                'status' => 'success',
                'message' => 'Todo successfully!',
            ],
            'data' => [
                'todo' => $todo
            ],
        ], Response::HTTP_OK);
    }
    public static function update(array $payload): JsonResponse
    {
        $todo = Todo::find($payload['id']);
        if (!$todo) {
            return response()->json([
                'meta' => [
                    'code' => Response::HTTP_NOT_FOUND,
                    'status' => 'fails',
                    'message' => 'Todo not found!',
                ],
                'data' => [
                    'todo' => []
                ],
                'access_token' => [],
            ], Response::HTTP_NOT_FOUND);
        }

        $todo->update(Arr::except($payload, ['id']));

        $todo = Todo::find($payload['id']);

        return response()->json([
            'meta' => [
                'code' => Response::HTTP_OK,
                'status' => 'success',
                'message' => 'Todo updated successfully!',
            ],
            'data' => [
                'todo' => $todo
            ],
        ], Response::HTTP_OK);
    }
    public static function delete(int $id): JsonResponse
    {

        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json([
                'meta' => [
                    'code' => Response::HTTP_NOT_FOUND,
                    'status' => 'fails',
                    'message' => 'Todo not found!',
                ],
                'data' => [
                    'todo' => []
                ],
                'access_token' => [],
            ], Response::HTTP_NOT_FOUND);
        }

        $todo->delete();

        return response()->json([
            'meta' => [
                'code' => Response::HTTP_OK,
                'status' => 'success',
                'message' => 'Todo deleted successfully!',
            ],
            'data' => [
                'Todo' => []
            ],
            'access_token' => [],
        ], Response::HTTP_OK);
    }
}
