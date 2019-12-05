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

    public function register(Request $request1)
    {
        $data = request()->all();

        $data['api_token'] = config('api.api_admin_password');
        $data['idUser'] = config('api.api_admin_id');


        $client = new Client();
        $request = $client->request('POST','http://localhost:8001/api/user/store',
            ['form_params' => $data
            ]);
        $response = json_decode($request->getBody()->getContents());


        if($response->status === "400")
        {
            return redirect($this->redirectTo);
        }

        $User_attributes_array = json_decode(json_encode($response->user),true);
        $user = new User($User_attributes_array);
        $user->idUser = $response->user->idUser;

        session(['user' => $user]);

        //que $this->registered($request1, $user) soit vrai ou false on redirect
        return $this->registered($request1, $user)
            ?: redirect($this->redirectTo);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => ['required', 'string', 'max:45'],
            'user_surname' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_postal_code' => ['integer'],
            'user_phone' => ['unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_img' => ['string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $data['Status_User_idStatus_User'] = 1;
        $data['password'] = Hash::make($data['password']);
        $data['api_token'] = Str::random(80);
        unset($data['password_confirmation']);
        unset($data['_token']);
        return User::create($data);
    }

    protected function registered(Request $request,User $user)
    {
        event(new Registered($user));
    }
}
