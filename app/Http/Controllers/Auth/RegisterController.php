<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request, Client $client)
    {
        $data = request()->all();

        $data['api_token'] = config('api.api_admin_token');
        $data['idUser'] = config('api.api_admin_id');

        $query = $client->request('POST','http://localhost:8001/api/user/store',
            ['form_params' => $data
            ]);
        $response = json_decode($query->getBody()->getContents());

        if($response->status === '400')
        {
            return redirect($this->redirectTo);
        }

        session([
            'user'          => $response->user,
            'allStatus'     => $response->user_current_status,
            'active_status' => $response->user_status,
        ]);

        //que $this->registered($request1, $user) soit vrai ou false on redirect
        return $this->registered($request, $user)
            ?: redirect($this->redirectTo);
    }

    public function testRegister(Request $request, Client $client){

        $data['api_token'] = config('api.api_admin_token');
        $data['idUser'] = config('api.api_admin_id');
        $data['seller_description'] = 'je suis un super vendeur de pomme';
        $data['user_name'] = 'name';
        $data['user_surname'] = 'surname';
        $data['user_adress'] = '12 rue bangbang';
        $data['user_postal_code'] = '95234';
        $data['user_phone'] = '0634526776';
        $data['email'] = 'test@testouille.fr';
        $data['password'] = 'ouligandu29';
        $data['password_confirmation'] = 'ouligandu29';
        $data['status_user'] = 'seller';

        $query = $client->request('POST','http://localhost:8001/api/user/store',
            ['form_params' => $data
            ]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        session([
            'user'          => $response->user,
            'allStatus'     => $response->user_current_status,
            'active_status' => $response->user_status,
        ]);

        dd($request->session()->get('active_status'));
        return $this->registered($request, $user)
            ?: redirect($this->redirectTo);
    }


    protected function registered(Request $request,User $user)
    {
        event(new Registered($user));
    }
}
