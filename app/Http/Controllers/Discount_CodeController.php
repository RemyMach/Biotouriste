<?php

namespace App\Http\Controllers;

use App\Discount_Code;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class Discount_CodeController extends Controller
{
    public function __construct(){
        $this->middleware('admin')->only(
           'index'
        );
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
        $date = '2019-11-22';
        $value = 50;
        $UserIdAndSumPaymentAmount = DB::table('payments')->join('Users','payments.Users_idUser','=','Users.idUser')->select('payments.Users_idUser',DB::raw('SUM(payment_amount) as total'))
            ->where('payment_date','>',$date)->where('payment_status','=','valid')->groupBy('Users.idUser')->havingRaw('total > ?', [50])->get();

        foreach($UserIdAndSumPaymentAmount as $value){
            $users[] = User::findOrfail($value->Users_idUser);
        }
        dd(count($users));
        //select Users_idUser,SUM(payment_amount) as total from payments join Users on payments.users_idUser = users.idUser
        // where payment_date > '2019-11-24' and payment_status= 'valid'  group by users.idUser having total > 50;
        $data = request()->all();
        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');


        $query = $client->request('POST','http://localhost:8001/api/discount_code/store',
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
