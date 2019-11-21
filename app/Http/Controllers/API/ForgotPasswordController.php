<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    public function sendResetLinkEmail()
    {

        //on valide l'email
        $email = request('email');
        $validator = $this->validateEmail(['email' => $email]);

        if($validator != true){

            return $validator;
        }

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

        $urlgenerate = action('ResetPasswordController@reset', ['token' => $token,'email' => $email]);

        $url = preg_replace('#8001#','8000',$urlgenerate);

        return $url;
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
            return $response = response()->json([
                'message'   => 'The request is not good',
                'error'     => $validator->errors(),
                'status'    => "400"
            ]);
        }
        return true;
    }

    protected function addTokenEmailToDB(string $token, string $email)
    {

    }
}