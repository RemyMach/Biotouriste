<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\Controller;
use App\password_resets;
use App\Repositories\StatusUserRepository;
use App\Seller;
use App\Status_User;
use App\User;
use App\User_Status_Correspondence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User_Status_CorrespondenceController extends Controller
{
    private $request;
    private $status;

    public function __construct(){

        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'update'
        );

        $this->middleware('apiAdmin')->only(
            'addUserStatusAdminOrController'
        );
    }

    public function changeDefaultUserStatus(Request $request){

        $this->request = $request;

        $validator = $this->validateDefaultStatus();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        $resultCheck = $this->checkIfDefaultStatusIsAStatusUser();
        if($resultCheck->original['status']  == '400'){
            return $resultCheck;
        }

        $checkupdate = $this->updateDefaultStatusIfNeeded();

        return $checkupdate;
    }

    public function createUserStatusCorrespondence($status_User_idStatus_User, User $user, $valueDefaultStatus){

        $data['Status_User_idStatus_User'] = $status_User_idStatus_User;
        $data['Users_idUser'] = $user->idUser;
        $data['default_status'] = $valueDefaultStatus;

        $UserStatusCorrespondance = User_Status_Correspondence::create($data);

        return $UserStatusCorrespondance;
    }

    public static function getAllStatusFromAnUser($idUser){

        $allStatus = StatusUserRepository::getAllStatusUserLabelFromAnUser($idUser);

        if(!isset($allStatus[0])){

            return response()->json([
                'message'   => 'You doesn\'t have status contact administrator with contact form',
                'status'    => '400'
            ]);
        }

        return response()->json([
            'message'   => 'there is your status ',
            'status'    => '200',
            'allStatus' => $allStatus
        ]);
    }

    public static function getCurrentStatus($idUser, $allStatus){

        $current_status = StatusUserRepository::getDefaultStatus($idUser);

        if(!isset($current_status[0])){

            User_Status_Correspondence::where('idUser_Status_Correspondence',$allStatus[0]->idUser_status_Correspondence)
                ->update(['default_status' => true]);

            return $allStatus[0];
        }

        return $current_status[0];
    }

    public function addUserStatusTouristOrSeller(Request $request){

        $this->request = $request;

        $validator = $this->validateNewStatus();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        $user = User::where('idUser','=',$this->request->input('idUser'))->first();

        $resultVerifAndCreation = $this->VerificationThatTheUserCanHaveThisStatus($user);
        if($resultVerifAndCreation->original['status'] == '400') {
            return $resultVerifAndCreation;
        }

        $this->createSellerDependingNewStatus($user);

        return $resultVerifAndCreation;
    }

    public function addUserStatusAdminOrController(Request $request){

        $this->request = $request;

        $validator = $this->validateNewStatusAndUser();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        $user = User::where('idUser','=',$this->request->input('idUserWithNewStatus'))->first();
        if(!isset($user)){

            return response()->json([
                'message'   => 'Your user doesn\'t exist',
                'status'    => '400'
            ]);
        }

        return $this->VerificationThatTheUserCanHaveThisStatus($user);
    }

    private function VerificationThatTheUserCanHaveThisStatus($user){

        $status = Status_User::where('status_user_label','=',$this->request->input('new_status'))->first();

        if(!$this->checkIfNewStatusIsValid($user->idUser)){

            return response()->json([
                'message'   => 'You already have this status',
                'status'    => '400'
            ]);
        }

        $this->createUserStatusCorrespondence($status->idStatus_User, $user, false);

        return response()->json([
            'message'   => 'Your new status is available',
            'status'    => '200',
            'allStatus' => $status
        ]);
    }

    private function validateDefaultStatus(){

        $validator = Validator::make($this->request->all(), [
            'default_status' => ['required','string','regex:/^(tourist|seller|controller|admin)$/']
        ]);

        return $this->resultValidator($validator);
    }

    private function validateNewStatusAndUser(){

        $validator = Validator::make($this->request->all(), [
            'new_status' => ['required','string','regex:/^(Admin|Controller)$/'],
            'idUserWithNewStatus' => ['required','integer']
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

    private function checkIfDefaultStatusIsAStatusUser(){

        $this->status = StatusUserRepository::checkIfUserHasThisStatus(
            $this->request->input('idUser'),$this->request->input('default_status')
        );

        if(!isset($this->status[0])){

            return response()->json([
                'message'   => 'The User doesn\'t has this Status',
                'status'    => '400',
            ]);
        }

        $this->status = $this->status[0];

        return response()->json([
            'status'    => '200',
        ]);
    }

    private function updateDefaultStatusIfNeeded(){

        if($this->status->default_status != true){

            if(!$this->updateCurrentDefaultStatus()){

                return response()->json([
                    'message'   => 'The User doesn\'t has default Status yet',
                    'status'    => '400',
                ]);
            }

            User_Status_Correspondence::where('idUser_Status_Correspondence',$this->status->idUser_status_Correspondence)
                ->update(['default_status' => true]);


            return response()->json([
                'message'   => 'The Update is done',
                'status'    => '200',
                'default_status' => $this->status
            ]);
        }

        return response()->json([
            'message'   => 'This status is the Default Status',
            'status'    => '400',
        ]);
    }

    private function updateCurrentDefaultStatus(){

        $currentDefaultStatus = StatusUserRepository::getDefaultStatus($this->request->input('idUser'));

        if(!isset($currentDefaultStatus[0])){

            return false;
        }

        User_Status_Correspondence::where('idUser_Status_Correspondence',$currentDefaultStatus[0]->idUser_status_Correspondence)
            ->update(['default_status' => false]);

        return true;
    }

    private function validateNewStatus(){

        if($this->request->input('new_status') == 'Seller'){

           $rules['seller_description'] = ['required','string','max:255'];
        }

        $rules['new_status'] = ['required','string','regex:/^(Tourist|Seller)$/'];

        $validator = Validator::make($this->request->all(), $rules);

        return $this->resultValidator($validator);
    }

    private function checkIfNewStatusIsValid($idUser){

        $allStatus = self::getAllStatusFromAnUser($idUser);
        foreach($allStatus->original['allStatus'] as $status){
            if($status->status_user_label == $this->request->input('new_status')){
                return false;
            }
        }
        return true;
    }

    private function createSellerDependingNewStatus($user){

        if($this->request->input('new_status') == 'Seller'){

            SellerController::createSeller(
                $this->request->all(), $user
            );
        }
    }
}