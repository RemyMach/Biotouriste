<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idOrders
 * @property string $order_quantity
 * @property int $Users_idUser
 * @property int $Announces_idAnnounce
 * @property Announce $announce
 * @property User $user
 */
class Order extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idOrders';

    /**
     * @var array
     */
    protected $fillable = ['order_quantity', 'Users_idUser', 'Announces_idAnnounce'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function announce()
    {
        return $this->belongsTo('App\Announce', 'Announces_idAnnounce', 'idAnnounce');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'Users_idUser', 'idUser');
    }
}
