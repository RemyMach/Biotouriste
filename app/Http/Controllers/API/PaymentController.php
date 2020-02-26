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
        $announces = $request->get('announces');
        $ordervalue = 0;
        foreach ($announces as $announce){
            $ordervalue =  $ordervalue + $announce['announcesammount'] * $announce['quantityorderannounce'];
        }

        $strip = Stripe::make(env('STRIPE_SECRET'));

        if (!isset($tokenfrompost)) {
            return redirect()->route('addmoney.paymentstripe');
        }
        try {
            $charge = $strip->charges()->create([
                'card' => $tokenfrompost['id'],
                'currency' => 'usd',
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
        $announces = $request->get('announces');
        $id_orderunique = preg_replace("/[^0-9,.]/", "", $mytime);
        $id_user = $request->get('idUser');
        $id_order = "$id_user$id_orderunique";
        foreach ($announces as $announce){
            DB::table('Payments')->insert(
                ['payment_status' => $charge['status'],
                    'payment_amount' => $announce['announcesammount'],
                    'payment_currency' => $charge['currency'],
                    'payment_date' => $mytime,
                    'order_lot' => $announce['quantityorderannounce'],
                    'id_order' => $id_order,
                    'Users_idUser' => $id_user,
                    'Announces_idAnnounce' => $announce['idAnnounce']
                ]);
        }

        if($charge['status'] == 'succeeded'){
            return response()->json([
                'message' => 'Bien ajouté a la db et le paiment est bien passé',
                'status' => '200',
                'request' => $request,
                'amount' => $charge['amount']
            ]);
        }
        else {
            return response()->json([
                'message' => 'Bien ajouté a la db mais le paiment n est pas passé',
                'status' => '400',
                'error' => $e->getMessage(),
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
