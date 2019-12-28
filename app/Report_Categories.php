<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report_Categories extends Model
{
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'idReportCategorie';

    /**
     * @var array
     */
    protected $fillable = ['Report_Categorie_label'];

}
