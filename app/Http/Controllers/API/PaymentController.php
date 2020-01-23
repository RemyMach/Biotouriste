<?php


namespace App\Http\Controllers\API;


use App\Http\Resources\User as UserResource;
use App\Repositories\StatusUserRepository;
use App\User;
use App\User_Status_Correspondence;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Cartalyst\Stripe\Stripe;
Use Cartalyst\Stripe\Exception\CardErrorException;
Use Cartalyst\Stripe\Exception\InvalidRequestException;

class PaymentController extends Controller
{
    private $request;
    public function __construct()
    {
        $this->middleware('apiMergeJsonInRequest');
    }

    public function getidforcard(Request $request)
    {


        //$stripe = $request->get('api_key_stripe');
        $strip = Stripe::make(env('STRIPE_SECRET'));
        /*$stripe = response()->json(['version' => $strip->getVersion(),
                                    'apiKey' => $strip->getApiKey(),
                                    'apiVersion' => $strip->getApiVersion(),
                                    'idempotencykey' => null,
                                    'accountId' => null,
                                    'appInfo' => null
        ]);*/

        $orderdate = explode('/', $request->get("ccExpiry"));

        $tokenfrompost = $strip->tokens()->create([
            'card' => [
                'number' => $request->get('card_no'),
                'exp_month' => $orderdate[0],
                'exp_year' => $orderdate[1],
                'cvc' => $request->get('cvvNumber'),
            ],
        ]);


        //return $tokenfrompost;

        return $this->chargePaymentStripe($request,$tokenfrompost);
    }
    public function chargePaymentStripe($request,$tokenfrompost)
    {

        $strip = Stripe::make(env('STRIPE_SECRET'));


        if (!isset($tokenfrompost)) {
            return redirect()->route('addmoney.paymentstripe');
        }
        try {
            $charge = $strip->charges()->create([
                'card' => $tokenfrompost['id'],
                'currency' => 'eur',
                'amount' => 20.00,
            ]);


            return response()->json([
                'message' => 'Validate',
                'status' => '200',
                'user' => $charge,
            ]);
        }
        catch(CardErrorException $e){
            return response()->json([
                'message' => 'Error',
                'status' => '400',
                'error' => $e,
            ]);
        }
        catch(InvalidRequestException $e){
            return response()->json([
                'message' => 'Error',
                'status' => '400',
                'error' => $e->getMessage(),
            ]);
        }
    }


}