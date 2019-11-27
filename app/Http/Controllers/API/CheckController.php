<?php

namespace App\Http\Controllers\API;

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

        $checks = $this->collectChecks($requestParameters['idUser']);

        if(!$checks){
            return response()->json([
                'message'   => 'Vous n\'avez fait aucun check et vous n\'en avez pas en attente',
                'status'    => '200',
            ]);
        }

        $arrayChecks = $this->statusChecks($checks);

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

        $this->verifyUserStatus($requestParameters['idUser']);

        $data = request()->all();

        $validator = $this->validateCheck($data);

        if($validator->original['status'] == '400')
        {
            return $validator;
        }

        $validData = $usefullController->keepKeysThatWeNeed($data,[
            'check_date','check_comment','check_customer_service',
            'check_state_place','check_quality_product','check_bio_status'
        ]);
        //controller
        $validData['Users_idUser'] = $data['idUser'];
        //vendeur
        $validData['Users_idUser1'] = $data['idSeller'];
        //vérification que c'est bien un vendeur



    }

    public function verifyUserStatus($idUser)
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

    public function collectChecks($idUser)
    {
        $user = User::findOrFail($idUser);

        $checks = $user->checks;

        if(!$checks)
        {
            return false;
        }

        return $checks;
    }

    protected function statusChecks($checks)
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

    protected function validateCheck($data)
    {
        $validator = Validator::make($data, [
            'check_date'                => 'required',
            'check_comment'             => 'required|text',
            'check_customer_service'    => 'required|integer|max:5',
            'check_state_place'         => 'required|integer|max:5',
            'check_quality_product'     => 'required|integer|max:5',
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

    protected function keepKeysThatWeNeed()
    {

    }
}