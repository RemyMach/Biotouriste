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
        return view('paymentstripe');
    }
    public function postPaymentStripe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            //'amount' => 'required',
        ]);
        $input = $request->all();
        if ($validator->passes()) {
            $input = array_except($input,array('_token'));
            $stripe = Stripe\Stripe::make(env('STRIPE_SECRET'));
            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year' => $request->get('ccExpiryYear'),
                        'cvc' => $request->get('cvvNumber'),
                    ],
                ]);
                if (!isset($token['id'])) {
                    return redirect()->route('addmoney.paymentstripe');
                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'EUR',
                    'amount' => 20.49,
                    'description' => 'wallet',
                ]);

                if($charge['status'] == 'succeeded') {
                    echo "<pre>";
                    print_r($charge);exit();
                    return redirect()->route('addmoney.paymentstripe');
                } else {
                    echo "<pre>";
                    print_r($charge);exit();
                    return redirect()->route('addmoney.paymentstripe');
                }
            }catch (Exception $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('addmoney.paymentstripe');
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('addmoney.paywithstripe');
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->route('addmoney.paymentstripe');
            }
        }
    }
}