<?php

namespace App\Http\Controllers\API;

use App\Announce;
use App\Favori;
use App\Http\Controllers\API\NoApiClass\UsefullController;
use App\Http\Controllers\Controller;
use App\Message;
use App\Repositories\AnnounceRepository;
use App\Repositories\FavoriRepository;
use App\Repositories\MessageRepository;
use App\User;
use Illuminate\Http\Request;
use App\Services\Mail;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    private $request;
    private $announce;
    private $validData;
    private $message;

    public function __construct()
    {
        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
                'store'
        );
    }

    public function store(Request $request, Mail $mail){

        $this->request = $request;

        $validator = $this->validateMessage();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        $this->announce = Announce::find($this->request->input('idAnnounce'));

        if(!isset($this->announce)){

            return response()->json([
                'message' => 'The Announce doesn\'t exist',
                'status' => '400'
            ]);
        }

        if(!$this->setValidDataDependingOfTheAnnounceOwner()){

            return response()->json([
                'message' => 'The idSender doesn\'t correspond to the message',
                'status' => '400'
            ]);
        }


        $this->message = Message::create($this->validData);

        $this->sendCreatedEmail($mail);

        return response()->json([
            'message'   => 'Your Message has been register',
            'status'    => '200',
            'check'     => $this->message,
        ]);

    }

    public function storeForTheSellerOfAnnounce(Request $request){

        $this->request = $request;

    }

    public function showMessagesOfThisAnnounce(Request $request){

        $this->request = $request;

        //on vérifie l'id de l'annonce et si l'id du user correspond à l'id de la personne qui a posté l'annonce
        //on récupère tous les messages d'une annonce et on les groupe par l'id du User qui les envoie
    }

    private function validateMessage(){

        $validator = Validator::make($this->request->all(), [
            'message_subject'           => 'required|string|max:255',
            'message_content'           => 'required|string|max:500',
            'idAnnounce'                => 'required|integer',
        ]);

        return $this->resultValidator($validator);
    }


    private function setValidDataDependingOfTheAnnounceOwner(){

        $usefullController = new UsefullController();
        $this->validData = $usefullController->keepKeysThatWeNeed(
            $this->request->all(), ['message_subject','message_content']
        );
        $this->validData['message_date'] = date('Y-m-d h-i-s');
        $this->validData['Announces_idAnnounce'] = $this->announce->idAnnounce;


        if($this->announce->user->idUser == $this->request->input('idUser')){

            return $this->setValidDataForTheAnnounceOwner();
        }

        return $this->setValidDataForTouristController();

    }


    private function setValidDataForTheAnnounceOwner(){

        if(!$this->checkValidityIdSender()){

            return false;
        }

        $this->validData['Users_idUser'] = $this->request->input('idSender');

        return true;

    }

    private function checkValidityIdSender(){

        $validator = $this->validateIdSenderFormat();
        if($validator->original['status'] == '400') {
            return false;
        }

        return $this->checkIdSenderHasAMessageForThisAnnounce();

    }

    private function checkIdSenderHasAMessageForThisAnnounce(){

        $messages = MessageRepository::getAllMessagesOfATouristControllerForAnAnnounce(
            $this->request->input('idAnnounce'), $this->request->input('idSender')
        );
        @$AnExistingConversation = $messages[0];
        if(!isset($AnExistingConversation)){
            return false;
        }

        return true;
    }

    private function validateIdSenderFormat(){

        $validator = Validator::make($this->request->all(), [
            'idSender'           => 'required|integer|',
        ]);

        return $this->resultValidator($validator);
    }

    private function resultValidator($validator){

        if($validator->fails()) {

            return response()->json([
                'message' => 'The request is not good',
                'error' => $validator->errors(),
                'status' => '400'
            ]);
        }

        return response()->json([
            'message'   => 'The request is good',
            'status'    => '200'
        ]);
    }

    private function setValidDataForTouristController(){

        $this->validData['Users_idUser'] = $this->request->input('idUser');

        return true;
    }

    private function sendCreatedEmail($mail){

        if($this->request->has('idSender') === true){
            $this->sendWhenSenderIsAnnounceOwner($mail);
        }else{
            $this->sendWhenSenderIsTouristController($mail);
        }
    }

    private function sendWhenSenderIsAnnounceOwner($mail){

        $TouristControllerUser = User::findorFail($this->request->input('idSender'));
        $mail->send($TouristControllerUser->email,'MessageCreatedForTheReceiver',[
            'receiver' => $TouristControllerUser->email,'sender' => $this->announce->user,'message' => $this->validData, 'announce' => $this->announce
        ]);
        $mail->send($this->announce->user->email,'MessageCreatedForTheSender', [
            'receiver' => $TouristControllerUser->email,'sender' => $this->announce->user,'message' => $this->validData, 'announce' => $this->announce
        ]);
    }

    private function sendWhenSenderIsTouristController($mail){

        $TouristControllerUser = User::findorFail($this->request->input('idUser'));
        $mail->send($this->announce->user->email,'MessageCreatedForTheReceiver',[
            'receiver' => $this->announce->user,'sender' => $TouristControllerUser,'message' => $this->validData, 'announce' => $this->announce
        ]);
        $mail->send($TouristControllerUser->email,'MessageCreatedForTheSender', [
            'receiver' => $this->announce->user,'sender' => $TouristControllerUser,'message' => $this->validData, 'announce' => $this->announce
        ]);
    }

}