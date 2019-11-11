<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceProduct extends Model
{
    protected $table = 'price_products';
     /**
     * The proprieties that can be filled in this model.
     */
    protected $fillable = [ 'marge', 'montant_ht', 'montant_ttc' ,'product_id','group_id'];

    public function Products() {
        return $this->hasMany('App\Product','product_id');
    }
}
