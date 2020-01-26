<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idAnnounce
 * @property string $announce_name
 * @property string $announce_status
 * @property float $announce_prix
 * @property string $announce_comment
 * @property string $announce_adresse
 * @property string $announce_date
 * @property string $announce_img
 * @property int $products_idProduct
 * @property int $Users_idUser
 * @property Product $product
 * @property User $user
 * @property Comment[] $comments
 * @property Favori[] $favoris
 * @property Message[] $messages
 * @property Order[] $orders
 * @property Report[] $reports
 * @property string $latLong

 */
class Announce extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Announces';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idAnnounce';
    /**
     * @var array
     */
    protected $fillable = ['Announces_idAnnounce', 'announce_quantity', 'announce_name', 'announce_status', 'announce_price', 'announce_comment', 'announce_adresse', 'announce_date', 'announce_img', 'products_idProduct', 'Users_idUser','announce_latLong', 'announce_city'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'products_idProduct', 'idProduct');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'Users_idUser', 'idUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'Announces_idAnnounce', 'idAnnounce');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoris()
    {
        return $this->hasMany('App\Favori', 'Announces_idAnnounce', 'idAnnounce');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('App\Message', 'Announces_idAnnounce', 'idAnnounce');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order', 'Announces_idAnnounce', 'idAnnounce');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany('App\Report', 'Announces_idAnnounce', 'idAnnounce');
    }
}
