<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idSeller
 * @property boolean $seller_product_bio
 * @property string $seller_description
 * @property int $Users_idUser
 * @property User $user
 * @method static findOrFail($idSeller)
 */
class Seller extends Model
{
    public $timestamps = false;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idSeller';

    /**
     * @var array
     */
    protected $fillable = ['seller_product_bio', 'seller_description', 'Users_idUser'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'Users_idUser', 'idUser');
    }
}
