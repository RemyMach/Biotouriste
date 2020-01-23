<?php

namespace App\Http\Controllers;
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

    public function apikeystripe(){
      return Stripe\Stripe::make(env('STRIPE_SECRET'));
    }
    public function tokenPaymentStripe(Request $request)
    {

        $stripe =$this->apikeystripe();
        $orderdate = explode('/', $request->get("ccExpiry"));

        $tokenfrompost = $stripe->tokens()->create([
            'card' => [
                'number' => $request->get('card_no'),
                'exp_month' => $orderdate[0],
                'exp_year' => $orderdate[1],
                'cvc' => $request->get('cvvNumber'),
            ],
        ]);
        $amount = 20.5;
        return $this->chargePaymentStripe($tokenfrompost,$amount);
    }

    public function chargePaymentStripe($tokenfrompost,$amount){
        $stripe =$this->apikeystripe();
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
        catch (Exception $e) {
            \Session::put('error',$e->getMessage());
            return redirect()->route('addmoney.paymentsstripe');
        } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
            \Session::put('error',$e->getMessage());
            return view('payment');
        } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            \Session::put('error',$e->getMessage());
            echo "<pre>";
            print_r($e);exit();
            return redirect()->route('addmoney.paymentsssssstripe');
        }
    }
}