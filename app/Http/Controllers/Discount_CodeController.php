<?php

namespace App\Http\Controllers;

use App\Discount_Code;
use Illuminate\Http\Request;

class Discount_CodeController extends Controller
{

    public function __construct(){
        $this->middleware('admin')->only(
            'store'
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
