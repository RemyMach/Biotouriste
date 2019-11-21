<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password_Reset extends Model
{
    protected $primaryKey = 'email';

    protected $fillable = ['email','token','created_at'];
}
