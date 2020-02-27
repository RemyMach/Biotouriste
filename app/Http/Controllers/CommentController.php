<?php

namespace App\Http\Controllers;

use App\Announce;
use App\Comment;
use App\Repositories\PaymentRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $sessionUser;

    public function __construct()
    {
        $this->middleware('SessionAuth')->only('store','destroy','showYourPostedComments','displayFormToStore');
    }

    public function store(Request $request, Client $client, $idAnnounce)
    {

        $this->sessionUser = $request->session()->get('user');
        $data = $request->all();
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;
        $data['idAnnounce'] = $idAnnounce;
        $query = $client->request('POST','http://localhost:8001/api/comment/store',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());
        if($response->status == '400')
        {
            if(isset($response->error))
            {
                //dd($response->error);
                return back()->with('errorValidator' , $response);
            }
            return back()->with(['errorMassage' => $response->message]);
        }
        //return vers la route des announces
        return redirect('CommentsOfASeller')->with(['successRegisterComment' => 'your comment has been register']);
    }

    public function displayFormToStore(Request $request, Client $client, $idAnnounce)
    {

        $this->sessionUser = $request->session()->get('user');

        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;
        $data['idAnnounce'] = $idAnnounce;
        $query = $client->request('POST','http://localhost:8001/api/comment/displayFormToStore',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());
        if($response->status == '400')
        {
            return back()->with(['errorDisplayForm' => 'You can\'t post a comment for this Announce because you don\'t have payment for this Seller']);
        }

        //retourne la page annonce avec un tableau contenant commentaires
        // et les users qui ont posté les commentaires
        return view('comment.create',['idAnnounce' => $idAnnounce]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function CommentsOfASeller(Request $request,Client $client,$idUser)
    {
        $data = request()->all();
        //vérification pour sécu api de qui fait l'appel
        $data['idUser'] = config('api.api_admin_id');
        $data['api_token'] = config('api.api_admin_token');
        $data['idUserSeller'] = $idUser;

        $query = $client->request('POST','http://localhost:8001/api/comment/seller',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());
        if($response->status == '400')
        {
            return view('comment.index',['messageError' => $response->message]);
        }

        //retourne la page annonce avec un tableau contenant commentaires
        // et les users qui ont posté les commentaires
        return view('comment.index',['comments' => $response->comments]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Comment $comment, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data['idComment'] = $comment->idComment;
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/comment/destroy',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        return back()->with('le commentaire a bien été détruit');
    }

    public function showYourPostedComments(Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/comment/showYourPostedComments',
            ['form_params' => $data]);

        $response = json_decode($query->getBody()->getContents());

        return view('testComment',['comments' => $response->comments]);

    }
}
