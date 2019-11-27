<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idCheck
 * @property string $check_prevision_date
 * @property string $check_status_verification
 * @property string $check_date
 * @property string $check_comment
 * @property int $check_customer_service
 * @property int $check_state_place
 * @property int $check_quality_product
 * @property int $check_bio_status
 * @property int $Users_idUser
 * @property int $Users_idUser1
 * @property User $user
 * @property User $user1
 */
class Check extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idCheck';

    /**
     * @var array
     */
    protected $fillable = ['check_prevision_date', 'check_status_verification', 'check_date', 'check_comment', 'check_customer_service', 'check_state_place', 'check_quality_product', 'check_bio_status', 'Users_idUser', 'Users_idUser1'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'Users_idUser', 'idUser');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Seller()
    {
        return $this->belongsTo('App\Seller', 'Sellers_idSeller', 'idSeller');
    }
}
