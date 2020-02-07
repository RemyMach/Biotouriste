<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use GuzzleHttp\Client;

class AdminController extends Controller
{
    private $sessionUser;

    public function __construct()
    {


        $this->middleware('guest')->only('profil');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Client $client)
    {

        return view('admin.admin');

    }

}