<?php

namespace App\Http\Middleware;

use Closure;

class TouristController
{
    private $auth;

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
        $this->auth =
            $this->active_status ?
                (preg_match('#(controller|tourist)#i',$this->active_status->status_user_label))
                : 0;

        if($this->auth === 1){
            return $next($request);
        }

        return redirect()->route('login');
    }
}
