<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    private $auth;

    private $user;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->user = $request->session()->get('user');
        $this->auth =
            $this->user ?
                (preg_match('#admin#i',$this->user->status['status_user_label']))
                : 0;

        if($this->auth === 1){
            return $next($request);
        }

        return redirect()->route('login');
    }
}
