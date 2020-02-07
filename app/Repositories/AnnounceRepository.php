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
            return DB::table('Announces')
                ->select('Announces.*')
                ->where('announce_lat', '>=', $latmin)
                ->where('announce_lat', '<=', $latmax)
                ->where('announce_lng', '>=', $lngmin)
                ->where('announce_lng', '<=', $lngmax)
                ->where('announce_is_available', '=', true)
                ->get();
        } else {
            $qb = DB::table('Announces')
                ->select('Announces.*')
                ->join('products', 'announces.products_idproduct', '=', 'products.idproduct');
                if($idCategorie == 0){
                    $qb->where('product_categories_idproduct_category', [1,2,3,4,5,6]);
                }else{
                    $qb->where('product_categories_idproduct_category', $idCategorie);
                }
                return $qb->where('announce_lat', '>=', $latmin)
                ->where('announce_lat', '<=', $latmax)
                ->where('announce_lng', '>=', $lngmin)
                ->where('announce_lng', '<=', $lngmax)
                ->where('announce_is_available', '=', true)
                ->get();
        }
    }

    public static function AnnounceThatIsAvailable($idAnnounce){

        return DB::table('Announces')
            ->where('announce_is_available','=',true)
            ->where('idAnnounce','=',$idAnnounce)
            ->get();
    }

    public static function determineIfUserOwnTheAnnounce($idAnnounce, $idUser){

        return DB::table('Announces')
            ->where('idAnnounce','=',$idAnnounce)
            ->where('Users_idUser','=',$idUser)
            ->get();
    }
}
