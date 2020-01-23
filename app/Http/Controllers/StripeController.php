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
use Cartalyst\Stripe;

class StripeController extends Controller
{
    protected $request;

    public function paymentStripe()
    {
        return view('Payment');
    }

    public function stripe(Request $Request, Client $client)
    {
        $data = request()->all();

        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');


        $query = $client->request('POST','http://localhost:8001/api/payment/stripe', [
            'form_params' => $data
        ]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);
        if($response->status === '400')
        {
            return redirect('pay');
        }
        else {
            echo "<pre>";
            print_r($query);
            exit();
        }


        return redirect($this->redirectTo);
    }
    public function tokenPaymentStripe(Request $request)
    {
        $stripe = Stripe\Stripe::make(env('STRIPE_SECRET'));
        dd($stripe->getConfig()->getVersion());
        $orderdate = explode('/', $request->get("ccExpiry"));

        $tokenfrompost = $stripe->tokens()->create([
            'card' => [
                'number' => $request->get('card_no'),
                'exp_month' => $orderdate[0],
                'exp_year' => $orderdate[1],
                'cvc' => $request->get('cvvNumber'),
            ],
        ]);
                    echo "<pre>";
                    print_r($tokenfrompost);
                    exit();
                    return redirect()->route('addmoney.paymentSstripe');
    }

    public function chargePaymentStripe($tokenfrompost,$amount){
        $stripe = Stripe\Stripe::make(env('STRIPE_SECRET'));
        if (!isset($tokenfrompost)) {
        return redirect()->route('addmoney.paymentstripe');
        }
        try {
            $charge = $stripe->charges()->create([
                'card' => $tokenfrompost['id'],
                'currency' => 'EUR',
                'amount' => $amount,
            ]);


            if ($charge['status'] == 'succeeded') {
                $status = "succeeded";
                $currency = $charge['currency'];
                $idUser = 1;
                $idAnnouce = 5;
                return app()->make(PaymentController::class)->callAction('store', [$status,$currency,$idUser,$idAnnouce,$amount]);
                //return $this->app('App\Http\Controllers\PaymentController')->store($charge,$idUser,$idAnnouce,$amount);
                //return view('payment');
                }
            else {
                    echo "<pre>";
                    print_r($charge);
                    exit();
                    return redirect()->route('addmoney.paymentSstripe');
            }
        }
        catch (\Cartalyst\Stripe\Exception\CardErrorException        $e) {
            echo "<pre>";
            print_r($e);
            exit();
            //\Session::put('error',$e->getMessage());
            //return redirect()->route('addmoney.paymentsstripe');
        } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
            echo "<pre>";
            print_r($e);
            exit();
            //\Session::put('error',$e->getMessage());
            //return view('payment');
        } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            //\Session::put('error',$e->getMessage());
            echo "<pre>";
            print_r($e);
            exit();
            //return redirect()->route('addmoney.paymentsssssstripe');
        }
    }
}