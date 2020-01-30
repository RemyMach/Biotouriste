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

    public function paymentStripe()
    {
        return view('Payment');
    }

    public function stripe(Request $Request, Client $client)
    {
        $data = $Request->all();


        /*$data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;
        $data['nbannouncesorder'] = $this->sessionUser->nbannouncesorder;
        $data['idAnnounces1'] = $this->sessionUser->idAnnounces;
        $data['quantityorderannounce1'] = $this->sessionUser->idAnnounces;
        $data['announcesammount1'] = $this->sessionUser->idAnnounces;
        $data['idAnnounces2'] = $this->sessionUser->idAnnounces;
        $data['quantityorderannounce2'] = $this->sessionUser->idAnnounces;
        $data['announcesammount2'] = $this->sessionUser->idAnnounces;
        */
        $data['idUser'] = 1;
        $data['api_token'] = '4zUV8HQIW8ChZym9BZjWmqLPCzeoVbJPIMbMn52vJ7HFfGC88agKMJThZ3AUFkJL1ywhTcFDCq5NVmIr';
        $data['nbannouncesorder'] = 2;
        $data['idAnnounces1'] = 4;
        $data['quantityorderannounce1'] = 1;
        $data['announcesammount1'] = 5.99;
        $data['idAnnounces2'] = 4;
        $data['quantityorderannounce2'] = 4;
        $data['announcesammount2'] = 10;



        $query = $client->request('POST','http://localhost:8001/api/payment/stripe', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());

        if($response->status === '400')
        {
            return redirect()->route('pay', [$response->error]);
        }
        else{


        }


        return redirect($this->redirectTo);
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
