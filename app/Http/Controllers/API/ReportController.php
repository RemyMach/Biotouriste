<?php

namespace App\Http\Controllers\API;

use App\Announce;
use App\Favori;
use App\Http\Controllers\API\NoApiClass\UsefullController;
use App\Http\Controllers\Controller;
use App\Message;
use App\Report;
use App\Repositories\AnnounceRepository;
use App\Repositories\FavoriRepository;
use App\Repositories\MessageRepository;
use App\Repositories\Report_CategoriesRepository;
use App\User;
use Illuminate\Http\Request;
use App\Services\Mail;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{

    private $request;
    private $announce;
    private $user;

    public function __construct()
    {
        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'store'
        );
    }

    public function store(Request $request){

        $this->request = $request;

        $validator = $this->validateReported();
        if($validator->original['status'] == '400') {
            return $validator;
        }

        $resultCheck = $this->checkValIdUserReportedAndIdAnnounceIfExist();
        if($resultCheck->original['status']  == '400'){
            return $resultCheck;
        }

        $validData = $this->setValidDataDependingIdAnnounceExistence();

        $report = Report::create($validData);

        return response()->json([
            'message'   => 'Your Report has been register',
            'status'    => '200',
            'check'     => $report,
        ]);
    }

    private function validateReported(){

        if($this->request->has('idAnnounce')){

            $validator =  $this->validatorReportedWithIdAnnounce();
        }else{

            $validator =  $this->validatorReported();
        }

        return $this->resultValidator($validator);
    }

    private function validatorReported(){

        return Validator::make($this->request->all(), [
            'ReportCategorie' => ['required','string','regex:/^(Message|Announce|Commentary|behavior)$/'],
            'idUserReported'  => 'required|integer',
        ]);
    }

    private function validatorReportedWithIdAnnounce(){

        return Validator::make($this->request->all(), [
            'ReportCategorie' => ['required','string','regex:/^(Message|Announce|Commentary|behavior)$/'],
            'idUserReported'  => 'required|integer',
            'idAnnounce'      => 'required|integer',
        ]);
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

    private function checkValIdUserReportedAndIdAnnounceIfExist(){

        if($this->request->has('idAnnounce')){

             return $this->checkAnnounceExistOrExisted();
        }

        return $this->checkUserExistence();
    }

    private function checkAnnounceExistOrExisted(){

        $this->announce = AnnounceRepository::determineIfUserOwnTheAnnounce(
            $this->request->input('idAnnounce'), $this->request->input('idUserReported')
        );

        if(!isset($this->announce[0])){

            return response()->json([
                'message'   => 'The announce doesn\'t exist or the User reported doesn\'t own the announce',
                'status'    => '400',
            ]);
        }

        return response()->json([
            'status'    => '200',
        ]);
    }

    private function checkUserExistence(){

        $this->user = User::find($this->request->input('idUserReported'));

        if(!isset($this->user)){

            return response()->json([
                'message'   => 'The user doesn\'t exist',
                'status'    => '400',
            ]);
        }

        return response()->json([
            'status'    => '200',
        ]);
    }

    private function setValidDataDependingIdAnnounceExistence(){

        $idCategorie = Report_CategoriesRepository::getIdCategorieFromCategorieLabel($this->request->input('ReportCategorie'));
        $validData['Report_Categories_idReportCategorie'] = $idCategorie[0]->idReportCategorie;
        $validData['Users_idUser'] = $this->request->input('idUser');
        $validData['report_date'] = date('Y-m-d h-i-s');
        $validData['report_subject'] = $this->request->input('report_subject');
        $validData['report_comment'] = $this->request->input('report_comment');

        if($this->request->has('idAnnounce')){

            $validData['Announces_idAnnounce'] = $this->request->input('idAnnounce');
        }else{

            $validData['Users_Reported'] = $this->request->input('idUserReported');
        }

        return $validData;
    }
}