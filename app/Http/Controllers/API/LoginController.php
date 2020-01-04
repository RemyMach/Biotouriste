<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function __construct()
    {
        //$this->middleware('apiAdmin');
    }

    public function login(ApiTokenController $apiTokenController)
    {
        $validator = $this->validateLogin(request()->all());


        if($validator->fails())
        {
            return response()->json([
                'message'   => 'The request is not good',
                'error'     => $validator->errors(),
                'status'    => "400"
            ]);
        }

        $user = $this->tryToAuthenticateByEmail();

        if(!$user)
        {
            return response()->json([
                'message'   => 'Your login or your password is not correct',
                'error'     => $validator->errors(),
                'status'    => "400"
            ]);
        }

        if(!$this->verifyPassword($user,request('password')))
        {
            return response()->json([
                'message'   => 'Your login or your password is not correct',
                'error'     => $validator->errors(),
                'status'    => "400"
            ]);

        }

            return response()->json([
            'message'   => 'You are now login',
            'status'    => '200',
            'user'      => $user
        ]);

    }

    private function validateLogin($data)
    {
        $validator = Validator::make($data, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
        return $validator;
    }

    private function username()
    {
        return 'email';
    }

    private function tryToAuthenticateByEmail()
    {
        $user = User::where('email',request('email'))->first();

        if($user){
            return $user;
        }
        return null;
    }

    private function verifyPassword($user,$requestPassword)
    {
        $validateCredentials = Hash::check($requestPassword,$user->password);

        if(!$validateCredentials)
        {
            return false;
        }
        return true;
    }
}