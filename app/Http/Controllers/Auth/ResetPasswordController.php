<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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

    public function showResetForm(Request $request)
    {
        $data = request()->all();

        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');

        $client = new Client();

        $query = $client->request('POST','http://localhost:8001/api/user/showResetForm', [
            'form_params' => $data
        ]);

        $response = json_decode($query->getBody()->getContents());

        if($response->status == '400')
        {
            return back()->with(['error' => 'Votre email n\'existe pas']);
        }

        return view('auth.passwords.reset')->with(
            ['token' => $request->token, 'email' => $request->email,"succes" => 'Votre mot de passe a bien été reset']
        );
    }

    public function reset(Request $request)
    {
        $data = request()->all();

        $data['api_token'] = 'UqYJEF0wUazDsX0HbR9wDXoAf1YWlLI3WRvGyXrkfUcvRseMnUYxFL4xUmLvuy3Uw9Fx1BqU53Rfraeq';
        $data['idUser'] = 5;

        $client = new Client();

        $query = $client->request('POST','http://localhost:8001/api/user/reset', [
            'form_params' => $data
        ]);

        $response = json_decode($query->getBody()->getContents());

        if($response->status == '400')
        {
            return back()->with(['error' => $response->error]);
        }
        return redirect('login')->with(
            ['email' => $request->email,"succes" => 'Votre mot de passe a bien été reset']
        );
    }
}
