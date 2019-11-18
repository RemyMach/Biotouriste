<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //Get Users
        $users = User::all();

        //Return collection of Users as a resource
        return new UserResource($users);
        /*$user = User::all();
        $response = [
            'data'    => $user,
        ];

        return response()->json($response, 200);*/
    }

    public function show(Request $request)
    {
        //récupéré le user par son id
        //vérifier que le token correspond et renvoyé les informations correspondant
        //à réfléchir si on met pas que le token api
        return request()->get('api_token');
    }
}