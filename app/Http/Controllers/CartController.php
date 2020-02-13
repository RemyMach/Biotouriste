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
        $announces = session()->get('cart');
        return view('cart')->with('announces',$announces);
    }

    public function add(Request $request){

        //$annouce =  $this->sessionUser->cartUser;
        //$newannouces = $request;
//        //Session::forget('cart');
//        $prout = Announce::find([1]);
//        dd($prout);
        $prout = ['idAnnounce' => 1, "announce_name" => "Test1", 'announce_comment' => "Testcomment" , 'announce_price' => "25.88"];
        $request->session()->push('cart', $prout);
        $prout = ['idAnnounce' => 3, "announce_name" => "Test3", 'announce_comment' => "Testcommentblabla" , 'announce_price' => "2.88"];
        $request->session()->push('cart', $prout);
        $announces = $request->session()->get('cart');


//        $announces = json_encode($announces);
//        dd($announces);
        return redirect('cart');
     }

    public function remove(Request $request){
//        dd($request);
        $cart = session()->get('cart');
        $index = $request->get('index');
        unset($cart[$index]);
        session()->put('cart', $cart);
        $announces = session()->get('cart');
//        dd($announces);
        return redirect('cart');
    }


    public function countCart(Request $request){
        $cart = session()->get('cart');
        $cart = count($cart);
        if($cart === 0){
            return redirect('cart');
        }
        dd($cart);
    }
}
