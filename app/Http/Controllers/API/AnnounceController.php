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
            'announce_name' => 0,'announce_price' => 0,'announce_comment' => 0,'announce_adresse' => 0,'announce_date' => 0,'announce_city' => 0,
            'announce_img' => 0,'products_idProduct' => 0,'Users_idUser' => 0,'announce_lat' => 0,'announce_lng' => 0,'announce_quantity' => 0
        ];
        // fusionne tab1 et tab2 si les key dans le tab 1 exist dans le 2 avec les value du tab 2
        $newAnnounce = array_merge($col, array_intersect_key($data, $col));
        $newAnnounce['announce_date'] = DateTime::createFromFormat('Y-m-d H:i:s', $newAnnounce['announce_date']);
        $newAnnounce['announce_is_available'] = true;
        $announce = Announce::create($newAnnounce);

        $table->string('announce_measure', 25);
        $table->decimal('announce_lat', 13, 10);
        $table->decimal('announce_lng', 13, 10);
        $table->string('announce_city', 30);
        $table->decimal('announce_price', 6, 2);
        $table->text('announce_comment');
        $table->string('announce_adresse', 45);
        $table->dateTime('announce_date');
        $table->string('announce_img', 45)->nullable();
        $table->integer('products_idProduct')->index('fk_Announces_products1_idx');
        $table->integer('Users_idUser')->index('fk_Announces_Users1_idx');

        return response()->json([
            'message'   => 'Your Announce has been register',
            'status'    => '200',
            'announce'  => $newAnnounce
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
        $validator = Validator::make($this->request->input('cityData'), [
            'lng' => ['required','string','regex:/^(-)?[0-9]*.[0-9]*$/'],
            'lat' => ['required','string','regex:/^(-)?[0-9]*.[0-9]*$/'],
        ]);
        return $this->resultValidator($validator);

    }

}