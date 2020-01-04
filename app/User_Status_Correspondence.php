<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Status_Correspondence extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'User_status_Correspondences';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'idUser_status_Correspondence';

    /**
     * @var array
     */
    protected $fillable = ['Users_idUser','Status_User_idStatus_User'];

    public function status()
    {
        return $this->belongsTo('App\Status_User','Status_User_idStatus_User', 'idStatus_User');
    }

    public function user()
    {
        return $this->belongsTo('App\User','Users_idUser', 'idUser');
    }

}
