<?php

namespace App\Http\Controllers;

use App\Announce;
use App\Message;
use App\Repositories\AnnounceRepository;
use App\Repositories\MessageRepository;
use DateTime;
use DateTimeZone;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $sessionUser;

    public function __construct()
    {
        $this->middleware('SessionAuth')->only(
            'store'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('');
    }


    public function store(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();

        /*$data['message_subject'] = 'this is a message about your shitty announce';*/
        $data['message_content'] = 'Your announce is like a big caca';
        $data['idAnnounce'] = 1;
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;
        $query = $client->request('POST','http://localhost:8001/api/message/store',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testMessage',["response" => $response]);
    }

    public function showMessagesOfATouristController(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;
        $query = $client->request('POST','http://localhost:8001/api/message/showMessagesOfATouristController',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());
//        dd($response->conversations[0]);
        return view('message',["response" => $response->conversations]);
    }

    public function showMessagesOfASeller(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/message/showMessagesOfASeller',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());
        return view('message',["response" => $response->conversations]);
    }

    private function utilePourPlusTardNePasSupprimer(){
        $date = date('Y-m-d h-i-s');
        $format = 'Y-m-d h-i-s';
        $dateTime = DateTime::createFromFormat($format, $date,new DateTimeZone('Europe/Paris'));
        //ce passe dans le client
        $dateTime->setTimezone(new DateTimeZone(date_default_timezone_get()));
        dd($dateTime);
    }
}
