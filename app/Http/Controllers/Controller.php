<?php

namespace App\Http\Controllers;

/**
* @OA\Info(
*      version="1.0.0",
*      title="My Articles",
*      description="My Articles Description",
*      @OA\Contact(
*          email="taiwo_soewu.1995@ymail.com"
*      ),
*      @OA\License(
*          name="Apache 2.0",
*          url="http://www.apache.org/licenses/LICENSE-2.0.html"
*      )
* )
*
* @OA\Server(
*      url=L5_SWAGGER_CONST_HOST,
*      description="Demo API Server"
* )

*
* @OA\Tag(
*     name="Articles",
*     description="API Endpoints of Articles. Postman Url is https://www.getpostman.com/collections/4382c3395a389aa1ebd9"
* )
*/

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
