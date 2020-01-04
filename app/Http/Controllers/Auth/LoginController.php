<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\StatusUserRepository;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */



    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $Request, Client $client)
    {
        $data = request()->all();

        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');

        $query = $client->request('POST','http://localhost:8001/api/user/login', [
            'form_params' => $data
            ]);
        $response = json_decode($query->getBody()->getContents());

        if($response->status === '400')
        {
            return redirect('login');
        }

        session([
            'user'          => $response->user,
            'allStatus'     => $response->user_status,
            'active_status' => $response->user_current_status,
        ]);

        return redirect($this->redirectTo);
    }

    public function testLogin(Request $request, Client $client){

        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');
        $data['email'] = 'touristSeller@touristSeller.fr';
        $data['password'] = 'azertyuiop';

        $query = $client->request('POST','http://localhost:8001/api/user/login', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());

        if($response->status === '400')
        {
            dd('pomme');
            return redirect('login');
        }

        session([
            'user'          => $response->user,
            'allStatus'     => $response->user_status,
            'active_status' => $response->user_current_status,
        ]);

        dd($request->session()->get('active_status'));
        return redirect($this->redirectTo);

    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->forget('allStatus');
        $request->session()->forget('active_status');

        return $this->loggedOut($request) ?: redirect('/');
    }
}
