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
    protected $fillable;

    public function status()
    {
        return $this->hasMany(User::class);
    }
}
