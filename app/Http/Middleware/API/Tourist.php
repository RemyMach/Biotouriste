<?php

namespace App\Http\Middleware\API;

use Closure;
use App\Http\Controllers\API\ApiTokenController;

class Tourist
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
        $role = 'TouristController';
        $apiTokenController = new ApiTokenController();
        $requestParameters = $apiTokenController->verifyRoleCredentials($role);

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
