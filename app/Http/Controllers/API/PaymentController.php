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
        $i = 2;
        $nbannounces = $request->get('nbannouncesorder');
        $ordervalue = $request->get('announcesammount1');
        while ($i != $nbannounces + 1) {
            $ordervalue =  $ordervalue + $request->get("announcesammount$i");
            $i++;
        }

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
            $e = 'No error';
            return $this->addpaymentindb($request, $charge ,$e);
        } catch (CardErrorException $e) {
            $charge['status'] = 'failed';
            $charge['currency'] = 'eur';
            return $this->addpaymentindb($request, $charge ,$e);
        } catch (InvalidRequestException $e) {
            $charge['status'] = 'failed';
            $charge['currency'] = 'eur';
            return $this->addpaymentindb($request, $charge ,$e);
        } catch (UnauthorizedException $e) {
            $charge['status'] = 'failed';
            $charge['currency'] = 'eur';
            return $this->addpaymentindb($request, $charge ,$e);
        } catch (BadRequestException $e) {
            $charge['status'] = 'failed';
            $charge['currency'] = 'eur';
            return $this->addpaymentindb($request, $charge ,$e);
        } catch (NotFoundException $e) {
            $charge['status'] = 'failed';
            $charge['currency'] = 'eur';
            return $this->addpaymentindb($request, $charge ,$e);
        } catch (ServerErrorException $e) {
            $charge['status'] = 'failed';
            $charge['currency'] = 'eur';
            return $this->addpaymentindb($request, $charge ,$e);
        }

    }

    public function addpaymentindb($request, $charge, $e)
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
        if($charge['status'] == 'succeeded'){
            return response()->json([
                'message' => 'Bien ajouté a la db et le paiment est bien passé',
                'status' => '200',
                'request' => $request
            ]);
        }
        else {
            return response()->json([
                'message' => 'Bien ajouté a la db mais le paiment n est pas passé',
                'status' => '400',
                'error' => $e,
            ]);
        }
    }

    public function showUserPayment(Request $request){

        //$idUser = $request->get('idUser');
        $idUser = 1;
        $result = DB::select(DB::raw("SELECT  * FROM Payments , Announces  where Payments.Users_idUser = $idUser and Announces.idAnnounce = Payments.Announces_idAnnounce"));
        return response()->json([
            'message' => 'Recuperations des valeurs dans la db',
            'error' => $result,
        ]);
    }
}
