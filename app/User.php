<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $primaryKey = 'idUser';

    protected $table = 'Users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name','user_surname','user_adress','user_postal_code','user_phone','email',
        'password','user_img','remember_token','Status_User_idStatus_User','api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function statusId()
    {
        return $this->hasMany('App\User_Status_Correspondence',"Users_idUser", "idUser");
    }

    public function announces()
    {
        return $this->hasMany('App\Announce', 'Users_idUser', 'idUser');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment','Users_idUser','idUser');
    }

    public function checks()
    {
        return $this->hasMany('App\Check','Users_idUser','idUser');
    }

    public function checks1()
    {
        return $this->hasMany('App\Check','Users_idUser1','idUser');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact','Users_idUser','idUser');
    }

    public function discount_codes()
    {
        return $this->hasMany('App\Discount_Code','Users_idUser','idUser');
    }
}
