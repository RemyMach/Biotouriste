<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\API\NoApiClass\UsefullController;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{

    private $user;
    private $request;

    public function __construct(){
        $this->middleware('apiMergeJsonInRequest');

        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'show','updateProfile','updatePassword','destroy'
        );
        $this->middleware('apiAdmin')->only(
            'destroy','index'
        );
    }

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

    public function show(Request $request)
    {
        $this->request = $request;
        $idUser = $this->request->get('idUser');

        $user =  User::findorFail($idUser);

        return response()->json([
                'user'   => $user,
                'status'    => '200',
            ]);
    }

    public function updateProfile(Request $request, UsefullController $usefullController)
    {
        $this->request = $request;


        $validator = Validator::make($this->request->all(), [
            'user_name' => ['required', 'string', 'max:45'],
            'user_surname' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'user_postal_code' => ['required', 'integer'],
            'user_phone' => ['required'],
            'user_img' => ['string'],
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message'   => 'The request is not good',
                'error'     => $validator->errors(),
                'status'    => '400'
            ]);
        }

        $data = $this->checkIfEmailAndPasswordExisting($this->request->all());

        if(!$data){

            return response()->json([
                'message'   => 'The Email of Phone exist',
                'status'    => '400',
            ]);
        }


        $data = $usefullController->keepKeysThatWeNeed($data,[
            'user_name','user_surname','email','user_postal_code','user_phone','user_img'
        ]);


        $user = User::find($this->request->input('idUser'));

        
        $user->update($data);

        $userUpdate = User::find($this->request->input('idUser'));

        return response()->json([
            'message'   => 'The informations are update',
            'status'    => '200',
            'user'      => $userUpdate
        ]);


    }

    public function updatePassword(Request $request)
    {

        $this->request = $request;

        $validator = Validator::make($this->request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'oldPassword' => ['required', 'string']
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message'   => 'The request is not good',
                'error'     => $validator->errors(),
                'status'    => '400'
            ]);
        }


        $user = User::findOrFail($this->request->input('idUser'));

        if(!$this->verifyPassword($user,$this->request->get('oldPassword')))
        {
            return response()->json([
                'message'   => 'Your password is not correct',
                'status'    => '400'
            ]);
        }

        $newPassword = Hash::make($this->request->get('password'));

        $user->update(['password' => $newPassword]);

        return response()->json([
            'message'   => 'The password has been update',
            'status'    => '200',
            'user'      => $user
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
        $email = DB::table('Users')->select('email')->where('idUser','=',$data['idUser'])->get();
        $phones = DB::table('Users')->select('user_phone')->get();
        $phone = DB::table('Users')->select('user_phone')->where('user_phone','=',$data['user_phone'])->get();


        foreach($emails as $key => $value){
            if($data['email'] === $email[0]->email){
                unset($data['email']);
                break;
            }elseif($data['email'] === $value->email ){
                return false;
            }
        }

        foreach($phones as $key => $value){
            if($data['user_phone'] === $phone[0]->user_phone){
                unset($data['user_phone']);
                break;
            }elseif($data['user_phone'] === $value->user_phone ){
                return false;
            }
        }

        return $data;
    }

    private function verifyPassword($user,$requestPassword)
    {
        $validateCredentials = Hash::check($requestPassword,$user->password);

        if(!$validateCredentials)
        {
            return false;
        }
        return true;
    }
}