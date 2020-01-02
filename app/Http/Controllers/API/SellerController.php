<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\Controller;
use App\password_resets;
use App\Seller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{

    public function __construct(){

        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'update'
        );
    }

    public function createSeller($validData, $user){

        $data['seller_product_bio'] = 0;
        $data['seller_description'] = $validData['seller_description'];
        $data['Users_idUser'] = $user->idUser;

        $seller = Seller::create($data);

        return $seller;
    }

    public function update(){

    }


}