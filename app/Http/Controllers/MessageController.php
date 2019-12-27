<?php

namespace App\Http\Controllers;

use App\Announce;
use App\Message;
use App\Repositories\AnnounceRepository;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }


    public function store(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        //$data = request()->all();

        $data['message_subject'] = 'this is a message about your shitty announce';
        $data['message_content'] = 'Your announce is like a big shit';
        $data['idAnnounce'] = 2;
        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/message/store',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testMessage',["response" => $response]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
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
