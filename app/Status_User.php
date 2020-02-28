<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_User extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Status_User';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'idStatus_User';


    public function UsersId()
    {
        return $this->hasMany('App\User_Status_Correspondence', 'Status_User_idStatus_User', 'idStatus_User');
    }
}
