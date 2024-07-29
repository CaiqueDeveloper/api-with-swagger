<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\StoreTodoRequest;
use App\Service\TodoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(StoreTodoRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return TodoService::store($validated);
    }
    public function todos(): JsonResponse
    {
        return TodoService::all();
    }
    public function todo()
    {
    }
    public function update()
    {
    }
    public function delete()
    {
    }
}
