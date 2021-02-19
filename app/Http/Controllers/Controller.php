<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @SWG\Swagger(
 *     schemes={"http"},
 *     host="localhost",
 *     basePath="/api/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="NaPopravky",
 *         description="simple REST API",
 *         termsOfService="",
 *         @SWG\Contact(
 *             email="dead4w@gmail.com"
 *         ),
 *     ),
 * )
 */

/**
 *  @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="L5 Swagger OpenApi dynamic host server"
 *  )
 *
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
