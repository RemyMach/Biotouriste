<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestController extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'RequestController';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idRequestController';

    /**
     * @var array
     */
    protected $fillable = ['requestcontroller_date','Users_idUser'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'Users_idUser', 'idUser');
    }
}
