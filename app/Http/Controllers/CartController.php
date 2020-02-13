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
        $prout = ['idAnnounce' => 1, "announce_name" => "Test1", 'announce_quantity' => 3 , 'announce_price' => "25.88"];
        $request->session()->push('cart', $prout);
        $prout = ['idAnnounce' => 3, "announce_name" => "Test3", 'announce_quantity' => 2 , 'announce_price' => "2.88"];
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
        $nbannouces = count($cart);
        if($cart === 0){
            return redirect('cart');
        }

        session()->put('number', $nbannouces);
        return redirect('stripe');
    }

    public function qantmore(Request $request){
        $index = $request->get('index');
        $announces = session()->get('cart');
        $announces[$index]['announce_quantity'] = $announces[$index]['announce_quantity'] + 1;
        session()->put('cart', $announces);
        return redirect()->route('cart');
    }

    public function qantless(Request $request)
    {
        $index = $request->get('index');
        $announces = session()->get('cart');
        $announces[$index]['announce_quantity'] = $announces[$index]['announce_quantity'] - 1;
        if ($announces[$index]['announce_quantity'] === 0) {
            return redirect('cart');
        }elseif (DB::table('Announces')->select('announce_quantity')->where("idAnnounce == $announces[$index]['idAnnounce']")->get() ){

        } else {
            session()->put('cart', $announces);
            return redirect()->route('cart');
        }
    }
}
