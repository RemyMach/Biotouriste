<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idproduct_category
 * @property string $product_label
 * @property Product[] $products
 */
class Product_Categories extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Product_categories';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idProduct_category';

    /**
     * @var array
     */
    protected $fillable = ['product_label'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product', 'product_categories_idproduct_category', 'idproduct_category');
    }
}
