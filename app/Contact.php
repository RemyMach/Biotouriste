<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idContact
 * @property string $contact_subject
 * @property string $contact_content
 * @property string $contact_date
 * @property int $Users_idUser
 * @property User $user
 */
class Contact extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idContact';

    /**
     * @var array
     */
    protected $fillable = ['contact_subject', 'contact_content', 'contact_date', 'Users_idUser'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'Users_idUser', 'idUser');
    }
}
