<?php

namespace App\Http\Controllers\API;

use App\Contact;
use App\Http\Controllers\API\NoApiClass\UsefullController;
use App\Http\Controllers\Controller;
use App\Services\Mail;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\API;

class Discount_CodeController extends Controller
{
    private $request;
    private $discount_code;
    private $validData;
    private $user;

    public function __construct(){

        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'DiscountCodesOfAUser'
        );

        $this->middleware('apiAdmin')->only(
            'DiscountCodesOfAUser','store'
        );
    }

    public function store(Request $request){

        $this->request = $request;

        $validator = $this->validateDiscount_Code();

        if($validator->original['status'] == '400') {
            return $validator;
        }
        //recherche de tous les users qui correspondent puis on les met dans un tableau
        $users = $this->findAllUsersThatCorrespondOrTheUser();

        //on setup is_use à false
        //le discount_code_expiration_date
        //on donne au tableau de User le discount_code
        $this->convertFormatlistUserInIdUserArray($listUserExistingOnlyIfmultipleDiscountCode);


        $this->setValidData($emailExistingOnlyIfUserAuthentified, $usefullController);

        $this->contact = Contact::create($this->validData);
        $this->sendCreatedEmail($mail);

        return response()->json([
            'message'   => 'Your Contact has been register',
            'status'    => '200',
            'check'     => $this->contact,
        ]);
    }

    private function validateDiscount_Code(){

        if($this->testIfMultipleUser()){
            return $this->validatorForMultipleUsers();
        }

        return $this->validatorForOneUser();
    }

    private function validatorForMultipleUsers(){
         $validator = Validator::make($this->request->all(), [
            'discount_code_amount'      => 'required|integer',
            'expiration_time'           => 'required|string',
            'OneOrMultipleUser'         => 'required|string',
            'minimum_amount'            => 'required|integer',
            'periode_minimum_amount'    => 'required|regex:/(^([0-9]+)(day|days|month|year|years)$)/'
         ]);

        return $this->resultValidator($validator);
    }

    private function validatorForOneUser(){
        $validator = Validator::make($this->request->all(), [
            'discount_code_amount'      => 'required|integer',
            'expiration_time'           => 'required|string',
            'OneOrMultipleUser'         => 'required|string',
            'idUserDiscount_codeBeneficiary' => 'required|integer'
        ]);

        return $this->resultValidator($validator);
    }

    private function resultValidator($validator){

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

    private function testIfMultipleUser(){

        if($this->request()->input('OneOrMultipleUser') === 'multiple'){
            return true;
        }

        return false;
    }

    private function findAllUsersThatCorrespondOrTheUser(){
        if($this->testIfMultipleUser()){
            $limitDate = $this->buildLimitDateWithperiode_minimum_amount();
            //recherche de tous les users qui ont fait plus de X euros de order dans la période now()-periode_minimum_amount
            //select * from User where idUser IN(
            //  select Users_idUser,SUM(payment_amount) as total_amount from Payment where payment_date > $limite_date and payment_status = valid GROUP BY Users_idUser having total_amount > $minimum_amount
            //);
            //
        }

        $this->user = User::findOrFail('idUserDiscount_codeBeneficiary');
    }

    private function buildLimitDateWithperiode_minimum_amount(){

        $dateValue = $this->request->input('periode_minimum_amount');

        $currentDate = new DateTime(date("Y-m-d"));
        $currentDate->modify('+'.$dateValue);

        return $currentDate->format('Y-m-d');
    }
}