<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('SessionAuth')->only('index');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $data = $request->session()->all();
        return view('profil')->with('profil', $data);
    }

    public function message(Request $request)
    {
        return view('Message');
    }
    
    public function favorite(Request $request)
    {
        return view('Favorite');
    }
}
