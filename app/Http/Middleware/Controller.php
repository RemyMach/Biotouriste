<?php

namespace App\Http\Middleware;

use Closure;

class Controller
{
    private $active_status;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->active_status = $request->session()->get('active_status');

        if(preg_match('#(controller|admin)#i',$this->active_status->status_user_label)){

            return $next($request);
        }

        return redirect()->route('login');
    }
}
