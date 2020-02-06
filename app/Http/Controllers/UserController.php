<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use GuzzleHttp\Client;

class UserController extends Controller
{
    private $sessionUser;

    public function __construct()
    {
        $this->middleware('SessionAuth')->only('show','updateProfile','UpdatePassword','destroy');
        $this->middleware('admin')->only('destroy','index');
        $this->middleware('guest')->only('profil');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Client $client)
    {
        $query = $client->get('http://localhost:8001/api/users');
        $responses = json_decode($query->getBody()->getContents());

        return view('test',compact('responses'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form.view');
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
     * @param string $api_token
     * @param Request $request
     * @param Client $client
     * @return mixed
     */
    public function show(string $api_token,Request $request, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        if($api_token !== $this->user->api_token){
            return redirect('home');
        }

        $client = new Client();
        $query = $client->request('POST','http://localhost:8001/api/user/show', [
            'form_params' => [
                "api_token"=>$api_token,"idUser"=>$this->user->idUser]
            ]);
        $response = json_decode($query->getBody()->getContents());

        dd($response);
        $user = $response->user;

        return view('users.profile',['user' => $response->user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request,User $user, Client $client)
    {

        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();
        $data['api_token'] = $this->sessionUser->api_token;
        $data['idUser'] = $this->sessionUser->idUser;

        $query = $client->request('POST','http://localhost:8001/api/user/updateProfile', [
            'form_params' => $data
        ]);

        $response = json_decode($query->getBody()->getContents());

        dd($response);

        $this->sessionUser->update($response);

        return back()->with('success','The Profile has been updated');
    }

    public function UpdatePassword(Request $request,User $user,Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        if($user->idUser != $this->sessionUser->idUser){
            return redirect('home');
        }

        $data = request()->all();
        $data['api_token'] = $this->sessionUser->api_token;
        $data['idUser'] = $this->sessionUser->idUser;

        $query = $client->request('POST','http://localhost:8001/api/user/updatePassword', [
            'form_params' => $data
        ]);

        $response = json_decode($query->getBody()->getContents());

        if($response->status === "400")
        {
            return back()->with('fail','The request is not good');;
        }

        //passer à la vue, ce sont les paramètre update
        $User_attributes_array = json_decode(json_encode($response->user),true);

        return back()->with('success','The Profile has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,User $user, Client $client)
    {
        $this->sessionUser = $request->session()->get('user');

        $data = request()->all();
        $data['idUser'] = $this->sessionUser->idUser;
        $data['api_token'] = $this->sessionUser->api_token;

        $query = $client->request('POST','http://localhost:8001/api/user/destroy', [
            'form_params' => $data
        ]);

        $response = json_decode($query->getBody()->getContents());

        if($response->status === "400")
        {
            return back()->with('fail','The request is not good');
        }

        return back()->with('success','The Profile has been destroy');
    }

    public function profil() {

      return view('register');

    }
}
