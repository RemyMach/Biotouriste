<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Mail\UserForgotPassword;
use App\password_resets;
use App\Services\Mail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    private $request;

    public function __construct(){
        $this->middleware('apiMergeJsonInRequest');
    }

    public function sendResetLinkEmail(Mail $mail,Request $request)
    {
        $this->request = $request;

        $validator = $this->validateEmail();
        if($validator->original['status'] == '400') {
            return $validator;
        }


        $user = $this->verifyEmailExist($this->request->input('email'));

        if(!$user){
            return response()->json([
                'message'   => 'Your email doesn\'t exist',
                'status'    => '400',
            ]);
        }
        $token = Str::random(80);
        $urlgenerate = action('Auth\ResetPasswordController@reset', ['token' => $token,'email' => $user->email]);


        $urlgenerate = preg_replace('#8001#','8000',$urlgenerate);

        $urlgenerate = preg_replace('#%40#','@',$urlgenerate);

        $urlgenerate = preg_replace('#&amp#','&',$urlgenerate);


        $password_resets = $this->addTokenEmailToDB($token,$user->email);

        $this->deleteDuplicateToken();

        $mail->send('rmachavoine@wynd.eu','UserForgotPassword',['password_reset' => $password_resets, 'url' => $urlgenerate]);

        return response()->json([
            'message'   => 'the email has been sent',
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

    private function validateEmail()
    {
        $validator = Validator::make($this->request->all(), [
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

    private function addTokenEmailToDB(string $token, string $email)
    {
        $password_reset = password_resets::create(['email' => $email,'token' => $token]);

        return $password_reset;
    }

    private function deleteDuplicateToken(){

        $password_resets = password_resets::where('email','=',$this->request->input('email'))->get();
        $numberLine = count($password_resets);
        if($numberLine >= 1){
            foreach($password_resets as $key => $password_reset){
                if($numberLine == ($key+1)){
                    break;
                }
                password_resets::destroy($password_reset->idPasswordReset);
            }
        }
        return 'googd';
    }
}