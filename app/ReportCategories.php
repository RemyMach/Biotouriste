<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportCategories extends Model
{
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'idReportCategorie';

    protected $table = 'ReportCategories';

    /**
     * @var array
     */
    protected $fillable = ['Report_Categorie_label'];

}
