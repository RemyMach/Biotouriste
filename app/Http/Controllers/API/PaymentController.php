<?php


namespace App\Http\Controllers\API;


use App\Http\Resources\User as UserResource;
use App\Repositories\StatusUserRepository;
use App\User;
use App\User_Status_Correspondence;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Cartalyst\Stripe\Stripe;
Use Cartalyst\Stripe\Exception\CardErrorException;
Use Cartalyst\Stripe\Exception\InvalidRequestException;
Use Cartalyst\Stripe\Exception\UnauthorizedException;
Use Cartalyst\Stripe\Exception\BadRequestException;
Use Cartalyst\Stripe\Exception\NotFoundException;
Use Cartalyst\Stripe\Exception\ServerErrorException;

class PaymentController extends Controller
{
    private $request;

    public function __construct()
    {
        $this->middleware('apiMergeJsonInRequest');
    }

    public function getidforcard(Request $request)
    {

        $strip = Stripe::make(env('STRIPE_SECRET'));
        /*$stripe = response()->json(['version' => $strip->getVersion(),
                                    'apiKey' => $strip->getApiKey(),
                                    'apiVersion' => $strip->getApiVersion(),
                                    'idempotencykey' => null,
                                    'accountId' => null,
                                    'appInfo' => null
        ]);*/

        $orderdate = explode('/', $request->get("ccExpiry"));
        try {
            $tokenfrompost = $strip->tokens()->create([
                'card' => [
                    'number' => $request->get('card_no'),
                    'exp_month' => $orderdate[0],
                    'exp_year' => $orderdate[1],
                    'cvc' => $request->get('cvvNumber'),
                ],
            ]);
        } catch (CardErrorException $e) {
            return response()->json([
                'message' => 'Error',
                'status' => '400',
                'error' => $e->getMessage(),
            ]);
        }


        //return $tokenfrompost;

        return $this->chargePaymentStripe($request, $tokenfrompost);
    }

    public function chargePaymentStripe($request, $tokenfrompost)
    {
        $ordervalue = $request->get('announcesammount1') + $request->get('announcesammount2') + $request->get('announcesammount3');

        $strip = Stripe::make(env('STRIPE_SECRET'));


        if (!isset($tokenfrompost)) {
            return redirect()->route('addmoney.paymentstripe');
        }
        try {
            $charge = $strip->charges()->create([
                'card' => $tokenfrompost['id'],
                'currency' => 'eur',
                'amount' => $ordervalue,
            ]);


            /*return response()->json([
                'message' => 'Validate',
                'status' => '200',
                'user' => $request->get('ordervalue'),
            ]);*/
            return $this->addpaymentindb($request, $charge);
        } catch (CardErrorException $e) {
            return response()->json([
                'message' => 'Error',
                'status' => '400',
                'error' => $e->getMessage(),
            ]);
        } catch (InvalidRequestException $e) {
            return response()->json([
                'message' => 'Error',
                'status' => '400',
                'error' => $e->getMessage(),
            ]);
        } catch (UnauthorizedException $e) {
            return response()->json([
                'message' => 'Error',
                'status' => '400',
                'error' => $e->getMessage(),
            ]);

        } catch (BadRequestException $e) {
            return response()->json([
                'message' => 'Error',
                'status' => '400',
                'error' => $e->getMessage(),
            ]);

        } catch (NotFoundException $e) {
            return response()->json([
                'message' => 'Error',
                'status' => '400',
                'error' => $e->getMessage(),
            ]);

        } catch (ServerErrorException $e) {
            return response()->json([
                'message' => 'Error',
                'status' => '400',
                'error' => $e->getMessage(),
            ]);

        }
    }

    public function addpaymentindb($request, $charge)
    {

        $mytime = Carbon::now();
        $i = 1;
        $id_orderunique = preg_replace("/[^0-9,.]/", "", $mytime);
        $id_user = $request->get('idUser');
        $id_order = "$id_user$id_orderunique";
        $nbannounces = $request->get('nbannouncesorder');

        while ($i != $nbannounces + 1) {
            $payment_status = $charge['status'];
            $payment_amount = $request->get("announcesammount$i");
            $payment_currency = $charge['currency'];
            $order_quantity = $request->get("quantityorderannounce$i");
            $Announces_idAnnounce = $request->get("idAnnounces$i");
            DB::table('Payments')->insert(
                ['payment_status' => $payment_status,
                    'payment_amount' => $payment_amount,
                    'payment_currency' => $payment_currency,
                    'payment_date' => $mytime,
                    'order_quantity' => $order_quantity,
                    'id_order' => $id_order,
                    'Users_idUser' => $id_user,
                    'Announces_idAnnounce' => $Announces_idAnnounce
                ]);
            $i = $i + 1;
        }
        return response()->json([
            'message' => 'Error',
            'status' => '400',
            'error' => 'enfinnnnn',
        ]);
    }

    public function showUserPayment(Request $request){

        
        $result = DB::select(DB::raw("SELECT   * FROM Payments,Announces  where Users_idUser = $idUser"));
        $result = DB::table('Payments , Announces')
            ->select(DB::raw("* where Users_idUser = $idUser"))
            ->get();
    }
}
