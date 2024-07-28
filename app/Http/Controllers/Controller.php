<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API WITH SWAGGER",
 *      description="Está é uma api, para fins de aprendizado sobre a utilização do swagger",
 *      @OA\Contact(
 *          email="caiquebispodanet86@gmail.com"
 *      )
 * )
 *
 * @OA\SecurityScheme(
 *    securityScheme="bearerAuth",
 *    in="header",
 *    name="bearerAuth",
 *    type="http",
 *    scheme="bearer",
 *    bearerFormat="JWT",
 * ),
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="API Server"
 * )
 */
abstract class Controller
{
    //
}
