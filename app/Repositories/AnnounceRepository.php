<?php

namespace App\Repositories;

use App\Announce;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class AnnounceRepository.
 */
class AnnounceRepository extends BaseRepository
{
    /**
    * @return string
    *  Return the model
    */
    public function model()
    {
        return Announce::class;
    }

    public static function filterByCategorieRepo($idCategorie)
    {
        return DB::table('announces')
            ->join('products', 'announces.products_idproduct', '=', 'products.idproduct')
            ->select('announces.*')
            ->where('product_categories_idproduct_category', $idCategorie)
            ->get();
    }
}
