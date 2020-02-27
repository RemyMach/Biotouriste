<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\Controller;
use App\password_resets;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    private $request;

    public function __construct()
    {
        $this->middleware('apiMergeJsonInRequest');
        $this->middleware('apiTokenAndIdUserExistAndMatch');
    }

    public function showResetForm(Request $request)
    {
        $this->request = $request;


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

    public function reset(Request $request)
    {

        $this->request = $request;

        $validate = $this->validateEmailPassword($this->request->all());

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


        $user = User::where('email',$this->request->input('email'))->first();

        if(!$user)
        {
            return response()->json([
                'error'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }

        $user->update(['password' => Hash::make($this->request->input('password'))]);

        $this->deleteLineUsePasswordReset($this->request->input(['email']));

        return response()->json([
            'error'   => 'The password has been updated',
            'status'    => '200',
        ]);
    }

    private function validTokenAndEmail()
    {
        $token = $this->request->input('token');
        $email = $this->request->input('email');
        if(!$token || !$email)
        {
            return false;
        }

        $password_reset = password_resets::where('email',$email)->first();

        if(!$password_reset)
        {
            return false;
        }

        if($password_reset->token != $token)
        {
            return false;
        }

        return true;
    }

    private function validateEmailPassword($data)
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

    private function deleteLineUsePasswordReset($email)
    {
        //supprime toutes les lignes ou l'email est présent et pas seulement la première rencontré
        password_resets::where('email',$email)->delete();
    }

}