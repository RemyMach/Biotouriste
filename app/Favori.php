<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idFavoris
 * @property int $Users_idUser
 * @property int $Announces_idAnnounce
 * @property Announce $announce
 * @property User $user
 */
class Favori extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Favoris';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idFavoris';

    /**
     * @var array
     */
    protected $fillable = ['Users_idUser', 'Announces_idAnnounce'];

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
