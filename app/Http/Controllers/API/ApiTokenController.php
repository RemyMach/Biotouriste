<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class ApiTokenController extends Controller
{

    protected $user;

    public function verifyCredentials()
    {
        $parameters = $this->verifyPresenceIdUserAndApiToken();

        if(!$parameters)
        {
            return false;
        }

        if(!$this->apiTokenCorrespondToAnyUser($parameters['api_token'])){

            return false;
        }

        if(!$this->verifyApiTokenRequestCorrespondToTheIdUser($parameters['idUser'],$parameters['api_token']))
        {
            return false;
        }

        return $parameters;
    }

    public function verifyAdminCredentials()
    {
        $parameters = $this->verifyCredentials();

        if(!$parameters)
        {
            return false;
        }

        return $this->verifyApiTokenRequestCorrespondToTheAdminUser($parameters['idUser']);

        if(!$this->verifyApiTokenRequestCorrespondToTheAdminUser($parameters['idUser'])){
            return false;
        }
        return $parameters;
    }

    public function verifyPresenceIdUserAndApiToken()
    {
        $api_token = request('api_token');
        $idUser = request('idUser');
        if(!$api_token || !$idUser)
        {
            return false;
        }

        return ["api_token" => $api_token,"idUser" => $idUser];

    }

    public function apiTokenCorrespondToAnyUser(string $api_token)
    {
        $user = User::where('api_token',$api_token)->first();

        if(!$user){
            return false;
        }

        return true;
    }

    public function verifyApiTokenRequestCorrespondToTheIdUser(string $idUser,string $api_token)
    {
        $user = User::where('idUser', $idUser)->first();

        if($api_token != $user->api_token){
            return false;
        }

        return true;
    }

    public function verifyApiTokenRequestCorrespondToTheAdminUser(string $idUser)
    {
        $user = User::where('idUser',$idUser)->first();

        if(!preg_match('#admin#i',$user->status['status_user_label'])){
            return false;
        }

        return true;
    }
}