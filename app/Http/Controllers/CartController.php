<?php

namespace App\Http\Controllers;

use App\Announce;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

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
        $announce = Announce::find($request->get('idAnnounce'));
        $request->session()->push('cart', $announce);

        return redirect('cart');
     }

    public function remove(Request $request){
        $cart = session()->get('cart');
        $index = $request->get('index');
        unset($cart[$index]);
        session()->put('cart', $cart);
        $announces = session()->get('cart');
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
        $id = $announces[$index]['idAnnounce'];
        $qantall = DB::table('Announces')->select('announce_lot')->where('idAnnounce', '=' , $id)->get();
        foreach ($qantall as $qantalll){
            $qantall = $qantalll->announce_lot;
        }
        if ($qantall < $announces[$index]['announce_quantity']){
            return redirect('cart');
        }
        else {
            session()->put('cart', $announces);
            return redirect()->route('cart');
        }
    }

    public function qantless(Request $request)
    {
        $index = $request->get('index');
        $announces = session()->get('cart');
        $announces[$index]['announce_quantity'] = $announces[$index]['announce_quantity'] - 1;
        if ($announces[$index]['announce_quantity'] === 0) {
            return redirect('cart');
        }
        else {
            session()->put('cart', $announces);
            return redirect()->route('cart');
        }
    }
}
