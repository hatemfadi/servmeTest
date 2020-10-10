<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;
use League\OAuth2\Server\Middleware\AuthorizationServerMiddleware as Authorizer;

class Controller extends BaseController
{
    /**
     * handle success message logic
     *
     * @param $data
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data, $code){
        return response()->json(['data' => $data], $code);
    }

    /**
     * handle error message logic
     *
     * @param $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($message, $code){
        return response()->json(['message' => $message], $code);
    }

    /**
     * @return mixed
     */
    protected function getUserId(){
        return Auth::user()->id;
    }
}
