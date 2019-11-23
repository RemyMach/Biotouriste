<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Mail\UserForgotPassword;
use App\password_resets;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    public function sendResetLinkEmail()
    {

        //on vérifie que c'est bien l'admin user qui demande l'envoi
        $apiTokenController = new ApiTokenController();

        $requestParameters = $apiTokenController->verifyAdminCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }
        //on valide l'email
        $email = request('email');
        $validator = $this->validateEmail(['email' => $email]);

        if($validator->original['status'] == '400') {
            return $validator;
        }

        $idAdmin = $requestParameters['idUser'];
        $admin_api_token = $requestParameters['api_token'];

        $user = $this->verifyEmailExist($email);

        if(!$user){
            return response()->json([
                'message'   => 'Your email doesn\'t exist',
                'status'    => '400',
            ]);
        }
        $token = Str::random(80);
        $urlgenerate = action('Auth\ResetPasswordController@reset', ['token' => $token,'email' => $email]);

        $urlgenerate = preg_replace('#8001#','8000',$urlgenerate);

        $urlgenerate = preg_replace('#%40#','@',$urlgenerate);

        $urlgenerate = preg_replace('#&amp#','&',$urlgenerate);

        $password_resets = $this->addTokenEmailToDB($token,$email);

        $this->sendEmail($password_resets,$urlgenerate);

        return response()->json([
            'status'    => '200',
        ]);
    }

    public function verifyEmailExist($email)
    {
        $user = User::where('email',$email)->first();

        if(!$user){
            return false;
        }

        return $user;
    }

    protected function validateEmail($data)
    {
        $validator = Validator::make($data, [
            'email' => 'required|email']);

        if($validator->fails())
        {
            return response()->json([
                'message'   => 'The request is not good',
                'error'     => $validator->errors(),
                'status'    => "400"
            ]);
        }
        return response()->json([
            'message'   => 'The request is good',
            'status'    => "200"
        ]);
    }

    protected function addTokenEmailToDB(string $token, string $email)
    {
        $password_reset = password_resets::create(['email' => $email,'token' => $token]);

        return $password_reset;
    }

    protected function sendEmail($password_reset,$url){

        Mail::to('rmachavoine@wynd.eu')->send(new UserForgotPassword($password_reset,$url));
    }
}