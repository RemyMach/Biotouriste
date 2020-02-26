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
    private $status_User_idStatus_User;

    public function __construct()
    {
        $this->middleware('apiMergeJsonInRequest');
        $this->middleware('apiAdmin');
    }

    public function store(Request $request, UsefullController $usefullController, User_Status_CorrespondenceController $User_Status_CorrespondenceController)
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
        $User_Status_CorrespondenceController->createUserStatusCorrespondence($this->status_User_idStatus_User, $user,true);
        $this->createSellerIfUserHasSellerStatus($validData, $user);

        $checkStatus = User_Status_CorrespondenceController::getAllStatusFromAnUser($user->idUser);
        if($checkStatus->original['status'] == '400'){
            return $checkStatus;
        }

        $current_status = User_Status_CorrespondenceController::getCurrentStatus($user->idUser, $checkStatus->original['allStatus']);

        return response()->json([
            'message'   => 'the User has been Register',
            'status'    => '200',
            'user'                  => $user,
            'user_current_status'   => $current_status,
            'user_status'           => $checkStatus->original['allStatus']
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:Users'],
            'user_postal_code' => ['integer'],
            'user_phone' => ['unique:Users','regex:/^(\d\d(\s)?){4}(\d\d)$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_img' => ['string'],
            'status_user' => ['required','string','regex:/^(Tourist|Seller)$/'],
        ];

        if($this->request->input('status_user') == 'Seller'){

            $rules['seller_description'] = 'required|string|max:255';
            $rules['seller_adress'] = 'required|string|max:60';
            $rules['seller_postal_code'] = 'required|integer|max:99999';
            $rules['seller_adress'] = 'required|string|max:60';
        }

        return $rules;
    }

    private function resultValidator($validator){

        if($validator->fails())
        {
            return response()->json([
                'message'   => 'The request is not good',
                'error'     => $validator->errors(),
                'status'    => '400'
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

        if($this->request->input('status_user') == 'Seller'){

            $this->status_User_idStatus_User = 3;
            //appel à une fonction qui crée dans User_Status_Correspondences une ligne avec le user et son statut
            $validData['seller_description'] = $this->request->input('seller_description');
            $validData['seller_adress'] = $this->request->input('seller_adress');
            $validData['seller_postal_code'] = $this->request->input('seller_postal_code');
            $validData['seller_city'] = $this->request->input('seller_city');
        }else{
            $this->status_User_idStatus_User = 1;
        }

        return $validData;

    }

    private function createSellerIfUserHasSellerStatus($validData, $user){

        if($this->status_User_idStatus_User === 3) {
            //appel à la fonction pour store un Seller
            $this->seller = SellerController::createSeller($validData, $user);
        }
    }
}
