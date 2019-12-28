<?php

namespace App\Http\Controllers;

use App\Report;
use App\Repositories\Report_CategoriesRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ReportController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();
        /*test
         * $data['message_subject'] = 'this is a message about your shitty announce';
        $data['message_content'] = 'Your announce is like a big shit';
        $data['idAnnounce'] = 2;*/

        /*$data['idAnnounce'] = 2;*/
        $data['ReportCategorie'] = 'Message';
        $data['idUserReported'] = 2;
        $data['report_subject'] = 'je n\'aime pas cette personne';
        $data['report_comment'] = 'il a manqué de respect lorsqu\'on c\'est rencontré pour l\'annonce';
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;
        $query = $client->request('POST','http://localhost:8001/api/report/store',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testMessage',["response" => $response]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
