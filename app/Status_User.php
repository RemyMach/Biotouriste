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
     * @var array
     */
    protected $fillable = ['status_user_label'];
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'idStatus_User';



    public function status()
    {
        return $this->hasMany(User::class);
    }
}
