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

//        $data['idUser'] = $this->sessionUser->idUser;
//        $data['api_token'] = $this->sessionUser->api_token;
          $data['nbannouncesorder'] = session()->get('number');
        foreach ($announces as $key => $announce) {
            $data["announces"][] =
                [
                    'idAnnounce' => $announce['idAnnounce'],'quantityorderannounce' =>$announce['announce_quantity'] , 'announcesammount' => $announce['announce_price']
                ];
//            $data["quantityorderannounce$key"] = $announce['announce_quantity'];
//            $data["announcesammount$key"] = $announce['announce_price'];;
        }
        $data['idUser'] = 1;
        $data['api_token'] = '4zUV8HQIW8ChZym9BZjWmqLPCzeoVbJPIMbMn52vJ7HFfGC88agKMJThZ3AUFkJL1ywhTcFDCq5NVmIr';
       /* $data['nbannouncesorder'] = 2;
        $data['idAnnounces1'] = 4;
        $data['quantityorderannounce1'] = 1;
        $data['announcesammount1'] = 5.99;
        $data['idAnnounces2'] = 4;
        $data['quantityorderannounce2'] = 4;
        $data['announcesammount2'] = 10;*/
//        dd($data);


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

        //$data['idUser'] = $this->sessionUser->idUser;

        $data['idUser'] = 1;

        $query = $client->request('POST','http://localhost:8001/api/payment/showUserPayment', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

    }

}
