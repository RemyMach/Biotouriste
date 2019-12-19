<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_User extends Model
{
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

    /**
     * @var array
     */
    protected $fillable = ["idStatus_User"];

       public function status()
       {
           return $this->hasMany('App\User', 'Status_User_idStatus_User', 'idStatus_User');
       }
}
