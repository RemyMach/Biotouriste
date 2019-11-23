<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idComment
 * @property string $comment_content
 * @property float $comment_note
 * @property string $comment_subject
 * @property int $Announces_idAnnounce
 * @property int $Users_idUser
 * @property Announce $announce
 * @property User $user
 */
class Comment extends Model
{
    public $timestamps = false;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idComment';

    /**
     * @var array
     */
    protected $fillable = ['comment_content', 'comment_note', 'comment_subject', 'Announces_idAnnounce', 'Users_idUser'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function announce()
    {
        return $this->belongsTo('App\Announce', 'Announces_idAnnounce', 'idAnnounce');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'Users_idUser', 'idUser');
    }
}
