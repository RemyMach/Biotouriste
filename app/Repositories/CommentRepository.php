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





}
