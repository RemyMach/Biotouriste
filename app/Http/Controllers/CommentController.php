<?php

namespace App\Http\Controllers;

use App\Announce;
use App\Comment;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->session()->has('user')){
            return redirect('home');
        }

        $this->user = $request->session()->get('user');
        $data = request()->all();
        $data['idUser'] = $this->user->idUser;
        $data['api_token'] = $this->user->api_token;

        $client = new Client();
        $request = $client->request('POST','http://localhost:8001/api/comment/register',
            ['form_params' => $data]);

        $response = json_decode($request->getBody()->getContents());

        return view('comment');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Announce $announce, Request $request)
    {
        if(!$request->session()->has('user')){
            return redirect('home');
        }

        $this->user = $request->session()->get('user');
        $data = request()->all();
        //vérification pour sécu api de qui fait l'appel
        $data['idUser'] = $this->user->idUser;
        $data['api_token'] = $this->user->api_token;

        $client = new Client();
        $request = $client->request('POST','http://localhost:8001/api/user/show',
            ['form_params' => $data]);

        $response = json_decode($request->getBody()->getContents());

        if($response->status === "400")
        {
            return redirect($this->redirectTo);
        }

        dd($response);

        //retourne la page annonce
        return view('test123');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
