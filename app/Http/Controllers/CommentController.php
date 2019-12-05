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
        $data['idUser'] = $this->user->idUser;
        $data['api_token'] = $this->user->api_token;
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

        if($response->status === "400")
        {
            return redirect($this->redirectTo);
        }


        //retourne la page annonce avec un tableau contenant commentaires
        // et les users qui ont posté les commentaires
        return view('test123',['comments' => $response->comments]);
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
    public function destroy(Request $request, Comment $comment)
    {
        //dd($request->session()->has('user'));
        if(!$request->session()->has('user')){

            return redirect('home');
        }

        $this->user = $request->session()->get('user');

        $data['idComment'] = $comment->idComment;
        $data['idUser'] = $this->user->idUser;
        $data['api_token'] = $this->user->api_token;

        $client = new Client();
        $request = $client->request('POST','http://localhost:8001/api/comment/destroy',
            ['form_params' => $data]);

        $response = json_decode($request->getBody()->getContents());

        return back()->with('le commentaire a bien été détruit');
    }
    public function showYourPostedComments(Request $request)
    {
        if(!$request->session()->has('user')){

            return redirect('home');
        }

        $this->user = $request->session()->get('user');

        $data['idUser'] = $this->user->idUser;
        $data['api_token'] = $this->user->api_token;

        $client = new Client();
        $request = $client->request('POST','http://localhost:8001/api/comment/showYourPostedComments',
            ['form_params' => $data]);

        $response = json_decode($request->getBody()->getContents());

        return view('test123',['comments' => $response->comments]);

    }
}
