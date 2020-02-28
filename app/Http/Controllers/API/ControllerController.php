<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\RequestController;
use App\Services\Mail;
use App\User;
use Illuminate\Http\Request;

class ControllerController extends Controller
{
    private $request;

    public function __construct()
    {
        $this->middleware('apiMergeJsonInRequest');
        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'become'
        );
    }

    public function become(Request $request, Mail $mail){

        $this->request = $request;

        $requestController = RequestController::where('Users_idUser',$this->request->input('idUser'))->first();

        if(isset($requestController)){
            return response()->json([
                'message'   => 'You have already sent a demand!',
                'status'    => '400',
            ]);
        }

        $validData['Users_idUser'] = $this->request->input('idUser');
        $validData['requestcontroller_date'] = date('Y-m-d');


        $newRequestController = RequestController::create($validData);
        $this->sendCreatedEmail($mail);

        return response()->json([
            'message'   => 'Your message has been sent !',
            'status'    => '200',
            'check'     => $newRequestController
        ]);
    }

    private function sendCreatedEmail(Mail $mail){

        $user = User::find($this->request->input('idUser'));

        $mail->send($user->email,'RequestControllerCreatedForAnonymous',[$user]);
        $mail->send('bioTourist@gmail.com','RequestControllerCreatedForAdmin',[$user]);
    }
}
