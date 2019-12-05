<?php

namespace App\Http\Controllers\API;

use App\Check;
use App\Http\Controllers\API\NoApiClass\UsefullController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CheckController extends Controller
{
    public function showChecksOfAController(ApiTokenController $apiTokenController)
    {
        $requestParameters = $apiTokenController->verifyCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }

        $UserChecks = $this->collectChecks($requestParameters['idUser']);

        if(!$UserChecks){
            return response()->json([
                'message'   => 'Vous n\'avez fait aucun check et vous n\'en avez pas en attente',
                'status'    => '200',
            ]);
        }

        $arrayChecks = $this->statusChecks($UserChecks);

        return response()->json([
            'checks_to_do'  => $arrayChecks['checkNotVerify'],
            'checks_done'     => $arrayChecks['checkVerify'],
            'status'    => '200'
        ]);
    }

    public function store(ApiTokenController $apiTokenController, UsefullController $usefullController)
    {
        $requestParameters = $apiTokenController->verifyCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }

        if($this->verifyUserStatus($requestParameters['idUser']))
        {
            return response()->json([
                'message'   => 'Your idUser are not valid',
                'status'    => '400',
            ]);
        }

        $data = request()->all();

        if($this->verificationIfItsASeller($data['idSeller']))
        {
            return response()->json([
                'message'   => 'Your idSeller are not valid',
                'status'    => '400',
            ]);
        }

        $validator = $this->validateCheck($data);

        if($validator->original['status'] == '400')
        {
            return $validator;
        }

        $validData = $usefullController->keepKeysThatWeNeed($data,[
            'check_date','check_comment','check_customer_service',
            'check_state_place','check_quality_product','check_bio_status',
        ]);
        //controller
        $validData['Users_idUser'] = $data['idUser'];
        //vendeur
        $validData['Sellers_idSeller'] = $data['idSeller'];

        $check = Check::create($validData);

        return response()->json([
            'message'   => 'Your Check has been register',
            'status'    => '200',
            'check'     => $check,
        ]);

    }

    /**The Controller decline the offer of the Admin**/
    public function UpdateStatusVerification(ApiTokenController $apiTokenController)
    {
        $requestParameters = $apiTokenController->verifyCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }

        $data = request()->all();

        $check = $this->verifyOwnerCheck($data['idUser'],$data['idCheck']);

        if(!$check)
        {
            return response()->json([
                'message'   => 'This Check isn\'t for this User',
                'status'    => '400',
            ]);
        }

        $newStatus = $this->checkNewStatus(request('status'));

        if(!$newStatus)
        {
            return response()->json([
                'message'   => 'The status is not correct',
                'status'    => '400',
            ]);
        }

        $check->update(['check_status_verification' => $newStatus]);

        return response()->json([
            'message'   => 'Your Check has been update',
            'status'    => '200',
            'check'     => $check,
        ]);
    }

    private function verifyUserStatus($idUser)
    {
        $user = User::findOrFail($idUser);

        if(preg_match('#admin#i',$user->status['status_user_label']))
        {
            return $user;
        }
        if(preg_match('#controller#i',$user->status['status_user_label']))
        {
            return $user;
        }
        return false;
    }

    private function collectChecks($idUser)
    {
        $user = User::findOrFail($idUser);

        $checks = $user->checks;

        if(!$checks)
        {
            return false;
        }

        return $checks;
    }

    private function statusChecks($checks)
    {
        $checkNotVerify = [];
        $checkVerify = [];
        foreach ($checks as $check)
        {
            if($check->check_status_verification == 'to do')
            {
                $checkVerify[] = $check;
            }
            else{
                $checkNotVerify[] = $check;
            }
        }

        return [
            'checkNotVerify'    => $checkNotVerify,
            'checkVerify'       => $checkVerify
        ];
    }

    private function validateCheck($data)
    {
        $validator = Validator::make($data, [
            'check_date'                => 'required',
            'check_comment'             => 'required|text',
            'check_customer_service'    => 'required|decimal|max:5',
            'check_state_place'         => 'required|decimal|max:5',
            'check_quality_product'     => 'required|decimal|max:5',
            'check_bio_status'          => 'required|string',
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

    private function verificationIfItsASeller($idSeller)
    {
        $seller = Seller::findOrFail($idSeller);

        if(!$seller){
            return false;
        }

        return true;
    }

    private function verifyOwnerCheck($idUser,$idCheck)
    {
        $check = Check::findOrFail($idCheck);

        if(!$check)
        {
            return false;
        }

        if($idUser == $check->user->id)
        {
            return false;
        }

        return $check;
    }

    private function checkNewStatus($status)
    {
        if(isset($status))
        {
            if($status == 'decline' || $status == 'accept'){
                return $status;
            }
        }

        return false;
    }
}