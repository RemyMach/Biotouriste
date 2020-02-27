<?php

namespace App\Http\Controllers;

use App\Discount_Code;
use App\Repositories\Discount_CodeRepository;
use App\Repositories\PaymentRepository;
use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class Discount_CodeController extends Controller
{
    private $sessionUser;

    public function __construct(){
        /*$this->middleware('admin')->only(
           'store'
        );*/

        /*$this->middleware('SessionAuth')->only(
            'checkDiscountCodeIsValid','updateStatus','showDiscountCodeOfAUser'
        );*/
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('testDiscountCode');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
        $data = request()->all();


        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');


        $query = $client->request('POST','http://localhost:8001/api/discount_code/store',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testDiscount_code',["response" => $response]);
    }

    public function testStore(Request $request, Client $client)
    {
        //$data = request()->all();
        $data['discount_code_amount'] = 20;
        $data['minimum_amount'] = 20;
        $data['expiration_time'] = '30days';
        $data['periode_minimum_amount'] = '20days';
        $data['OneOrMultipleUser'] = 'one';
        $data['idUserDiscount_codeBeneficiary'] = 2;

        $UserIdAndSumPaymentAmount = PaymentRepository::filterPaymentDateAndPaymentAmountByUser('2019-09-24',30);

        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');


        $query = $client->request('POST','http://localhost:8001/api/discount_code/store',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testDiscount_code',["response" => $response]);
    }

    public function updateStatus(Request $request, Client $client){

        $this->sessionUser = $request->session()->get('user');

        //$data = request()->all();
        $data['idDiscount_code'] = 1;
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;


        $query = $client->request('POST','http://localhost:8001/api/discount_code/isUseFalseToTrue',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testDiscount_code',["response" => $response]);
    }

    public function checkDiscountCodeIsValid(Request $request, Client $client){

        $this->sessionUser = $request->session()->get('user');

        //$data = request()->all();
        $data['idDiscount_code'] = 1;
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;


        $query = $client->request('POST','http://localhost:8001/api/discount_code/checkDiscountCodeIsValid',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testDiscount_code',["response" => $response]);
    }

    public function showDiscountCodeOfAUser(Request $request, Client $client){

        $this->sessionUser = $request->session()->get('user');

        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;


        $query = $client->request('POST','http://localhost:8001/api/discount_code/showDiscountCodeOfAUser',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testDiscount_code',["response" => $response]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discount_Code  $discount_Code
     * @return \Illuminate\Http\Response
     */
    public function show(Discount_Code $discount_Code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discount_Code  $discount_Code
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount_Code $discount_Code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discount_Code  $discount_Code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount_Code $discount_Code)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discount_Code  $discount_Code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount_Code $discount_Code)
    {
        //
    }
}
