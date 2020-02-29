<?php


namespace App\Http\Controllers\API;


use App\Announce;
use App\Http\Controllers\Controller;
use App\Product;
use App\Repositories\AnnounceRepository;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnounceController extends Controller
{
    private $request;

    public function selectHistorySeller(Request $request){
        $this->request = $request;
        $data = $request->all();
        $announces = Announce::where('Users_idUser', $data['idUser'])
            ->where('announce_is_available', 1)
            ->orderBy('announce_date')->get();
        $products = Product::all();
        return response()->json([
            'announces' => $announces,
            'totalAnnounces' => count($announces),
            'products' => $products,
            'status' => '200'
        ]);
    }

    public function update(Request $request){
        $this->request = $request;
        $data = $request->all();
        $announce = Announce::find($data['idAnnounce']);
        if($announce === null){
            return response()->json([
                'error'   => 'The announce does not exist, we cant update it',
                'status'    => '400']);
        }
        $validator = $this->validateNewQuantity();
        if($validator->original['status'] == '400') {
            return $validator;
        }
        $announce->announce_quantity = $data['newQuantityToAdd'];
        $announce->save();
        return response()->json([
            'announce' => $announce,
            'status' => '200'
        ]);
    }

    public function delete(Request $request){
        $this->request = $request;
        $data = $request->all();
        $announce = Announce::find($data['idAnnounce']);
        if($announce === null){
            return response()->json([
                'error'   => 'The announce does not exist, we cant delete it',
                'status'    => '400'
            ]);
        }

        $announce->announce_is_available = false;
        $announce->save();
        return response()->json([
            'message'    => 'Announce has been deleted, but never forget to respect your order.',
            'status' => '200'
        ]);
    }

    public function store(Request $request){

        $this->request = $request;

        $data = $request->all();
        $col =[
            'announce_lot' => 0,'announce_measure' => 0, 'announce_name' => 0,'announce_price' => 0,'announce_comment' => 0,'announce_adresse' => 0,'announce_city' => 0,
            'announce_img' => 0,'products_idProduct' => 0,'Users_idUser' => 0,'announce_lat' => 0,'announce_lng' => 0,'announce_quantity' => 0, 'announce_is_available' => 1
        ];
        // fusionne tab1 et tab2 si les key dans le tab 1 exist dans le 2 avec les value du tab 2
        $newAnnounce = array_merge($col, array_intersect_key($data, $col));
        $newAnnounce['announce_date'] = DateTime::createFromFormat('Y-m-d H:i:s', NOW());
        $newAnnounce['Users_idUser'] = $data['idUser'];
        $validator = $this->validateAnnounce($newAnnounce);
        if($validator->original['status'] == '400') {
            return $validator;
        }
        $announce = Announce::create($newAnnounce);

        return response()->json([
            'message'   => 'Your Announce has been register',
            'status'    => '200',
            'announce'  => $announce
        ]);
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

    private function validateAnnounce($announce){
        $validator = Validator::make($announce, [
            'announce_lat' => ['required','string','regex:/^(-)?[0-9]*.[0-9]*$/'],
            'announce_lng' => ['required','string','regex:/^(-)?[0-9]*.[0-9]*$/'],
            'announce_price' => ['required','string'],
            'announce_name' => ['required','string'],
            'announce_measure' => ['required','string'],
            'announce_adresse' => ['required','string'],
            'announce_city' => ['required','string'],
            'products_idProduct' => ['required','int'],
            'Users_idUser' => ['required','int'],
            'announce_quantity' => ['required','string'],
        ]);
        return $this->resultValidator($validator);
    }

    private function validateNewQuantity(){
        $validator = Validator::make($this->request->all(), [
            'newQuantityToAdd' => ['required','int']
        ]);
        return $this->resultValidator($validator);
    }

}