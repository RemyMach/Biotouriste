<?php


namespace App\Http\Controllers\API;


use App\Announce;
use App\Http\Controllers\Controller;
use App\Repositories\AnnounceRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnounceController extends Controller
{
    private $request;


    public function delete(Request $request){

    }

    public function store(Request $request){

        $this->request = $request;

//        $validator = $this->validateAnnounce();
//        if($validator->original['status'] == '400') {
//            return $validator;
//        }
        $data = $request->all();
        $col =[
            'announce_measure' => 0, 'announce_name' => 0,'announce_price' => 0,'announce_comment' => 0,'announce_adresse' => 0,'announce_date' => 0,'announce_city' => 0,
            'announce_img' => 0,'products_idProduct' => 0,'Users_idUser' => 0,'announce_lat' => 0,'announce_lng' => 0,'announce_quantity' => 0, 'announce_is_available' => 1
        ];
        // fusionne tab1 et tab2 si les key dans le tab 1 exist dans le 2 avec les value du tab 2
        $newAnnounce = array_merge($col, array_intersect_key($data, $col));
        $newAnnounce['announce_date'] = DateTime::createFromFormat('Y-m-d H:i:s', $newAnnounce['announce_date']);
//        $newAnnounce['announce_is_available'] = true;
//        $announce = Announce::create($newAnnounce);
        $announce = new Announce();
        $announce->announce_quantity = (int)$newAnnounce['announce_quantity'];
        $announce->announce_name = (string)$newAnnounce['announce_name'];
        $announce->announce_is_available = (boolean)$newAnnounce['announce_is_available'];
        $announce->announce_measure = (string)$newAnnounce['announce_measure'];
        $announce->announce_lat = (float)$newAnnounce['announce_lat'];
        $announce->announce_lng = (float)$newAnnounce['announce_lng'];
        $announce->announce_city = (string)$newAnnounce['announce_city'];
        $announce->announce_price = (float)$newAnnounce['announce_price'];
        $announce->announce_comment = (string)$newAnnounce['announce_comment'];
        $announce->announce_adresse = (string)$newAnnounce['announce_adresse'];
        $announce->announce_date = $newAnnounce['announce_date'];
        $announce->announce_img = (string)$newAnnounce['announce_img'];
        $announce->products_idProduct = (int)$newAnnounce['products_idProduct'];
        $announce->Users_idUser = (int)$newAnnounce['Users_idUser'];

        $announce->save();
        return response()->json([
            'message'   => 'Your Announce has been register',
            'status'    => '200',
            'announce'  => $announce
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
        return $this->resultValidator($validator);

    }

}