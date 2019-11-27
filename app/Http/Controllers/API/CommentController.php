<?php

namespace App\Http\Controllers\API;

use App\Announce;
use App\Comment;
use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function CommentsOfASeller(ApiTokenController $apiTokenController)
    {
        $requestParameters = $apiTokenController->verifyAdminCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }

        $data = request()->all();

        if(isset($data['idAnnounce'])){
            //pour quand on est fait une recherche depuis l'id d'une annonce
            $announce = Announce::findOrFail($data['idAnnounce']);
            if(!$announce)
            {
                return response()->json([
                    'error'   => 'The id of the announce doesn\'t exist',
                    'status'    => '400',
                ]);
            }

            $announces = $announce->user->announces;
        }else{
            //pour quand on est dans le profil pour que le vendeur voit tous ses comments
            $user = User::findOrFail($requestParameters['idUser']);
            //normalement ne sert à rien car findorfail sort une 404
            if(!$user)
            {
                return response()->json([
                    'error'   => 'The id of the announce doesn\'t exist',
                    'status'    => '400',
                ]);
            }
        }

        $comments = $this->collectCommentsFromAnnounces($announces);
        if(!$comments)
        {
            return response()->json([
                'error'   => 'The seller doesn\'t has comments',
                'status'    => '200',
            ]);
        }

        $users = $this->collectCommentsUser($comments);

        return response()->json([
            'comments'  => $comments,
            'users'     => $users,
            'status'    => '200'
            ]);
    }

    public function store(Request $request,ApiTokenController $apiTokenController)
    {
        $requestParameters = $apiTokenController->verifyCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }

        $data = request()->all();

        $validator = $this->validateComment($data);

        if($validator->original['status'] == '400')
        {
            return $validator;
        }
        $validData = $this->keepKeysThatWeNeed($data,['comment_subject','comment_note','comment_content']);
        $validData['Announces_idAnnounce'] = 1;
        $validData['Users_idUser'] = (int) $requestParameters['idUser'];
        $validData['comment_note'] = intval($validData['comment_note']);
        //return $validData;
        $comment = Comment::create($validData);

        return response()->json([
            'message'   => 'information has been updated',
            'status'    => '200',
            'comment'      => $comment
        ]);
    }

    public function show(Request $request,ApiTokenController $apiTokenController)
    {
        $requestParameters = $apiTokenController->verifyCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }

        $idUser = $requestParameters['idUser'];

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
        $requestParameters = $apiTokenController->verifyCredentials();

        if (!$requestParameters) {
            return response()->json([
                'message' => 'Your credentials are not valid',
                'status' => '400',
            ]);
        }
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

    protected function validateComment($data)
    {
        $validator = Validator::make($data, [
            'comment_subject'   => 'required|string|max:50',
            'comment_note'      => 'required|integer|max:5',
            'comment_content'   => 'required|min:5|max:200'
        ]);

        if($validator->fails())
        {
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

    protected function collectCommentsFromAnnounces($announces)
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

    protected function collectCommentsUser($comments)
    {
        $UserFromComments = [];
        foreach ($comments as $comment)
        {
            $UserFromComments[] = $comment->user;
        }
        return $UserFromComments;
    }

    protected function compareSessionUserToCommentUser($data)
    {
        $comment = Comment::findorFail($data['idComment']);
        if($comment->user->idUser != $data['idUser'])
        {
            return false;
        }

        return $comment;
    }
}