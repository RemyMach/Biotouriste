<?php

namespace App\Http\Controllers\API;

use App\Announce;
use App\Comment;
use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\API\NoApiClass\UsefullController;
use App\Http\Controllers\Controller;
use App\Repositories\CommentRepository;
use App\Repositories\PaymentRepository;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class CommentController extends Controller
{

    private $request;
    public function __construct()
    {
        $this->middleware('apiMergeJsonInRequest');
        $this->middleware('apiTokenAndIdUserExistAndMatch')->only(
            'CommentsOfASeller', 'store','show','destroy'
        );
    }

    public function CommentsOfASeller()
    {
        $this->request = request();

        if(!$this->request->has('idUserSeller')){

            return response()->json([
                'message'   => 'The seller doesn\'t has comments',
                'status'    => '200',
            ]);
        }

        $comments = CommentRepository::AllCommentsForASeller($this->request->input('idUserSeller'));

        if(!$comments[0]){
            return response()->json([
                'message'   => 'The Seller doesn\'t has comments',
                'status'  => '400',
            ]);
        }

        return response()->json([
            'comments'   => $comments,
            'status'  => '200',
        ]);

    }

    public function store(Request $request, UsefullController $usefullController)
    {

        $this->request = $request;

        $validator = $this->validateComment($this->request->all());

        if($validator->original['status'] == '400')
        {
            return $validator;
        }

        if(!$this->verifyIfTheUserHasDoneAPaymentForSeller()){

            return response()->json([
                'status' => '400',
                'message' => 'You can\'t do a comment because you don\'t have Payment for this Seller'
            ]);
        }

        $validData = $usefullController->keepKeysThatWeNeed($this->request->all(),['comment_subject','comment_note','comment_content']);
        $validData['Announces_idAnnounce'] = $this->request->input('idAnnounce');
        $validData['Users_idUser'] = $this->request->input('idUser');
        $validData['comment_note'] = (int) $validData['comment_note'];
        //return $validData;
        $comment = Comment::create($validData);

        return response()->json([
            'message'   => 'information has been updated',
            'status'    => '200',
            'comment'      => $comment
        ]);
    }

    public function show(Request $request)
    {
        $data = request()->all();
        $idUser = $data['idUser'];

        $user =  User::findorFail($idUser);

        return response()->json([
            'user'   => $user,
            'status'    => '200',
        ]);
    }

    public function showYourPostedComments(ApiTokenController $apiTokenController)
    {
        $requestParameters = $apiTokenController->verifyCredentials();

        if (!$requestParameters) {
            return response()->json([
                'message' => 'Your credentials are not valid',
                'status' => '400',
            ]);
        }

        $user = User::findOrFail($requestParameters['idUser']);
        //normalement ne sert à rien car findorfail sort une 404
        if(!$user)
        {
            return response()->json([
                'error'   => 'The id of the announce doesn\'t exist',
                'status'    => '400',
            ]);
        }

        $comments = $user->comments;

        if(!$comments)
        {
            return response()->json([
                'error'   => 'cet utilisateur n\'a pas posté de commentaires',
                'status'    => '200',
            ]);
        }

        $users = $this->collectCommentsUser($comments);
        if(!$comments)
        {
            return response()->json([
                'error'   => 'The seller doesn\'t has comments',
                'status'    => '200',
            ]);
        }

        return response()->json([
            'comments'  => $comments,
            'users'     => $users,
            'status'    => '200'
        ]);
    }

    public function destroy(ApiTokenController $apiTokenController)
    {
        $data = request()->all();

        $comment = $this->compareSessionUserToCommentUser($data);

        if (!$comment) {
            return response()->json([
                'message' => 'Your request is not good',
                'status' => '400',
            ]);
        }

        $comment->delete();


        return response()->json([
            'message' => 'Your comment has been destroy',
            'status' => '200',
        ]);
    }

    private function validateComment($data)
    {
        $validator = Validator::make($data, [
            'comment_subject'   => 'required|string|max:50',
            'comment_note'      => 'required|integer|max:5',
            'comment_content'   => 'required|min:5|max:200',
            'idAnnounce'        => 'required|integer',
        ]);

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

    private function collectCommentsFromAnnounces($announces)
    {
        $commentsFromAnnounces = [];
        $data = [];
        foreach ($announces as $announce){
            //$commentsFromAnnounces [] = $announce->comments;
            foreach ($announce->comments as $comment)
            {
                $data[] = $comment;
            }
        }

        return $data;
    }

    private function collectCommentsUser($comments)
    {
        $UserFromComments = [];
        foreach ($comments as $comment)
        {
            $UserFromComments[] = $comment->user;
        }
        return $UserFromComments;
    }

    private function compareSessionUserToCommentUser($data)
    {
        $comment = Comment::findorFail($data['idComment']);
        if($comment->user->idUser != $data['idUser'])
        {
            return false;
        }

        return $comment;
    }

    private function verifyIfTheUserHasDoneAPaymentForSeller(){

        $Announce = Announce::find($this->request->input('idAnnounce'));
        $payments = PaymentRepository::findPaymentsOfAUserForASeller($Announce->Users_idUser,$this->request->input('idUser'));
        if(isset($payments[0])){

            return true;
        }
        return false;
    }
}