<?php

namespace App\Traits\Http\Controllers\Api;

use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

trait SwaggerUser
{
    #[
        OA\Put(
            path: '/api/user',
            description: 'Update User',
            tags: ['User'],
            security: [
                [
                    'bearerAuth' => []
                ]
            ],
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['name', 'email', 'password', 'password_confirmation'],
                        properties: [
                            new OA\Property(property: 'name', description: 'Name', type: 'string'),
                            new OA\Property(property: 'email', description: 'E-mail', type: 'string'),
                            new OA\Property(property: 'password', description: 'Password', type: 'string'),
                            new OA\Property(property: 'password_confirmation', description: 'Password Confirmation', type: 'string'),
                        ]
                    ),
                    example: [

                        "name" => "User Teste - UPDATED",
                        "email" => "email@email.com",
                        "password" => 'user_teste_pass',
                        "password_confirmation" => 'user_teste_pass',

                    ]
                )
            ),
            responses: [
                new OA\Response(response: Response::HTTP_ACCEPTED, description: 'User updated successfully!', content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            "meta" => [
                                "code" => 202,
                                "status" => "success",
                                "message" => "User updated successfully!"
                            ],
                            "data" => [
                                "user" => [
                                    "id" => 11,
                                    "name" => "User Teste - UPDATED",
                                    "email" => "email@email.com",
                                    "email_verified_at" => null,
                                    "created_at" => "2024-07-29T17:18:41.000000Z",
                                    "updated_at" => "2024-07-29T17:53:34.000000Z"
                                ],

                            ],
                            "access_token" => [
                                "token" => "20|Iu1Ukr9PAgWCSzWbpoJm7O6lcxDk3bVU1PFFcEFz0842a61c",
                                "type" => "Bearer"
                            ],
                        ])
                    ]
                ))
            ]
        )
    ]
    private function swagger_user_update(): void
    {
    }
}
