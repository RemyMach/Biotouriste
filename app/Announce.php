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
 * @property int $Products_idProduct
 * @property int $Users_idUser
 * @property Product $product
 * @property User $user
 * @property Comment[] $comments
 * @property Favori[] $favoris
 * @property Message[] $messages
 * @property Order[] $orders
 * @property Report[] $reports
 * @property int $announce_quantity
 * @property boolean $announce_is_available
 * @property float $announce_price
 * @property string $announce_measure
 * @property string $announce_city
 * @property float $announce_lat
 * @property float $announce_lng
 */
class Announce extends Model
{
    public $timestamps = false;

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
    protected $fillable =['announce_lot', 'announce_city', 'announce_measure', 'announce_name', 'announce_price', 'Products_idProduct', 'Users_idUser', 'announce_comment', 'announce_img', 'announce_lat', 'announce_lng', 'announce_adresse', 'announce_date', 'announce_is_available', 'announce_quantity'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'Products_idProduct', 'idProduct');
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
