<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idPayment
 * @property string $payment_status
 * @property string $payment_amount
 * @property string $payment_currency
 * @property string $payment_date
 * @property string $payer_email
 * @property int $payer_paypal_id
 * @property string $payer_first_name
 * @property string $payer_last_name
 * @property int $Orders_idOrders
 */
class Payment extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idPayment';

    /**
     * @var array
     */
    protected $fillable = ['order_quantity', 'Users_idUser', 'Announces_idAnnounce','payment_status', 'payment_amount', 'payment_currency', 'payment_date', 'payer_paypal_id', 'payer_first_name', 'payer_last_name', 'Orders_idOrders'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function announce()
    {
        return $this->belongsTo('App\Payment', 'Announces_idAnnounce', 'idAnnounce');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'Users_idUser', 'idUser');
    }
}
