<?php

namespace App\Traits\Http\Controllers\Api;

use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

trait SwaggerTodo
{

    #[
        OA\Post(
            path: '/api/todos',
            description: 'Store an new todo',
            tags: ['Todos'],
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
                        required: ['name'],
                        properties: [
                            new OA\Property(property: 'name', type: 'string', description: 'Name Todo'),
                        ]
                    ),
                    example: [
                        'name' => 'Todo Teste'
                    ]
                )
            ),
            responses: [
                new OA\Response(response: Response::HTTP_CREATED, description: 'Todo updated successfully!', content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            'meta' => [
                                'code' => Response::HTTP_CREATED,
                                'status' => 'success',
                                'message' => 'Todo updated successfully!',
                            ],
                            'data' => [
                                'todo' => [
                                    "id" => 2,
                                    "user_id" => 1,
                                    "name" => "Todo teste",
                                    "updated_at" => "2024-07-29T20:17:01.000000Z",
                                    "created_at" => "2024-07-29T20:17:01.000000Z",
                                ]
                            ],
                        ])
                    ]
                )),
                new OA\Response(response: Response::HTTP_FAILED_DEPENDENCY, description: 'Validation errors', content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            "success" => false,
                            "message" => "Validation errors",
                            "data" => [
                                "name" => [
                                    "The name field is required."
                                ]
                            ]
                        ])
                    ]
                )),

            ]
        )
    ]
    private function swagger_store_todo(): void
    {
    }
    #[
        OA\Get(
            path: '/api/todos',
            description: 'List All todos',
            tags: ['Todos'],
            security: [
                [
                    'bearerAuth' => []
                ]
            ],
            requestBody: new OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',

                )
            ),
            responses: [

                new OA\Response(response: Response::HTTP_ACCEPTED, description: 'List all todos successfully!', content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            "meta" => [
                                "code" => Response::HTTP_ACCEPTED,
                                "status" => "success",
                                "message" => "List all todos successfully!"
                            ],
                            "data" => [
                                "todo" => [
                                    [
                                        "id" => 1,
                                        "user_id" => 1,
                                        "name" => "Todo teste",
                                        "status" => 1,
                                        "created_at" => "2024-07-29T20:13:35.000000Z",
                                        "updated_at" => "2024-07-29T20:13:35.000000Z"
                                    ],
                                    [
                                        "id" => 2,
                                        "user_id" => 1,
                                        "name" => "Todo teste 1",
                                        "status" => 1,
                                        "created_at" => "2024-07-29T20:17:01.000000Z",
                                        "updated_at" => "2024-07-29T20:17:01.000000Z"
                                    ],
                                    [
                                        "id" => 3,
                                        "user_id" => 1,
                                        "name" => "New Todos",
                                        "status" => 1,
                                        "created_at" => "2024-07-29T20:38:20.000000Z",
                                        "updated_at" => "2024-07-29T20:38:20.000000Z"
                                    ]
                                ]
                            ]
                        ])
                    ]

                )),
                new OA\Response(response: Response::HTTP_NO_CONTENT, description: 'List all todos successfully!', content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            "meta" => [
                                "code" => Response::HTTP_NO_CONTENT,
                                "status" => "success",
                                "message" => "List all todos successfully!"
                            ],
                            "data" => [
                                "todo" => []
                            ]
                        ])
                    ]

                )),
            ]
        )
    ]
    private function swagger_all_todos(): void
    {
    }
}
