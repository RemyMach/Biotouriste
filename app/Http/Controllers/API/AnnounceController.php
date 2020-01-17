<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Repositories\AnnounceRepository;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnounceController extends Controller
{
    private $request;


    public function delete(Request $request){

    }

    public function store(Request $request){

        $this->request = $request;

        $validator = $this->validateAnnounce();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        return response()->json([
            'message'   => 'Your Announce has been register',
            'status'    => '200',
        ]);
    }

    public function update(Request $request){
        $this->request = $request;
    }

    public function selectByCategorie(Request $request){
        $this->request = $request;
        $validator = $this->validateCategorie();
        if($validator->original['status'] == '400') {
            return $validator;
        }
        $citydata = $this->request->input('cityData');
        $announces = AnnounceRepository::filterByLngAndLatOrAndCategorie($citydata['lng'],$citydata['lat'], $citydata['categorie']);
        if(!isset($announces[0])){
            return response()->json([
                'error'     => 'your city is not valid or you have no announces for this city in  this categorie',
                'status'    => '400'
            ]);
        }

        return response()->json([
            'announces' => $announces,
            'lng'    => $citydata['lng'],
            'lat'    => $citydata['lat'],
            'status' => '200'
        ]);
    }

    public function selectByCity(Request $request)
    {

        $this->request = $request;

        $validator = $this->validateCity();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        $citydata = $this->request->input('cityData');
        $announces = AnnounceRepository::filterByLngAndLatOrAndCategorie($citydata['lng'],$citydata['lat']);
        if(!isset($announces[0])){
            return response()->json([
                'error'     => 'your city is not valid or you have no announces for this city',
                'status'    => '400',
            ]);
        }

        return response()->json([
            'announces' => $announces,
            'lng'    => $citydata['lng'],
            'lat'    => $citydata['lat'],
            'status' => '200'
        ]);
    }

    private function validateCity(){

        $validator = Validator::make($this->request->input('cityData'), [
            'lng' => ['required','string','regex:/^(-)?[0-9]*.[0-9]*$/'],
            'lat' => ['required','string','regex:/^(-)?[0-9]*.[0-9]*$/'],
        ]);
        return $this->resultValidator($validator);
    }

    private function resultValidator($validator){
        if($validator->fails())
        {
            return response()->json([
                'message'   => 'The request is not good',
                'error'     => $validator->errors(),
                'status'    => '400'
            ]);
        }

        return response()->json([
            'message'   => 'The request is good',
            'status'    => '200'
        ]);
    }

    private function validateCategorie(){
        $validator = Validator::make($this->request->input('cityData'), [
            'lng' => ['required','string','regex:/^(-)?[0-9]*.[0-9]*$/'],
            'lat' => ['required','string','regex:/^(-)?[0-9]*.[0-9]*$/'],
            'categorie' => ['required', 'integer', 'max:6']
        ]);
        return $this->resultValidator($validator);
    }

    private function validateAnnounce(){
        $test;
        $validator = Validator::make($this->request->input('cityData'), [
            'lng' => ['required','string','regex:/^(-)?[0-9]*.[0-9]*$/'],
            'lat' => ['required','string','regex:/^(-)?[0-9]*.[0-9]*$/'],
        ]);
    }

}