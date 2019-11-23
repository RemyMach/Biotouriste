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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test123');
    }

    public function store(Request $request)
    {

        if(!$request->session()->has('user')){

            return redirect('home');
        }

        $this->user = $request->session()->get('user');

        $data = request()->all();
        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');
        $client = new Client();
        $request = $client->request('POST','http://localhost:8001/api/comment/store',
            ['form_params' => $data]);

        $response = json_decode($request->getBody()->getContents());

        dd($response);

        return view('comment');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function CommentsOfASeller(Announce $announce, Request $request)
    {
        $data = request()->all();

        //vérification pour sécu api de qui fait l'appel
        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');
        $data['idAnnounce'] = $announce->idAnnounce;

        $client = new Client();
        $request = $client->request('POST','http://localhost:8001/api/comment/seller',
            ['form_params' => $data]);

        $response = json_decode($request->getBody()->getContents());

        dd($response);

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
