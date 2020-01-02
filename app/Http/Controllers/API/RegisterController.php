<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\API\NoApiClass\UsefullController;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    private $request;

    public function __construct()
    {
        $this->middleware('apiAdmin');
    }

    public function store(Request $request, UsefullController $usefullController)
    {
        $this->request = $request;

        $validator = Validator::make($this->request->all(), [
            'user_name' => ['required', 'string', 'max:45'],
            'user_surname' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_postal_code' => ['integer'],
            'user_phone' => ['unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_img' => ['string'],
            'status_user' => 'required|integer'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message'   => 'The request is not good',
                'error'     => $validator->errors(),
                'status'    => "400"
            ]);
        }

        $validData = $this->setValidDateDependingOnTheUserStatus($usefullController);

        $validData['password'] = Hash::make($validData['password']);
        $validData['api_token'] = Str::random(80);
        $user = User::create($validData);

        return response()->json([
            'message'   => 'the User has been Register',
            'status'    => '200',
            'user'      => $user
        ]);
    }

    private function setValidDateDependingOnTheUserStatus($usefullController){

        $validData = $usefullController->keepKeysThatWeNeed($this->request->all(),
            'user_name','user_surname','email','user_postal_code','user_phone','password','user_img'
            );

        if($this->request->input('status') == 1){

            $validData['Status_User_idStatus_User'] = 3;
        }else{

            $validData['Status_User_idStatus_User'] = 1;
        }

        return $validData;

    }
}