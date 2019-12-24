<?php

namespace App\Http\Controllers\API;

use App\Contact;
use App\Discount_Code;
use App\Http\Controllers\API\NoApiClass\UsefullController;
use App\Http\Controllers\Controller;
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

        $limitDate = $this->buildLimitDateWithperiode_minimum_amount();

        $this->findAllUsersThatCorrespondOrTheUser($limitDate);

        $validData['is_use'] = false;
        $validData['discount_code_expiration_date'] = $limitDate;
        $validData['discount_code_amount'] = $this->request->input('discount_code_amount');


        //on donne au tableau de User le discount_code
        $this->attributeDiscountCode($validData);

        //envoie de mail pour dire t'as un code discount.
        /*$this->sendCreatedEmail($mail);*/

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
            'discount_code_amount'      => 'required|integer|max:50',
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

    private function findAllUsersThatCorrespondOrTheUser($limitDate){
        if($this->testIfMultipleUser()){
            $minimum_amount = $this->request->input('minimum_amount');
            $UserIdAndSumPaymentAmount = $this->getIdUserAndTotalPaymentAmountSinceADateAndSuperiorToAnAmount($limitDate, $minimum_amount);

            $this->users = $this->getUsersFromAnIdUserList($UserIdAndSumPaymentAmount);
        }

        $this->user = User::findOrFail('idUserDiscount_codeBeneficiary');
    }

    private function buildLimitDateWithperiode_minimum_amount(){

        $dateValue = $this->request->input('periode_minimum_amount');

        $currentDate = new DateTime(date("Y-m-d"));
        $currentDate->modify('+'.$dateValue);

        return $currentDate->format('Y-m-d');
    }

    private function getIdUserAndTotalPaymentAmountSinceADateAndSuperiorToAnAmount($limitDate, $minimum_amount){

        $UserIdAndSumPaymentAmount = DB::table('payments')->join('Users','payments.Users_idUser','=','Users.idUser')
            ->select('payments.Users_idUser',DB::raw('SUM(payment_amount) as total'))
            ->where('payment_date','>',$limitDate)->where('payment_status','=','valid')->groupBy('Users.idUser')->havingRaw('total > ?', [$minimum_amount])->get();

        return $UserIdAndSumPaymentAmount;
    }

    private function getUsersFromAnIdUserList($UserIdAndSumPaymentAmount){
        foreach($UserIdAndSumPaymentAmount as $item){
            $users[] = User::findOrfail($item->Users_idUser);
        }

        return $users;
    }

    private function attributeDiscountCode($validData){
        if(isset($this->users)){
            foreach($this->users as $user){
                $validData['Users_idUser'] = $user->idUser;
                Discount_Code::create($validData);
            }
        }

        $validData['Users_idUser'] = 'idUserDiscount_codeBeneficiary';
    }
}