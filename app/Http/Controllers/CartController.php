<?php

namespace App\Http\Controllers;

use App\Announce;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('cart');
    }

    public function add(Request $request){

        //$annouce =  $this->sessionUser->cartUser;
        //$newannouces = $request;
        Session::forget('cart');
        $prout = Announce::find([1,2,3]);
        $request->session()->push('cart', $prout);
        $announces = $request->session()->get('cart');
//        dd($announces);
        return view('cart', ['announces' => $announces[0]]);



     }
     public function show(Request $request){
         $announces = $request->session()->get('cart');
//        dd($announces);
         return view('cart', ['announces' => $announces[0]]);
     }


}
