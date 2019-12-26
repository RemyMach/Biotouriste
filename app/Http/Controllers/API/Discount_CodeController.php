<?php

namespace App\Http\Controllers\API;

use App\Contact;
use App\Discount_Code;
use App\Http\Controllers\API\NoApiClass\UsefullController;
use App\Http\Controllers\Controller;
use App\Repositories\Discount_CodeRepository;
use App\Repositories\PaymentRepository;
use App\Services\Mail;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\API;

class Discount_CodeController extends Controller
{
    private $request;
    private $discount_code;
    private $validData;
    private $user;
    private $users;

    public function __construct(){

        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'DiscountCodesOfAUser','isUseFalseToTrue'
        );

        $this->middleware('apiAdmin')->only(
            'DiscountCodesOfAUser','store'
        );
    }

    public function store(Request $request, Mail $mail){

        $this->request = $request;

        $validator = $this->validateDiscount_Code();

        if($validator->original['status'] == '400') {
            return $validator;
        }

        $limitDate = $this->buildLimitDate($this->request->input('expiration_time'),'+');
        $this->setAllUsersThatCorrespondOrTheUser();

        $this->validData['is_use'] = false;
        $this->validData['discount_code_expiration_date'] = $limitDate;
        $this->validData['discount_code_amount'] = $this->request->input('discount_code_amount');

        $this->createDiscountCodeForUsers();

        $this->sendCreatedEmail($mail);

        return response()->json([
            'message'   => 'Your Discount_Code has been register',
            'status'    => '200',
            'check'     => $this->validData,
        ]);
    }

    public function isUseFalseToTrue(Request $request){

        $this->request = $request;

        $DiscountCodeValid = $this->checkDiscountCodeIsValid($request);
        if($DiscountCodeValid->original['status'] == 400){

            return $DiscountCodeValid;
        }

        $this->discount_code->update(['is_use' => true]);

        return response()->json([
            'message'   => 'Your Discount_code has been update',
            'status'    => '200',
            'check'     => $this->discount_code,
        ]);

    }

    public function showDiscountCodeOfAUser(Request $request){

        $this->request = $request;
        $DiscountCodes = Discount_CodeRepository::allDiscountCodesValidForAUser($this->request->input('idUser'));
        @$FirstDiscountCode = $DiscountCodes[0];
        if(!isset($FirstDiscountCode)){

            return response()->json([
                'message'   => 'No Discount codes for this User',
                'status'    => '400',
            ]);
        }

        return response()->json([
            'message'   => 'Your receive your discount_code',
            'status'    => '200',
            'discount_codes'     => $DiscountCodes,
        ]);
    }

    public function checkDiscountCodeIsValid(Request $request){

        $this->request = $request;

        if(!$this->verifyOwnerDiscount_code()){
            return response()->json([
                'message'   => 'This Discount_Code isn\'t for this User',
                'status'    => '400',
            ]);
        }

        if(!$this->checkValidExpirationDate()){
            return response()->json([
                'message'   => 'This Discount_Code expiration date is past',
                'status'    => '400',
            ]);
        }

        if($this->discount_code->is_use){
            return response()->json([
                'message'   => 'This Discount_Code has been used',
                'status'    => '400',
            ]);
        }

        return response()->json([
            'message'   => 'This Discount_Code is valid',
            'status'    => '200',
            'discount_code' => $this->discount_code
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
            'discount_code_amount'      => 'required|integer|max:50',
            'expiration_time'           => 'required|string',
            'OneOrMultipleUser'         => 'required|string',
            'minimum_amount'            => 'required|integer',
            'periode_minimum_amount'    => ['required','string','regex:/^[0-9]+(day|days|month|year|years)$/']
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

        if($this->request->input('OneOrMultipleUser') === 'multiple'){
            return true;
        }

        return false;
    }

    private function setAllUsersThatCorrespondOrTheUser(){
        if($this->testIfMultipleUser()){
            $limitDateForpaymentClacul = $this->buildLimitDate($this->request->input('periode_minimum_amount'),'-');
            $minimum_amount = $this->request->input('minimum_amount');
            $UserIdAndSumPaymentAmount = PaymentRepository::filterPaymentDateAndPaymentAmountByUser($limitDateForpaymentClacul,$minimum_amount);
            $this->users = $this->getUsersFromAnIdUserList($UserIdAndSumPaymentAmount);
        }

        $this->user = User::findOrFail($this->request->input('idUserDiscount_codeBeneficiary'));
    }

    private function buildLimitDate($date, $operation){

        $currentDate = new DateTime(date('Y-m-d'));
        $currentDate->modify($operation.$date);

        return $currentDate->format('Y-m-d');
    }

    private function getUsersFromAnIdUserList($UserIdAndSumPaymentAmount){

        foreach($UserIdAndSumPaymentAmount as $item){
            $users[] = User::findOrfail($item->Users_idUser);
        }

        return $users;
    }

    private function createDiscountCodeForUsers(){
        if(isset($this->users)){
            foreach($this->users as $user){
                $this->validData['Users_idUser'] = $user->idUser;
                Discount_Code::create($this->validData);
            }
        }else{
            $this->validData['Users_idUser'] = $this->request->input('idUserDiscount_codeBeneficiary');
            Discount_Code::create($this->validData);
        }
    }

    private function sendCreatedEmail($mail){

        if(isset($this->users)){
            foreach($this->users as $user){
                $mail->send($user->email,'Discount_CodeCreatedForUser',['user' => $user,'date' => $this->validData['discount_code_expiration_date']]);
            }
        }else{
            $mail->send($this->user->email,'Discount_CodeCreatedForUser',['user' => $this->user,'date' => $this->validData['discount_code_expiration_date']]);
        }
    }

    private function verifyOwnerDiscount_code(){

        $this->discount_code = Discount_Code::findOrFail($this->request->input('idDiscount_code'));
        if(!$this->discount_code)
        {
            return false;
        }
        if($this->request->input('idUser') != $this->discount_code->user->idUser)
        {
            return false;
        }

        return true;
    }

    private function checkValidExpirationDate(){

        if(isset($this->discount_code->discount_code_expiration_date)){
            return true;
        }

        $currentDate = new DateTime(date('Y-m-d'));
        if($this->discount_code->discount_code_expiration_date < $currentDate->format('Y-m-d')){
            return false;
        }

        return true;
    }

}