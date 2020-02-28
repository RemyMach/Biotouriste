<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        // $this->middleware('SessionAuth');
        //$this->middleware('apiAdmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
      $session = $request->session()->all();

      if($request->session()->has('successReport')){
          return view('welcome')->with([
              'session'         => $session,
              'successReport'   => $request->session()->get('successReport')
              ]);
      }
      if (isset($session['user'])) {
        return view('welcome')->with('session', $session);

      }

      //récupération des 5 sellers les mieux noté
      //récupération des 3 dernier articles
        return view('welcome');
    }
}
