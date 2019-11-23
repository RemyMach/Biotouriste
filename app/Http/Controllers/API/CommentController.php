<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Http\Controllers\API\ApiTokenController;
use App\Http\Controllers\Controller;
use App\User;
use http\Env\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class CommentController extends Controller
{

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
        $validData['Users_idUser'] = $requestParameters['idUser'];

        $comment = Comment::create($data);

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
            'comment_subject'   => 'required','string','max:50',
            'comment_note'      => 'required','between:0,5',
            'comment_content'   => 'required','min:5','max:200'
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
            if(array_key_exists($key,$data))
            {
                $validData[$key] = $data[$key];
            }
        }

        return $validData;
    }
}