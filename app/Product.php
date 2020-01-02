<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $product_categories_idproduct_category
 * @property int $idProduct
 * @property string $product_name
 * @property int $Types_measure_idTypes_measure
 * @property ProductCategory $productCategory
 * @property TypesMeasure $typesMeasure
 */
class Product extends Model
{
    public $timestamps = false;
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idProduct';

    /**
     * @var array
     */
    protected $fillable = ['product_categories_idproduct_category', 'product_name', 'Types_measure_idTypes_measure'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productCategory()
    {
        return $this->belongsTo('App\ProductCategory', 'product_categories_idproduct_category', 'idproduct_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typesMeasure()
    {
        return $this->belongsTo('App\TypesMeasure', 'Types_measure_idTypes_measure', 'idTypes_measure');
    }
}
