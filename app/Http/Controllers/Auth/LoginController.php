<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    public function login(Request $FormRequest)
    {
        $data = request()->all();

        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');

        $client = new Client();
        $request = $client->request('POST','http://localhost:8001/api/user/login', [
            'form_params' => $data
            ]);
        $response = json_decode($request->getBody()->getContents());

        if($response->status === "400")
        {
            return redirect('login');
        }

        $User_attributes_array = json_decode(json_encode($response->user),true);
        $user = new User($User_attributes_array);
        $user->idUser = $response->user->idUser;

        session(['user' => $user]);

        return redirect($this->redirectTo);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');

        return $this->loggedOut($request) ?: redirect('/');
    }
}
