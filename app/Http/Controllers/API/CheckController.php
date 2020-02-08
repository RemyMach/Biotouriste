<?php

namespace App\Http\Controllers\API;

use App\Check;
use App\Http\Controllers\API\NoApiClass\UsefullController;
use App\Http\Controllers\Controller;
use App\Repositories\CheckRepository;
use App\Repositories\StatusUserRepository;
use App\Seller;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\API;

class CheckController extends Controller
{
    private $user;
    private $check;
    private $checks;
    private $validData;
    private $requestData;
    private $request;

    public function __construct()
    {
        $this->middleware('apiMergeJsonInRequest');
        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'UpdateStatusVerification'
        );

        $this->middleware('apiController')->only(
            'showChecksOfAController','controllerSendACompleteCheck'
        );

        $this->middleware('apiAdmin')->only(
            'destroy'
        );
    }

    public function store(Request $request)
    {
        $this->requestData = $request->all();
        $data = request()->all();

        if(!$this->verificationIfCheckIsForASeller($data['idSeller'])){
            return response()->json([
                'message'   => 'Your Check doesn\'t correspond to a seller',
                'status'    => '400',
            ]);
        }

        //date expiration
        $this->validData['check_prevision_date'] = $this->AddSevenDaysToNowInDateTime();
        //vendeur
        $this->validData['Sellers_idSeller'] = $data['idSeller'];

        $this->setValidDataAccordinglyToUserStatus($data);


        $check = Check::create($this->validData);


        return response()->json([
            'message'   => 'Your Check has been register',
            'status'    => '200',
            'check'     => $check,
        ]);

    }

    public function showAllUnDoneChekcs(Request $request){

        $this->request = $request;

        $checksUnDone = CheckRepository::selectCheckUndone();


        return response()->json([
            'status'    => '200',
            'checks'     => $checksUnDone,
        ]);
    }

    public function showChecksOfAController()
    {
        $data = request()->all();

        if(!$this->collectChecks($data['idUser'])){
            return response()->json([
                'message'   => 'Vous n\'avez fait aucun check et vous n\'en avez pas en attente',
                'status'    => '400',
            ]);
        }


        $arrayChecks = $this->statusChecks();

        //utile d'avoir les historique des check
        return response()->json([
            'checks_waiting'        => $arrayChecks['checkWaiting'],
            'checks_In_progress'    => $arrayChecks['checkInProgress'],
            'checks_done'           => $arrayChecks['checkDone'],
            'status'                => '200'
        ]);
    }

    public function controllerSendACompleteCheck(UsefullController $usefullController)
    {
        $this->requestData = request()->all();

        return $this->verifyOwnerCheck();
        if(!$this->verifyOwnerCheck()){
            return response()->json([
                'message'   => 'This Check isn\'t for this User',
                'status'    => '400',
            ]);
        }

        $validator = $this->validateCheck();

        if($validator->original['status'] == '400') {
            return $validator;
        }

        $validData = $usefullController->keepKeysThatWeNeed($this->requestData,[
            'check_date','check_comment','check_customer_service',
            'check_state_place','check_quality_product','check_bio_status',
        ]);

        //status
        $validData['check_status_verification'] = 'done';

        $check = Check::update($validData);

        return response()->json([
            'message'   => 'Your Check has been update',
            'status'    => '200',
            'check'     => $check,
        ]);

    }

    /**The Controller decline the offer of the Admin**/
    public function UpdateStatusVerification(Request $request)
    {
        $this->requestData = $request->all();

        if(!$this->verifyOwnerCheck()){
            return response()->json([
                'message'   => 'This Check isn\'t for this User',
                'status'    => '400',
            ]);
        }

        if(!$this->checkNewStatus()){
            return response()->json([
                'message'   => 'The status is not correct',
                'status'    => '400',
            ]);
        }

        $this->check->update(['check_status_verification' => $this->requestData['status']]);

        return response()->json([
            'message'   => 'Your Check has been update',
            'status'    => '200',
            'check'     => $this->check,
        ]);
    }

    public function destroy(Request $request)
    {
        $this->request = $request;


        if(!$this->verifyIfCheckExist()){
            return response()->json([
                'message'   => 'The Check doesn\'t exists',
                'status'    => '400',
            ]);
        }


        $this->check->delete();

        return response()->json([
            'message'   => 'The check has been deleted',
            'status'    => '200',
            'idUser'    => $this->check
        ]);
    }

    private function verifyIfCheckExist(){

        $this->check = Check::findOrFail($this->request->input('idCheckDelete'));
        if(!$this->check){

            return false;
        }

        return true;
    }

    private function collectChecks($idUser)
    {
        $this->checks = CheckRepository::AllChecksAndSellerInformation($idUser);

        if(!isset($this->checks[0])){
            return false;
        }

        return true;
    }

    private function statusChecks()
    {
        $checkVerify = [];
        $checkInProgress = [];
        $checkWaiting = [];
        foreach ($this->checks as $check){

            if($check->check_status_verification == 'done'){

                $checkVerify[] = $check;
            }
            elseif($check->check_status_verification == 'In progress'){

                $checkInProgress[] = $check;
            }
            elseif($check->check_status_verification == 'waiting'){
                $checkWaiting[] = $check;
            }
        }

        return [
            'checkDone'         => $checkVerify,
            'checkInProgress'   => $checkInProgress,
            'checkWaiting'      => $checkWaiting
        ];
    }

    private function validateCheck()
    {
        $validator = Validator::make($this->requestData, [
            'check_date'                => 'required|date',
            'check_comment'             => 'required|string',
            'check_customer_service'    => 'required|integer|max:5',
            'check_state_place'         => 'required|integer|max:5',
            'check_quality_product'     => 'required|integer|max:5',
            'check_bio_status'          => 'required',
        ]);

        if($validator->fails()) {
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

    private function verificationIfCheckIsForASeller()
    {
        $seller = Seller::findOrFail($this->requestData['idSeller']);

        if(!$seller){
            return false;
        }

        return true;
    }

    private function verifyOwnerCheck()
    {
        $this->check = Check::findOrFail($this->requestData['idCheck']);

        if(!$this->check)
        {
            return false;
        }

        if($this->requestData['idUser'] != $this->check->user->idUser)
        {
            return false;
        }

        return true;
    }

    private function checkNewStatus()
    {
        if(isset($this->requestData['status']))
        {
            return $this->validNewStatusValue();
        }
        return false;
    }

    private function validNewStatusValue(){

        if($this->requestData['status'] == 'decline' || $this->requestData['status'] == 'In progress'){
            return true;
        }
        return false;
    }

    private function AddSevenDaysToNowInDateTime(){

        $currentDate = new DateTime(date("Y-m-d"));
        $currentDate->modify('+7 day');

        return $currentDate->format('Y-m-d');
    }

    private function setValidDataAccordinglyToUserStatus($data)
    {
        $user = User::findOrFail($data['idUser']);

        $current_status = StatusUserRepository::getDefaultStatus($user->idUser);

        if(preg_match('#admin#i',$current_status[0]->status_user_label)){
            //controller car c'est l'admin dans un formulaire qui indique qui fera le control
            $this->validData['Users_idUser'] = $data['idController'];
            //status
            $this->validData['check_status_verification'] = 'waiting';
        }else{

            $this->validData['Users_idUser'] = $data['idUser'];
            //status
            $this->validData['check_status_verification'] = 'In progress';
        }
    }
}