<?php

namespace App\Traits\Http\Controllers\Api;

use Illuminate\Http\Response;
use OpenApi\Annotations\Parameter;
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
                                    "Todo_id" => 1,
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
                                        "Todo_id" => 1,
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
    #[
        OA\Get(
            path: '/api/todos/{id}',
            description: 'Get todo',
            tags: ['Todos'],
            security: [
                [
                    'bearerAuth' => []
                ]
            ],
            parameters: [new OA\Parameter(name: 'id', in: 'query', required: true, description: ' Get todo')],
            requestBody: new  OA\RequestBody(
                content: new OA\MediaType(
                    mediaType: 'application/json',

                )
            ),
            responses: [
                new OA\Response(response: Response::HTTP_OK, description: 'Todo deleted successfully!', content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            'meta' => [
                                'code' => Response::HTTP_OK,
                                'status' => 'success',
                                'message' => 'Todo deleted successfully!',
                            ],
                            'data' => [
                                'user' => []
                            ],
                            'access_token' => [],
                        ])
                    ]
                )),
                new OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: "Validation errors", content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            "success" => false,
                            "message" => "Validation errors",
                            "data" => [
                                "id" => [
                                    "The id field is required."
                                ],
                            ]
                        ])
                    ]
                )),
                new OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Todo not Found', content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            'message' => 'Error! Todo not found!'
                        ])
                    ]
                )),

            ]
        )
    ]
    private function swagger_todo(): void
    {
    }

    #[
        OA\Put(
            path: '/api/todos',
            description: 'Update Todo',
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
                        required: ['id', 'name'],
                        properties: [
                            new OA\Property(property: 'id', description: 'ID', type: 'string'),
                            new OA\Property(property: 'name', description: 'Todo Name', type: 'string'),
                            new OA\Property(property: 'status', description: 'Status', type: 'string'),
                        ]
                    ),
                    example: [

                        "id" => 1,
                        "name" => "Todos Updated",
                        "status" => 0,


                    ]
                )
            ),
            responses: [
                new OA\Response(response: Response::HTTP_ACCEPTED, description: 'Todo updated successfully!', content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            "meta" => [
                                "code" => 202,
                                "status" => "success",
                                "message" => "Todo updated successfully!"
                            ],
                            "data" => [
                                "todo" => [
                                    "id" => 1,
                                    "name" => "Updated Todo",
                                    "status" => 1,
                                    "created_at" => "2024-07-29T17:18:41.000000Z",
                                    "updated_at" => "2024-07-29T17:53:34.000000Z"
                                ],

                            ],
                        ]),
                    ]
                )),
                new OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: "Validation errors", content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            "success" => false,
                            "message" => "Validation errors",
                            "data" => [
                                "id" => [
                                    "The id field is required."
                                ],
                            ]
                        ])
                    ]
                )),
                new OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Todo successfully!', content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            'meta' => [
                                'code' => Response::HTTP_NOT_FOUND,
                                'status' => 'fails',
                                'message' => 'Todo not found!',
                            ],
                            'data' => [
                                'Todo' => []
                            ],
                        ])
                    ]
                )),
                new OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthenticated', content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            "message" => "Unauthenticated."
                        ])
                    ]
                )),
            ]
        )
    ]
    private function swagger_todo_update(): void
    {
    }
    #[
        OA\Delete(
            path: '/api/todos',
            description: 'Delete todo',
            tags: ['Todos'],
            security: [
                [
                    'bearerAuth' => []
                ]
            ],
            requestBody: new  OA\RequestBody(
                required: true,
                content: new OA\MediaType(
                    mediaType: 'application/json',
                    schema: new OA\Schema(
                        required: ['id'],
                        properties: [new OA\Property(property: 'id', description: 'User ID', type: 'int')]
                    ),
                    example: [
                        'id' => 1
                    ]
                )
            ),
            responses: [
                new OA\Response(response: Response::HTTP_OK, description: 'Todo deleted successfully!', content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            'meta' => [
                                'code' => Response::HTTP_OK,
                                'status' => 'success',
                                'message' => 'Todo deleted successfully!',
                            ],
                            'data' => [
                                'user' => []
                            ],
                            'access_token' => [],
                        ])
                    ]
                )),
                new OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: "Validation errors", content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            "success" => false,
                            "message" => "Validation errors",
                            "data" => [
                                "id" => [
                                    "The id field is required."
                                ],
                            ]
                        ])
                    ]
                )),
                new OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Todo not Found', content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'object', example: [
                            'message' => 'Error! Todo not found!'
                        ])
                    ]
                )),

            ]
        )
    ]
    private function swagger_user_delete(): void
    {
    }
}
