<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserForgotPassword;
use App\password_resets;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $data = request()->all();

        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');

        $client = new Client();

        $request = $client->request('POST','http://localhost:8001/api/user/email', [
            'form_params' => $data
        ]);

        $response = json_decode($request->getBody()->getContents());

        if($response->status == '400')
        {
            return back()->with(['error' => 'Votre email n\'existe pas']);
        }

        return view('auth.passwords.email')->with(['error' => 'Vous avez reçu un message pour reset votre mot de passe']);
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    protected function credentials(Request $request)
    {
        //return un tableau associatif avec email comme clé
        return $request->only('email');
    }
}
