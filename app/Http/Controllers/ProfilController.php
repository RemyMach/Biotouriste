<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProfilController extends Controller
{

    private $sessionUser;
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

    public function profil(Client $client, Request $request)
    {
        $data = request()->all();
        if(!$request->session()->has('user')){

            return redirect('register');
        }
        $this->sessionUser = $request->session()->get('user');

        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST', 'http://localhost:8001/api/user/profil', ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());
        //dd($request->session()->all());
        if ($response->status === '400'){
            return response()->json(['error' => $response->error]);
        }

        return view('Profil', [
            'allProfils' => ['Tourist', 'Seller'],
            'payments' => $response->payments,
            'profil' => $response->profil[0],
        ]);

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
