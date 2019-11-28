<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiTokenController;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    protected $user;

    public function index(ApiTokenController $apiTokenController)
    {
        $requestParameters = $apiTokenController->verifyCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }
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

    public function show(Request $Showrequest, ApiTokenController $apiTokenController)
    {
        $requestParameters = $apiTokenController->verifyCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }

        $idUser = $requestParameters['idUser'];
        $api_token = $requestParameters['api_token'];


        $user =  User::findorFail($idUser);

        return response()->json([
                'user'   => $user,
                'status'    => '200',
            ]);
    }

    public function updateProfile(ApiTokenController $apiTokenController)
    {
        $requestParameters = $apiTokenController->verifyCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your key is not valid',
                'status'    => '400',
            ]);
        }

        $data = request()->all();

        $validator = Validator::make($data, [
            'user_name' => ['string', 'max:45'],
            'user_surname' => [ 'string', 'max:45'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'user_postal_code' => ['integer'],
            'user_phone' => ['unique:users'],
            'user_img' => ['string'],
        ]);

        if($validator->fails())
        {
            return $response = response()->json([
                'message'   => 'The request is not good',
                'error'     => $validator->errors(),
                'status'    => "400"
            ]);
        }

        if(isset($data['password']) || ($data['remember_token']) || $data['Status_User_idStatus_User'] || $data['api_token'])
        {
            unset($data['password']);
            unset($data['remember_token']);
            unset($data['Status_User_idStatus_User']);
            unset($data['api_token']);
        }

        $user = User::findorFail('idUser',$requestParameters['idUser'])->first();

        $user->update($data);

        return response()->json([
            'message'   => 'The informations are update',
            'status'    => '200',
            'user'      => $data
        ]);


    }

    public function updatePassword(ApiTokenController $apiTokenController)
    {
        $requestParameters = $apiTokenController->verifyCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your key is not valid',
                'status'    => '400',
            ]);
        }

        $data = request()->all();

        $validator = Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if($validator->fails())
        {
            $response = response()->json([
                'message'   => 'The request is not good',
                'error'     => $validator->errors(),
                'status'    => "400"
            ]);
            return $response->getOriginalContent();
        }

        $validArray = $data['password'];

        $user = User::findorFail('idUser',$requestParameters['idUser'])->first();

        $user->update($validArray);

        return response()->json([
            'message'   => 'The informations are update',
            'status'    => '200',
            'user'      => $validArray
        ]);

    }

    public function destroy(ApiTokenController $apiTokenController)
    {
        $requestParameters = $apiTokenController->verifyCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your key is not valid',
                'status'    => '400',
            ]);
        }

        $user = $this->verifyIfUserIsAdmin($requestParameters['idUser']);

        if(!$user)
        {
            return response()->json([
                'message' => 'Your request is not good',
                'status' => '400',
            ]);
        }

        $user->delete();

        return response()->json([
            'message'   => 'The user has been deleted',
            'status'    => '200',
            'idUser'    => $requestParameters['idUser']
        ]);

        //si le user est administrateur il peut delete
    }

    protected function verifyIfUserIsAdmin($idUser)
    {
        $user = User::findorFail($idUser);
        if(!preg_match('#admin#i',$user->status->status_user_label))
        {
            return false;
        }
        return $user;
    }
}