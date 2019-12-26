<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;

class ApiTokenController extends Controller
{

    private $user;

    public function verifyRoleCredentials($role)
    {
        $parameters = $this->verifyCredentials();

        if(!$parameters)
        {
            return false;
        }

        $method = 'verifyApiTokenRequestCorrespondTo' . $role;

        if(!$this->$method()){
            return false;
        }
        return $parameters;
    }

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

        if(!$this->apiTokenRequestCorrespondToTheIdUser($parameters['idUser']))
        {
            return false;
        }

        return $parameters;
    }

    private function verifyPresenceIdUserAndApiToken()
    {
        $api_token = request('api_token');
        $idUser = request('idUser');
        if(!$api_token || !$idUser)
        {
            return false;
        }
        return ["api_token" => $api_token,"idUser" => $idUser];

    }

    private function apiTokenCorrespondToAnyUser(string $api_token)
    {
        $user = User::where('api_token',$api_token)->first();

        if(!$user){
            return false;
        }
        $this->user = $user;

        return true;
    }

    private function apiTokenRequestCorrespondToTheIdUser(string $idUser)
    {
        if($idUser != $this->user->idUser){
            return false;
        }
        return true;
    }

    private function verifyApiTokenRequestCorrespondToAdmin()
    {
        if(!preg_match('#admin#i',$this->user->status['status_user_label'])){
            return false;
        }

        return true;
    }

    private function verifyApiTokenRequestCorrespondToController()
    {
        if(!preg_match('#controller#i',$this->user->status['status_user_label']) && !preg_match('#admin#i',$this->user->status['status_user_label'])){
            return false;
        }

        return true;
    }

    private function verifyApiTokenRequestCorrespondToSeller()
    {
        if(!preg_match('#seller#i',$this->user->status['status_user_label'])){
            return false;
        }

        return true;
    }

    private function verifyApiTokenRequestCorrespondToTourist()
    {
        if(!preg_match('#tourist#i',$this->user->status['status_user_label'])){
            return false;
        }

        return true;
    }

    private function verifyApiTokenRequestCorrespondToTouristController()
    {
        if(!preg_match('#tourist#i',$this->user->status['status_user_label']) && !preg_match('#controller#i',$this->user->status['status_user_label'])){
            return false;
        }

        return true;
    }
}