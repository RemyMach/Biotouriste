<?php

namespace App\Http\Middleware;

use Closure;

class SessionAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('user')) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
