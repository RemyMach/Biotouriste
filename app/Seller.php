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

    protected $table = 'Sellers';

    /**
     * @var array
     */
    protected $fillable = ['seller_adress','seller_postal_code','seller_city','seller_product_bio', 'seller_description', 'Users_idUser','seller_verify'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'Users_idUser', 'idUser');
    }
}
