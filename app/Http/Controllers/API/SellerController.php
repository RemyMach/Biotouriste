<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\Controller;
use App\password_resets;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{

    private $request;

    public function __construct(){

        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'update'
        );

        $this->middleware('apiAdmin')->only(
            'updateBioStatus'
        );
        $this->middleware('apiSeller')->only(
            'updateSellerDescription'
        );
    }

    public static function createSeller($validData, $user){

        $data['seller_product_bio'] = false;
        $data['seller_verify'] = false;
        $data['seller_description'] = $validData['seller_description'];
        $data['Users_idUser'] = $user->idUser;

        $seller = Seller::create($data);

        return $seller;
    }

    public function updateReverseBioStatus(Request $request){

        $this->request = $request;

        $validator = $this->validateIdSeller();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        $seller = Seller::find($this->request->input('idSeller'))->first();
        if(!isset($seller)){

            return response()->json([
                'message'   => 'Your seller doesn\'t exist or is already a bio Seller',
                'status'    => '400'
            ]);
        }

        if($seller->seller_verify == false){
            $seller->update(['seller_verify' => true]);
        }

        $seller->update(['seller_product_bio' => !$seller->seller_product_bio]);

        return response()->json([
            'message'   => 'The statusBio has been update',
            'status'    => '200',
            'seller'    =>  $seller
        ]);
    }

    public function updateSellerDescription(Request $request){

        $this->request = $request;

        $validator = $this->validateSellerDescription();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        $seller = Seller::where('Users_idUser','=',$this->request->input('idUser'))->first();

        $seller->update(['seller_description' => $this->request->input('seller_description')]);

        return response()->json([
            'message'   => 'The description has been update',
            'status'    => '200',
            'seller'    =>  $seller
        ]);
    }

    private function validateIdSeller(){

        $validator = Validator::make($this->request->all(), [
            'idSeller' => ['required','integer']
        ]);

        return $this->resultValidator($validator);
    }

    private function validateSellerDescription(){

        $validator = Validator::make($this->request->all(), [
            'seller_description' => ['required','string','max:255']
        ]);

        return $this->resultValidator($validator);
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

}