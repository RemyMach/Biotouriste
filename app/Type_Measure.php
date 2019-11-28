<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idTypes_measure
 * @property string $Type_measure_label
 */
class Type_Measure extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'types_measure';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idTypes_measure';

    /**
     * @var array
     */
    protected $fillable = ['Type_measure_label'];

}
