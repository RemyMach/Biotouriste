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

        $listUserExistingOnlyIfmultipleDiscountCode = $this->request->input('string_list_idUser');
        //ou discount_code_iduser

        $this->convertFormatlistUserInIdUserArray($listUserExistingOnlyIfmultipleDiscountCode);

        $validator = $this->validateDiscount_Code($listUserExistingOnlyIfmultipleDiscountCode);

        if($validator->original['status'] == '400') {
            return $validator;
        }

        $this->setValidData($emailExistingOnlyIfUserAuthentified, $usefullController);

        $this->contact = Contact::create($this->validData);
        $this->sendCreatedEmail($mail);

        return response()->json([
            'message'   => 'Your Contact has been register',
            'status'    => '200',
            'check'     => $this->contact,
        ]);
    }
}