<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idMessage
 * @property string $message_subject
 * @property string $message_content
 * @property int $Announces_idAnnounce
 * @property int $Users_idUser
 * @property string $message_date
 * @property Announce $announce
 * @property User $user
 */
class Message extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idMessage';

    /**
     * @var array
     */
    protected $fillable = ['message_subject', 'message_content', 'Announces_idAnnounce', 'Users_idUser', 'message_date'];

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
