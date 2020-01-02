<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class Discount_CodeRepository.
 */
class ReportCategoriesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public static function getIdCategorieFromCategorieLabel($categorie_label){

        return DB::table('ReportCategories')
            ->where('Report_Categorie_label','=',$categorie_label)
            ->get();
    }
}
