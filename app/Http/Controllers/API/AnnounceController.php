<?php


namespace App\Http\Controllers\API\NoApiClass;


use App\Http\Controllers\Controller;
use App\Repositories\AnnounceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnounceController extends Controller
{
    private $request;


    public function delete(Request $request){

    }

    public function store(Request $request){

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
        $idCategorie = $this->request->input('categorie');

        $announces = AnnounceRepository::filterByLngAndLatOrAndCategorie($citydata['lng'],$citydata['lat'], $idCategorie);
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
        ]);
    }



    public function selectByCity(Request $request)
    {
        return response()->json([
            'error' => 'remmmmmmmy le con'
        ]);

        $this->request = $request;
        $validator = $this->validateCity();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        $citydata = $this->request->input('cityData');
        $announces = AnnounceRepository::filterByLngAndLatOrAndCategorie($citydata['lng'],$citydata['lat']);
        if(!isset($anounces[0])){
            return response()->json([
                'error'     => 'your city is not valid or you have no announces for this city',
                'status'    => '400'
            ]);
        }

        return response()->json([
            'announces' => $announces,
            'lng'    => $citydata['lng'],
            'lat'    => $citydata['lat'],
        ]);
    }

    private function validateCity(){

        $validator = Validator::make($this->request->all(), [
            'lng' => ['required','string'],
            'lat' => ['required','string'],
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
        $validator = Validator::make($this->request->all(), [
            'cityData' => ['required','string'],
            'categorie' => ['required', 'integer', 'max:6']
        ]);

        return $this->resultValidator($validator);
    }

}