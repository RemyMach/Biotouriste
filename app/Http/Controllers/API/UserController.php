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

    public function __construct(){
        $this->middleware('apiMergeJsonInRequest');

        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'show','updateProfile','updatePassword','destroy'
        );
        $this->middleware('apiAdmin')->only(
            'destroy','index'
        );
    }

    private $user;

    public function index(ApiTokenController $apiTokenController)
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

    public function show()
    {
        $data = request()->all();
        $idUser = $data['idUser'];
        $api_token = $data['api_token'];


        $user =  User::findorFail($idUser);

        return response()->json([
                'user'   => $user,
                'status'    => '200',
            ]);
    }

    public function updateProfile()
    {
        $data = request()->all();

        return $this->checkEmailAndPasswordExist($data);


        return response()->json([
          $emails
        ]);

        $validator = Validator::make($data, [
            'user_name' => ['required', 'string', 'max:45'],
            'user_surname' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_postal_code' => ['required', 'integer'],
            'user_phone' => ['required', 'unique:users'],
            'user_img' => ['string'],
        ]);

        if($validator->fails())
        {
            return response()->json([
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

        $user = User::findorFail('idUser',$data['idUser'])->first();

        $user->update($data);

        return response()->json([
            'message'   => 'The informations are update',
            'status'    => '200',
            'user'      => $data
        ]);


    }

    public function updatePassword()
    {

        $data = request()->all();

        $validator = Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message'   => 'The request is not good',
                'error'     => $validator->errors(),
                'status'    => "400"
            ]);
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

    public function destroy()
    {
        $data = request()->all();

        if(!$this->verifyIfUserExist($data['idUserDelete'])){
            return response()->json([
                'message'   => 'The User doesn\'t exists',
                'status'    => '400',
            ]);
        }

        $this->user->delete();

        return response()->json([
            'message'   => 'The user has been deleted',
            'status'    => '200',
            'idUser'    => $this->user
        ]);
    }

    private function verifyIfUserExist($idUserDelete){


        $this->user = User::findOrFail($idUserDelete);

        if(!$this->user){
            return false;
        }

        return true;
    }

    private function checkIfEmailAndPasswordExisting($data){

        $emails = DB::table('Users')->select('email')->get();
        $email = DB::table('Users')->select('email')->where('idUser','=',$data['idUser']);
        $phones = DB::table('Users')->select('user_phone')->get();
        $phone = DB::table('Users')->select('user_phone')->where('user_phone','=',$data['user_phone']);


        if (($key = array_search($email, $emails)) !== false) {
            unset($emails[$key]);
        }

        if (($key = array_search($phone, $phones)) !== false) {
            unset($phones[$key]);
        }

    }
}