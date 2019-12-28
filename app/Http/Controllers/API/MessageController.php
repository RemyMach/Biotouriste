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
            'messages'     => $this->message,
        ]);

    }

    public function showMessagesOfATouristController(Request $request){

        $this->request = $request;

        $validator = $this->validateIdAnnounce();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        $provisionalAnnounces = MessageRepository::getAllAnnouncesWhereUserSendAMessage($this->request->input('idUser'));
        if(!isset($provisionalAnnounces[0])){
            return response()->json([
                'message'   => 'No Announces with Messages for this User',
                'status'    => '400',
            ]);
        }

        $announces = $this->getArrayIdAnnouncesFromprovisionalAnnounces($provisionalAnnounces);
        $messages = MessageRepository::getAllMessagesFromAnnouncesAndTouristController($this->request->input('idUser'),$announces);
        if(!isset($messages[0])){
            return response()->json([
                'message'   => 'No Messages for this User',
                'status'    => '400',
            ]);
        }

        //trié par annnonce puis par TouristController et Seller
        $arraymessages = $this->filterByConversationBetweenTouristControllerSeller($messages);

        return response()->json([
            'message'   => 'Your receive your messages',
            'status'    => '200',
            'messages'     => $arraymessages,
        ]);
    }

    public function showMessagesOfASeller(Request $request){

        $this->request = $request;

        $validator = $this->validateIdAnnounce();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        $provisionalAnnounces = MessageRepository::getAllAnnouncesWithMessagesFromASeller($this->request->input('idUser'));
        if(!isset($provisionalAnnounces[0])){
            return response()->json([
                'message'   => 'No Announces with Messages for this Seller',
                'status'    => '400',
            ]);
        }

        $announces = $this->getArrayIdAnnouncesFromprovisionalAnnounces($provisionalAnnounces);
        $messages = MessageRepository::getAllMessagesFromAnnouncesAndSeller($this->request->input('idUser'),$announces);
        if(!isset($messages[0])){
            return response()->json([
                'message'   => 'No Messages for this User',
                'status'    => '400',
            ]);
        }

        $arraymessages = $this->filterByConversationBetweenTouristControllerSeller($messages);

        return response()->json([
            'message'   => 'Your receive your messages',
            'status'    => '200',
            'messages'  => $arraymessages,
        ]);
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
        $this->validData['message_idSender'] = $this->request->input('idUser');

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
            'idSender'           => 'required|integer',
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
        $this->validData['message_idSender'] = $this->request->input('idUser');

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

    private function validateIdAnnounce(){

        $validator = Validator::make($this->request->all(), [
            'idAnnounce'  => 'required|integer',
        ]);

        return $this->resultValidator($validator);
    }

    private function getArrayIdAnnouncesFromprovisionalAnnounces($provisionalAnnounces){

        foreach($provisionalAnnounces as $announce){
            $announces[] = $announce->Announces_idAnnounce;
        }

        return $announces;
    }

    private function filterByConversationBetweenTouristControllerSeller($messages){

        $arrayMessages = [];
        $conversations = [];
        foreach($messages as $message){
            $arrayMessages[$message->Announces_idAnnounce][$message->Users_idUser][] = $message;
        }

        foreach($arrayMessages as $arrayMessage){
            foreach($arrayMessage as $message){
                $conversations[] = $message;
            }
        }

        return $conversations;
    }

}