<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\IdTodoRequest;
use App\Http\Requests\Api\StoreTodoRequest;
use App\Http\Requests\Api\UpdateRequest;
use App\Service\TodoService;
use App\Traits\Http\Controllers\Api\SwaggerTodo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    use SwaggerTodo;

    public function store(StoreTodoRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return TodoService::store($validated);
    }
    public function todos(): JsonResponse
    {
        return TodoService::all();
    }
    public function todo(IdTodoRequest $request): JsonResponse
    {

        $validated = $request->validated();

        return TodoService::todo($validated['id']);
    }
    public function update(UpdateRequest $request)
    {
        $payload = $request->validated();

        return TodoService::update($payload);
    }
    public function delete(IdTodoRequest $request)
    {
        dd($request->validated());
    }
}
