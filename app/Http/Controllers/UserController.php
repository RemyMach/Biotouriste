<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use GuzzleHttp\Client;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('admin')->only('destroy','index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $client = new Client();
        $request = $client->get('http://localhost:8001/api/users');
        $responses = json_decode($request->getBody()->getContents());

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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(string $api_token,Request $request)
    {
        if(!$request->session()->has('user')){
            return redirect('home');
        }

        $this->user = $request->session()->get('user');


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

        //$user = User::findOrFail($user->id);

        return view('users.profile',compact("user"));
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
    public function updateProfile(Request $request,User $user)
    {
        if(!$request->session()->has('user')){
            return redirect('home');
        }

        $this->user = $request->session()->get('user');

        if($user->idUser != $this->user->idUser){
            return redirect('home');
        }

        $data = request()->all();
        $data['api_token'] = $this->user->api_token;
        $data['idUser'] = $this->user->idUser;

        $client = new Client();
        $request = $client->request('POST','http://localhost:8001/api/user/updateProfile', [
            'form_params' => $data
        ]);
        $response = json_decode($request->getBody()->getContents());

        dd($response);

        $this->user->update($response);

        return back()->with('success','The Profile has been updated');
    }

    public function UpdatePassword(Request $request,User $user)
    {
        if(!$request->session()->has('user')){
            return redirect('home');
        }

        $this->user = $request->session()->get('user');

        if($user->idUser != $this->user->idUser){
            return redirect('home');
        }

        $data = request()->all();
        $data['api_token'] = $this->user->api_token;
        $data['idUser'] = $this->user->idUser;

        $client = new Client();
        $request = $client->request('POST','http://localhost:8001/api/user/updatePassword', [
            'form_params' => $data
        ]);

        $response = json_decode($request->getBody()->getContents());

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
    public function destroy(Request $request,User $user)
    {
        $this->user = $request->session()->get('user');

        if($user->idUser != $this->user->idUser){
            return redirect('home');
        }

        $data['idUser'] = $user->idUser;
        $data['api_token'] = $this->user->api_token;

        $client = new Client();
        $request = $client->request('POST','http://localhost:8001/api/user/destroy', [
            'form_params' => $data
        ]);

        $response = json_decode($request->getBody()->getContents());

        if($response->status)
        {
            return back()->with('fail','The request is not good');
        }

        return back()->with('success','The Profile has been destroy');
    }
}
