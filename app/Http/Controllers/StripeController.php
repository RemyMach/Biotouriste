<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use App\User;
use Stripe\Error\Card;

class StripeController extends Controller
{
    protected $request;

    public function index()
    {
        return view('Payment');
    }

    public function stripe(Request $Request, Client $client)
    {
        $data = $Request->all();
        $announces = session()->get('cart');

        $iduser = session()->get('user');
        $iduser = get_object_vars($iduser);
        $data['idUser'] = $iduser['idUser'];
        $data['api_token'] = $iduser['api_token'];
          $data['nbannouncesorder'] = session()->get('number');
        foreach ($announces as $key => $announce) {
            $data["announces"][] =
                [
                    'idAnnounce' => $announce['idAnnounce'],'quantityorderannounce' =>$announce['announce_quantity'] , 'announcesammount' => $announce['announce_price']
                ];
        }


        $query = $client->request('POST','http://localhost:8001/api/payment/stripe', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());




        if($response->status === '400')
        {
            return view('Payment')->with('response' , $response);
        }
        else{

            return view('ValidatePayment')->with('response' , $response);

        }


    }
    public function showpayments(Request $Request, Client $client){

        $data = $Request->all();
        $iduser = session()->get('user');
        $iduser = get_object_vars($iduser);
        $data['idUser'] = $iduser['idUser'];

        $query = $client->request('POST','http://localhost:8001/api/payment/showUserPayment', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

    }

}
