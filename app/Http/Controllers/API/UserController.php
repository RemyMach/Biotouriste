<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $user = User::all();
        $response = [
            'success' => true,
            'data'    => $user,
        ];

        return response()->json($response, 200);
    }
}