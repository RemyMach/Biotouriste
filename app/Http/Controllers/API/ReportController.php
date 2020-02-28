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
use App\Repositories\ReportCategoriesRepository;
use App\Repositories\ReportRepository;
use App\User;
use Illuminate\Http\Request;
use App\Services\Mail;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{

    private $request;
    private $announce;
    private $user;
    private $report;

    public function __construct()
    {
        $this->middleware('apiMergeJsonInRequest');
        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'store','showAllMyReports'
        );

        $this->middleware('apiAdmin')->only(
            'showAllReportsForAdmin'
        );
    }

    public function store(Request $request, Mail $mail){

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

        $this->report = Report::create($validData);

        $this->sendCreatedMail($mail);

        return response()->json([
            'message'   => 'Your Report has been register',
            'status'    => '200',
            'check'     => $this->report,
        ]);
    }

    public function showAllMyReports(Request $request){

        $this->request = $request;

        $report = ReportRepository::getAllReportsFromAnUser($this->request->input('idUser'));

        return response()->json([
            'status'    => '200',
            'report'    => $report
        ]);
    }

    public function showAllReportsForAdmin(Request $request){

        $this->request = $request;

        $reports = Report::all();

        $userReportsSend = $this->getAllReportsGroupBySender($reports);

        $userReportsGroupByUserReported = $this->getAllReportsGroupByUserReported($reports);


        $reportsOrderByDateDesc = $this->getAllReportsOrderByDateDesc();

        return response()->json([
            'status'                => '200',
            'reportByUserSender'    => $userReportsSend,
            'reportByUserReported'  => $userReportsGroupByUserReported,
            'reportByDateDesc'      => $reportsOrderByDateDesc
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
            'report_comment'  => 'required|string|max:500',
            'report_subject'  => 'required|string|max:255',
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

        if($this->request->input('idUserReported') == $this->request->input('idUser')){

            return response()->json([
                'message'   => 'You can\'t report yourself',
                'status'    => '400',
            ]);
        }

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

        $idCategorie = ReportCategoriesRepository::getIdCategorieFromCategorieLabel($this->request->input('ReportCategorie'));
        $validData['ReportCategories_idReportCategorie'] = $idCategorie[0]->idReportCategorie;
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

    private function sendCreatedMail($mail){

        $userSender = User::findorFail($this->request->input('idUser'));
        $userReported = User::findorFail($this->request->input('idUserReported'));

        $mail->send('biotourist@gmail.com','ReportCreatedToAdmin',[
            'sender' => $userSender,'report' => $this->report,'UserReported' => $userReported
        ]);

        $mail->send($userSender->email,'ReportCreatedToSender',[
            'sender' => $userSender,'report' => $this->report, 'UserReported' => $userReported
        ]);
    }

    private function getAllReportsGroupBySender($reports){

        foreach($reports as $report){
            if(isset($report->Users_Reported)){
                $report->userReported;
            }
            elseif(isset($report->Announces_idAnnounce)){
                $report->announce->user;
            }
            $report->sender;
            $userReportsSend[$report->Users_idUser][] = $report;
        }

        return $userReportsSend;
    }

    private function getAllReportsGroupByUserReported($reports){

        foreach($reports as $report){
            $report->sender;
            if(isset($report->Users_Reported)){
                $report->userReported;
                $userReportsGroupByUserReported[$report->Users_Reported][] = $report;
            }
            elseif(isset($report->Announces_idAnnounce)){
                $report->announce->user;
                $userReportsGroupByUserReported[$report->announce->Users_idUser][] = $report;
            }
        }

        return $userReportsGroupByUserReported;
    }

    private function getAllReportsOrderByDateDesc(){

        $reports = Report::all()->sortByDesc('report_date');
        foreach($reports as $report){
            if(isset($report->Users_Reported)){
                $report->userReported;
            }
            elseif(isset($report->Announces_idAnnounce)){
                $report->announce->user;
            }
            $report->sender;
            $arrayreports[] = $report;
        }

        return $arrayreports;
    }
}