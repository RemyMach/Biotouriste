<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $iddiscount_code
 * @property int $discount_code_amount
 * @property boolean $is_use
 * @property int $Users_idUser
 * @property User $user
 */
class Discount_Code extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Discount_codes';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'iddiscount_code';

    /**
     * @var array
     */
    protected $fillable = ['discount_code_amount', 'is_use', 'Users_idUser'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'Users_idUser', 'idUser');
    }
}
