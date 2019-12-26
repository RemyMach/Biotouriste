<?php

namespace App\Http\Controllers;

use App\Favori;
use App\Repositories\FavoriRepository;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FavoriController extends Controller
{
    private $sessionUser;

    public function __construct(){


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showFavorisOfAUser(Request $request, Client $client)
    {
        //recherche de tous les favoris en fonction d'un idUser créé dans le repo
        $favoris = FavoriRepository::allFavorisAnnounceOfAUser(2);
        dd($favoris);

        $this->sessionUser = $request->session()->get('user');

        $data['idUser']     = $this->sessionUser->idUser;
        $data['api_token']  = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/discount_code/showFavorisOfAUser',
            ['form_params' => $data]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);

        return view('testFavori',["response" => $response]);

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Favori  $favori
     * @return \Illuminate\Http\Response
     */
    public function show(Favori $favori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Favori  $favori
     * @return \Illuminate\Http\Response
     */
    public function edit(Favori $favori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Favori  $favori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favori $favori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favori  $favori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favori $favori)
    {
        //
    }
}
