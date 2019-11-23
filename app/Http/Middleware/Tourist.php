<?php

namespace App\Http\Middleware;

use Closure;

class Tourist
{
    private $auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->auth =
            auth()->user() ?
                (preg_match('#controller|tourist#i',auth()->user()->status['status_user_label']))
                : 0;

        if($this->auth === 1){
            return $next($request);
        }

        return redirect()->route('login');
    }
}
