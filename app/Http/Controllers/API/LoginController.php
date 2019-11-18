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
    public function login()
    {
        $validator = $this->validateLogin(request()->all());

        if($validator->fails())
        {
            $response = response()->json([
                'message'   => 'The request is not good',
                'error'     => $validator->errors(),
                'status'    => "400"
            ]);
            return $response->getOriginalContent();
        }

        $user = $this->tryToAuthenticateByEmail();

        if(!$user)
        {
            $response = response()->json([
                'message'   => 'Your login or your password is not correct',
                'error'     => $validator->errors(),
                'status'    => "400"
            ]);
            return $response->getOriginalContent();
        }

        if(!$this->verifyPassword($user,request('password')))
        {
            $response = response()->json([
                'message'   => 'Your login or your password is not correct',
                'error'     => $validator->errors(),
                'status'    => "400"
            ]);
            return $response->getOriginalContent();
        }

        return response()->json([
            'message'   => 'You are now register',
            'status'    => '200',
            'user'      => $user[0]
        ]);
    }

    protected function validateLogin($data)
    {
        $validator = Validator::make($data, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
        return $validator;
    }

    protected function username()
    {
        return 'email';
    }

    protected function tryToAuthenticateByEmail()
    {
        $user = User::where('email',request('email'))->get();

        if($user){
            return $user;
        }
        return null;
    }

    protected function verifyPassword($user,$requestPassword)
    {
        $validateCredentials = Hash::check($requestPassword,$user[0]->password);

        if(!$validateCredentials)
        {
            return false;
        }
        return true;
    }
}