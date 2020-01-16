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

    public static function filterByLngAndLatOrAndCategorie($lng, $lat, int $idCategorie = 0){
        $latmax = (float)$lat +1;
        $latmin = (float)$lat -1;
        $lngmax = (float)$lng +1;
        $lngmin = (float)$lng -1;
        if ($idCategorie == 0){
            return DB::table('announces')
                ->select('announces.*')
                ->where('announce_lat', '>=', $latmin)
                ->where('announce_lat', '<=', $latmax)
                ->where('announce_lng', '>=', $lngmin)
                ->where('announce_lng', '<=', $lngmax)
                ->where('announce_is_available', '=', true)
                ->get();
        } else {
            return DB::table('announces')
                ->select('announces.*')
                ->join('products', 'announces.products_idproduct', '=', 'products.idproduct')
                ->where('product_categories_idproduct_category', $idCategorie)
                ->where('announce_lat', '>=', $latmin)
                ->where('announce_lat', '<=', $latmax)
                ->where('announce_lng', '>=', $lngmin)
                ->where('announce_lng', '<=', $lngmax)
                ->where('announce_is_available', '=', true)
                ->get();
        }
    }

    public static function AnnounceThatIsAvailable($idAnnounce){

        return DB::table('announces')
            ->where('announce_is_available','=',true)
            ->where('idAnnounce','=',$idAnnounce)
            ->get();
    }

    public static function determineIfUserOwnTheAnnounce($idAnnounce, $idUser){

        return DB::table('announces')
            ->where('idAnnounce','=',$idAnnounce)
            ->where('Users_idUser','=',$idUser)
            ->get();
    }
}
