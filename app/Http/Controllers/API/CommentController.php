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
    public function CommentsOfASeller()
    {
        $apiTokenController = new ApiTokenController();

        $requestParameters = $apiTokenController->verifyAdminCredentials();

        if(!$requestParameters)
        {
            return response()->json([
                'message'   => 'Your credentials are not valid',
                'status'    => '400',
            ]);
        }

        $data = request()->all();

        $announce = Announce::findOrFail($data['idAnnounce']);
        if(!$announce)
        {
            return response()->json([
                'error'   => 'The id of the announce doesn\'t exist',
                'status'    => '400',
            ]);
        }

        $announces = $announce->user->announces;

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

    public function store(Request $request)
    {
        $apiTokenController = new ApiTokenController();

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

    public function show(Request $request)
    {
        $apiTokenController = new ApiTokenController();

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

    public function keepKeysThatWeNeed(array $data,array $keys)
    {
        $validData = [];
        foreach($keys as $key => $value)
        {
            if(array_key_exists($value,$data))
            {
                $validData[$value] = $data[$value];
            }
        }
        return $validData;
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
}