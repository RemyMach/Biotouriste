<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;


class JsonController extends Controller
{

    public static function mergeJsonBodyInRequest($request){

        if($request->has('body')){
            $body = $request->input('body');
            $request->merge($body);

            return $request;
        }
    }
}