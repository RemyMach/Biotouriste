<?php

namespace App\Http\Controllers\API;

use App\Contact;
use App\Http\Controllers\API\NoApiClass\UsefullController;
use App\Http\Controllers\Controller;
use App\Services\Mail;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\API;

class ContactController extends Controller
{
    private $request;
    private $contact;
    private $validData;
    private $user;

    public function __construct()
    {
        $this->middleware('apiMergeJsonInRequest');
        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'store'
        );

        $this->middleware('apiAdmin')->only(
            'ContactsWithAssociedUsers','destroy'
        );
    }

    public function store(Request $request, UsefullController $usefullController, Mail $mail){

        $this->request = $request;

        $emailExistingOnlyIfUserAuthentified = $this->request->input('contact_email');

        $validator = $this->validateContact($emailExistingOnlyIfUserAuthentified);

        if($validator->original['status'] == '400') {
            return $validator;
        }

        $this->setValidData($emailExistingOnlyIfUserAuthentified, $usefullController);

        $this->contact = Contact::create($this->validData);
        $this->sendCreatedEmail($mail);

        return response()->json([
            'message'   => 'Your message has been sent !',
            'status'    => '200',
            'check'     => $this->contact,
        ]);
    }

    public function ContactsWithAssociedUsers(){

        $contacts = $this->collectContactsWithUsers();

        return [$contacts];

    }

    public function destroy(Request $request){

        $this->request = $request;

        if(!$this->verifyIfContactExist()){
            return response()->json([
                'message'   => 'The Contact doesn\'t exists',
                'status'    => '400',
            ]);
        }

        $this->contact->delete();

        return response()->json([
            'message'   => 'The contact has been deleted',
            'status'    => '200',
            'idUser'    => $this->contact
        ]);
    }

    public function ContactsOfAUser(Request $request){

        $this->request = $request;
        if(!$this->verifyIfUserExist()){
            return response()->json([
                'message'   => 'The User doesn\'t exists',
                'status'    => '400',
            ]);
        }

        //faire un try catch pour ça
        $this->collectContactsOfTheUser();

        return response()->json([
            'message'   => 'This is the Contacts of the user',
            'status'    => '200',
            'idUser'    => $this->user
        ]);
    }

    private function validateContact($emailExistingOnlyIfUserAuthentified)
    {
        if(isset($emailExistingOnlyIfUserAuthentified)){
            return $this->ValidatorForAnonymous();
        }

        return $this->ValidatorForAuthenfied();
    }

    private function ValidatorForAuthenfied(){
        $validator = Validator::make($this->request->all(), [
            'contact_subject'           => 'required|string|max:5',
            'contact_content'           => 'required|string|max:500',
        ]);

        return $this->resultValidator($validator);
    }

    private function ValidatorForAnonymous(){
        $validator = Validator::make($this->request->all(), [
            'contact_subject'           => 'required|string|max:5',
            'contact_content'           => 'required|string|max:500',
            'contact_email'             => 'email|string|max:255',
        ]);

        return $this->resultValidator($validator);
    }

    private function resultValidator($validator){

        if($validator->fails()) {
            return response()->json([
                'message'   => 'The request is not good',
                'error'     => $validator->errors(),
                'status'    => "400"
            ]);
        }
        return response()->json([
            'message'   => 'The request is good',
            'status'    => "200"
        ]);
    }

    private function setValidData($emailExistingOnlyIfUserAuthentified, $usefullController) :void
    {

        if(isset($emailExistingOnlyIfUserAuthentified)){

            $this->validData = $usefullController->keepKeysThatWeNeed($this->request->all(),
                ['contact_subject','contact_content','contact_email']
            );
        }else{

            $this->validData = $usefullController->keepKeysThatWeNeed($this->request->all(),
                ['contact_subject','contact_content']
            );
        }

        $this->setValidDataMissing();
    }

    private function setValidDataMissing() :void
    {
        if(!isset($this->validData['contact_email'])){
            $this->validData['Users_idUser'] = $this->request->input('idUser');
        }

        $date = new DateTime(date('Y-m-d'));
        $this->validData['contact_date'] = $date->format('Y-m-d');
    }

    private function sendCreatedEmail(Mail $mail){

        if(isset($this->validData['contact_email'])){
            $mail->send($this->validData['contact_email'],'ContactCreatedForAnonymousOrUser',['contact' => $this->contact]);
            $mail->send('bioTourist@gmail.com','ContactCreatedForAdmin',['email' => $this->validData['contact_email'], 'contact' => $this->contact]);
        }else{
            $this->setUser();
            $mail->send($this->user->email,'ContactCreatedForAnonymousOrUser',['user' => $this->user, 'contact' => $this->contact]);
            $mail->send('bioTourist@gmail.com','ContactCreatedForAdmin',['user' => $this->user, 'contact' => $this->contact]);
        }
    }

    private function setUser(){
        $this->user = User::findOrFail($this->request->input('idUser'));
    }

    private function collectContactsWithUsers(){
        $contacts = Contact::all();
        foreach($contacts as $contact){
            $contact->user;
        }
        return $contacts;
    }

    private function verifyIfContactExist(){

        $this->contact = Contact::findOrFail($this->request->input('idContactDelete'));
        if(!$this->contact){

            return false;
        }

        return true;
    }

    private function verifyIfUserExist(){

        $this->user = User::findOrFail($this->request->input('idUser_contacts'));
        if(!$this->user){

            return false;
        }

        return true;
    }

    private function collectContactsOfTheUser(){

        $this->user->contacts;
    }
}
