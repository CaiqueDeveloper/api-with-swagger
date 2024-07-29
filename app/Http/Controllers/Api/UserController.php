<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\UpdateUser;
use App\Models\User;
use App\Services\API\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\Http\Controllers\Api\SwaggerUser;

class UserController extends Controller
{
    use SwaggerUser;

    public function __construct()
    {
    }
    public function update(UpdateUser $request): JsonResponse
    {
        $validated = $request->validated();

        return UserService::update($validated);
    }
    public function delete(User $user)
    {
    }
}
