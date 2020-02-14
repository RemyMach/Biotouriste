<?php

namespace App\Http\Controllers;

use App\Announce;
use App\Comment;
use App\Repositories\PaymentRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('SessionAuth')->only('store','destroy','showYourPostedComments');
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
        $pomme = PaymentRepository::findPaymentsOfAUserForASeller(3,1);
        dd($pomme);
        //return view('testComment');
    }

    public function store(Request $request, Client $client, $idAnnounce)
    {

        $this->user = $request->session()->get('user');

        $data = request()->all();
        $data['idUser'] = $this->user->idUser;
        $data['api_token'] = $this->user->api_token;
        $data['idAnnounce'] = $idAnnounce;
        $query = $client->request('POST','http://localhost:8001/api/comment/store',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('comment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function CommentsOfASeller(Announce $announce, Request $request,Client $client)
    {
        $data = request()->all();

        //vérification pour sécu api de qui fait l'appel
        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');
        $data['idAnnounce'] = $announce->idAnnounce;

        $query = $client->request('POST','http://localhost:8001/api/comment/seller',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        if($response->status === "400")
        {
            return redirect($this->redirectTo);
        }


        //retourne la page annonce avec un tableau contenant commentaires
        // et les users qui ont posté les commentaires
        return view('testComment',['comments' => $response->comments]);
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
    public function destroy(Request $request, Comment $comment, Client $client)
    {
        $this->user = $request->session()->get('user');

        $data['idComment'] = $comment->idComment;
        $data['idUser'] = $this->user->idUser;
        $data['api_token'] = $this->user->api_token;

        $query = $client->request('POST','http://localhost:8001/api/comment/destroy',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        return back()->with('le commentaire a bien été détruit');
    }

    public function showYourPostedComments(Request $request, Client $client)
    {
        $this->user = $request->session()->get('user');

        $data['idUser'] = $this->user->idUser;
        $data['api_token'] = $this->user->api_token;

        $query = $client->request('POST','http://localhost:8001/api/comment/showYourPostedComments',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        return view('testComment',['comments' => $response->comments]);

    }
}
