<?php

namespace App\Repositories;

use App\Check;
use App\Comment;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class AnnounceRepository.
 */
class CommentRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Comment::class;
    }

    public static function AllCommentsForASeller($idUserSeller){

        return DB::table('Comments')
            ->join('Announces','Comments.Announces_idAnnounce','Announces.idAnnounce')
            ->join('Users','Comments.Users_idUser','Users.idUser')
            ->select('Announces.*','Users.*','Comments.comment_note','Comments.idComment','Comments.comment_content','Comments.comment_subject','Comments.Users_idUser as Comments_User')
            ->where('Announces.Users_idUser','=',$idUserSeller)
            ->orderBy('Comments.comment_date')
            ->get();
    }
}
