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

        $this->middleware('admin')->only(
            'showAllReportsForAdmin'
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
        /*@test
         * $data['idAnnounce'] = 2;
        $data['ReportCategorie'] = 'Message';
        $data['idUserReported'] = 2;
        $data['report_subject'] = 'je n\'aime pas cette personne';
        $data['report_comment'] = 'il a manqué de respect lorsqu\'on c\'est rencontré pour l\'annonce';*/
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
    public function showAllMyReports(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/report/show/showAllMyReports',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testMessage',["response" => $response]);
    }

    public function showAllReportsForAdmin(Request $request, Client $client){

        /*$report = Report::find(8);
        dd($report->announce->Users_idUser);*/

        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/report/show/admin',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testReport',["response" => $response]);
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
