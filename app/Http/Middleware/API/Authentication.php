<?php

namespace App\Http\Middleware\API;

use App\Http\Controllers\API\ApiTokenController;
use Closure;

class Authentication
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
        $apiTokenController = new ApiTokenController();
        $requestParameters = $apiTokenController->verifyCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }

        return $next($request);
    }
}
