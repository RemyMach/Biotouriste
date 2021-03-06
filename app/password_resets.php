<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class password_resets extends Model
{
    //to disable created_at and updated_at when creating a new password_resets.
    public $timestamps = false;

    protected $table = 'password_resets';

    protected $primaryKey = 'idPasswordReset';

    protected $fillable = ['email','token','created_at'];
}
