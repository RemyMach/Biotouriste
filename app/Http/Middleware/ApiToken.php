<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;

class ApiToken
{
    protected $user;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return 'pomme';
        dd($request->route());
        $this->user = $request->session()->get('user');

        $api_token = request('api_token');

        if(!$this->user || !$api_token)
        {
            return request()->all();
        }
        $client = new Client();
        $request = $client->get('http://localhost:8001/api/verifyApiToken?api_token=');
        $responses = json_decode($request->getBody()->getContents());

        return $next($request);
    }
}
