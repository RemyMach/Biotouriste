<?php

namespace App\Http\Middleware\API;

use Closure;
use App\Http\Controllers\API\ApiTokenController;

class JsonInRequest
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param ApiTokenController $apiTokenController
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->has('body')){
            $body = $request->input('body');
            $request->merge($body);

        }

        return $next($request);
    }
}
