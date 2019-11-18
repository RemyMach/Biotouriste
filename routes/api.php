<?php

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//list users
Route::get('users','API\UserController@index');

Route::get('show/','API\UserController@show');

Route::post('store','API\RegisterController@store');

Route::post('login','API\LoginController@login');

/*Route::get('/users', function () {
    return UserResource::collection(User::paginate(2));
});*/

// list single User
