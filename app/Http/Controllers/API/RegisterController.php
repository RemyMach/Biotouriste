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
    private $seller;

    public function __construct()
    {
        $this->middleware('apiAdmin');
    }

    public function store(Request $request, UsefullController $usefullController)
    {
        $this->request = $request;

        $validator = $this->validateUser();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        $validData = $this->setValidDateDependingOnTheUserStatus($usefullController);

        $validData['password'] = Hash::make($validData['password']);
        $validData['api_token'] = Str::random(80);

        $user = User::create($validData);

        $this->createSellerIfUserHasSellerStatus($validData, $user);

        return response()->json([
            'message'   => 'the User has been Register',
            'status'    => '200',
            'user'      => $user,
            'seller'    => $this->seller
        ]);
    }

    private function validateUser(){

        $rules = $this->setRulesDependingOnUserStatus();

        $validator = Validator::make($this->request->all(), $rules);

        return $this->resultValidator($validator);
    }

    private function setRulesDependingOnUserStatus(){

        $rules = [
            'user_name' => ['required', 'string', 'max:45'],
            'user_surname' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_postal_code' => '[integer','regex:/^(\d\d(\s)?){4}(\d\d)$/]',
            'user_phone' => ['unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_img' => ['string'],
            'status_user' => 'required|integer|max:2',
        ];

        if($this->request->input('status_user') == 1){

            $rules ['seller_description'] = 'required|string|max:255';
        }

        return $rules;
    }

    private function resultValidator($validator){

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
            'status'    => '200'
        ]);
    }


    private function setValidDateDependingOnTheUserStatus($usefullController){

        $validData = $usefullController->keepKeysThatWeNeed($this->request->all(),
            ['user_name','user_surname','email','user_postal_code','user_phone','password','user_img']
            );

        if($this->request->input('status_user') == 1){

            $validData['Status_User_idStatus_User'] = 3;
            $validData['seller_description'] = $this->request->input('seller_description');
        }else{

            $validData['Status_User_idStatus_User'] = 1;
        }

        return $validData;

    }

    private function createSellerIfUserHasSellerStatus($validData, $user){

        if($validData['Status_User_idStatus_User'] === 3) {
            //appel à la fonction pour store un Seller
            $sellerController = new SellerController();
            $this->seller = $sellerController->createSeller($validData, $user);
        }
    }
}