<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\Controller;
use App\password_resets;
use App\Seller;
use App\User;
use App\User_Status_Correspondence;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User_Status_CorrespondenceController extends Controller
{

    public function __construct(){

        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'update'
        );
    }

    public function createUserStatusCorrespondence($status_User_idStatus_User, $user){

        $data['Status_User_idStatus_User'] = $status_User_idStatus_User;
        $data['Users_idUser'] = $user->idUser;

        $UserStatusCorrespondance = User_Status_Correspondence::create($data);

        return $UserStatusCorrespondance;
    }

    public function UserStatus(){

        //on part du User et on récupère tout ses statuts
        //on les renvoies en json
    }
}