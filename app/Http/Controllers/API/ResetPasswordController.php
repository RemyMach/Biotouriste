<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\Controller;
use App\password_resets;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function showResetForm(ApiTokenController $apiTokenController)
    {
        $requestParameters = $apiTokenController->verifyAdminCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }

        $data = request()->all();

        if(!$this->validTokenAndEmail())
        {
            return response()->json([
            'message'   => 'Your credentials are not valid',
            'status'    => '400',
            ]);
        }

        return response()->json([
            'message'   => 'Your credentials are valid',
            'status'    => '200'
        ]);
    }

    public function reset(ApiTokenController $apiTokenController)
    {
        $requestParameters = $apiTokenController->verifyAdminCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }
        $data = request()->all();

        $validate = $this->validateEmailPassword($data);

        if($validate->original['status'] == '400')
        {
            return $validate;
        }

        if(!$this->validTokenAndEmail())
        {
            return response()->json([
                'error'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }


        $user = User::where('email',$data['email'])->first();

        if(!$user)
        {
            return response()->json([
                'error'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }

        $user->update(['password' => Hash::make($data['password'])]);

        $this->deleteLineUsePasswordReset($data['email']);

        return response()->json([
            'error'   => 'The password has been updated',
            'status'    => '200',
        ]);
    }

    public function validTokenAndEmail()
    {
        $token = request('token');
        $email = request('email');
        if(!$token || !$email)
        {
            return false;
        }

        $password_reset = password_resets::where('email',$email)->first();


        if(!$password_reset)
        {
            return false;
        }

        if($password_reset->email != $email)
        {
            return false;
        }

        return true;
    }

    protected function validateEmailPassword($data)
    {
        $validator = Validator::make($data, [
            'email' => ['required','email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

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

    protected function deleteLineUsePasswordReset($email)
    {
        //supprime toutes les lignes ou l'email est présent et pas seulement la première rencontré
        password_resets::where('email',$email)->delete();
    }

}