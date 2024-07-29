<?php

namespace App\Traits\Http\Controllers\Api;

use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

trait SwaggerAuth
{
    #[
        OA\Post(
            path: '/api/auth/register',
            summary: 'Store an new user',
            tags: ['Authenticate'],
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: "application/json",
                    schema: new OA\Schema(
                        required: ['name', 'email', 'password', 'password_confirmation'],
                        properties: [
                            new  OA\Property(property: 'name', description: 'User name', type: 'string'),
                            new  OA\Property(property: 'email', description: 'User email', type: 'string'),
                            new  OA\Property(property: 'password', description: 'Password', type: 'string'),
                            new  OA\Property(property: 'password_confirmation', description: 'Password Confirmation', type: 'string')
                        ]
                    ),
                    example: [
                        'name' => 'User Teste',
                        'email' => 'userteste@email.com',
                        'password' => 'user_teste_pass',
                        'password_confirmation' => 'user_teste_pass',
                    ]
                ),
            ),
            responses: [
                new OA\Response(
                    response: Response::HTTP_CREATED,
                    description: "User created successfully!",
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(property: 'data', type: 'object', example: [
                                "meta" => [
                                    "code" => 201,
                                    "status" => "success",
                                    "message" => "User created successfully!"
                                ],
                                "user" => [
                                    "id" => 1,
                                    "name" => "User Teste",
                                    "email" => "email@email.com",
                                    "updated_at" => "2024-07-28T21:49:06.000000Z",
                                    "created_at" => "2024-07-28T21:49:06.000000Z",
                                ],
                                "access_token" => [
                                    "token" => "2|yubvLPyxjWvMaSRZ3bM1A60llv4r0En9DtVlq3gw74a22b65",
                                    "type" => "Bearer"
                                ]
                            ])
                        ]
                    )
                ),
                new OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: "Validation errors", content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            "success" => false,
                            "message" => "Validation errors",
                            "data" => [
                                "name" => [
                                    "The name field is required."
                                ],
                                "email" => [
                                    "The email field is required."
                                ],
                                "password" => [
                                    "The password field is required."
                                ]
                            ]
                        ])
                    ]
                )),
            ]
        )
    ]
    private  function swagger_register()
    {
    }
    #[
        OA\Post(
            path: "/api/auth/login",
            summary: "Login User",
            tags: ["Authenticate"],
            requestBody: new OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: "application/json",
                    schema: new OA\Schema(
                        required: ["email", "password"],
                        properties: [
                            new OA\Property(property: 'email', description: "User email", type: "string"),
                            new OA\Property(property: 'password', description: "User password", type: "string"),
                        ]
                    ),
                    example: [
                        'email' => 'userteste@email.com',
                        'password' => 'user_teste_pass'
                    ]
                )
            ),

            responses: [
                new OA\Response(
                    response: Response::HTTP_ACCEPTED,
                    description: "Login success.",
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(property: 'data', type: 'object', example: [
                                "success" => true,
                                "statusCode" => Response::HTTP_ACCEPTED,
                                "message" => "User has been logged successfully.",
                                "data" => [
                                    "id" => 7,
                                    "id" => 1,
                                    "name" => "User Teste",
                                    "email" => "email@email.com",
                                    "created_at" => "2024-07-27T15:39:28.000000Z",
                                    "updated_at" => "2024-07-28T21:49:06.000000Z",
                                    "bearer_token" => "17|QJmAJPmZPxxcAFCp8XgfgQf6GzEghBvTEgkgEHrAf7040d89"
                                ]
                            ])
                        ]
                    )
                ),
                new OA\Response(response: Response::HTTP_UNAUTHORIZED, description: "Unauthorized", content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            "meta" => [
                                "code" => Response::HTTP_UNAUTHORIZED,
                                "status" => "fails",
                                "message" => "The provided credentials are incorrect.!"
                            ],
                            "user" => [],
                            "access_token" => [
                                "token" => '',
                                "type" => "Bearer"
                            ]
                        ])
                    ]
                )),
            ]
        )
    ]
    private function swagger_login()
    {
    }
}
