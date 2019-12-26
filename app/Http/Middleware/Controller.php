<?php

namespace App\Http\Middleware;

use Closure;

class Controller
{
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

        if(preg_match('#(controller|admin)#i',$this->user->status['status_user_label'])){

            return $next($request);
        }

        return redirect()->route('login');
    }
}
