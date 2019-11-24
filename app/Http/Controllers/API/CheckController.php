<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

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

    public function statusChecks($checks)
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
}