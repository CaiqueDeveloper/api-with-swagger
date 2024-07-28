<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "Api With Swagger",
    version: "1.0.0",
    description: 'Esta é uma API com objetivo de aprender mais sobre uso do swagger',
)]

#[OA\Contact(email: 'caiquebispodanet86@gmail.com')]

#[OA\SecurityScheme(
    securityScheme: "bearerAuth",
    in: "header",
    name: "bearerAuth",
    type: "http",
    scheme: "bearer",
    bearerFormat: "JWT",
)]
#[OA\Server(
    url: L5_SWAGGER_CONST_HOST,
    description: "API Server"
)]
class OpenApi
{
}

abstract class Controller
{
    //
}
