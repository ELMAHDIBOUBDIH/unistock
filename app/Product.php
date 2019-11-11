<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $table = 'products';

    /**
     * The proprieties that can be filled in this model.
     */
     protected $fillable = ['id','brand_id','reference','code_barre','unit','cond','tva','product_facturable','product_perissable','Date_p','alert_p','etat','actif','image','description','price_ht','price_ttc','last_price','pmp','qnt_initial','alert_stock','pack','qnt_pack','price_pack','price_unit_pack','note','category_id','supplier_id'];

    
    /**
     * Query the user that posted the trick.
     */
    /**
     * Query the user that posted the trick.
     */
    public function Category() {
        return $this->belongsTo('App\Category','category_id');
    }
    public function Brand() {
        return $this->belongsTo('App\Brand','brand_id');
    }
    public function Supplier() {
        return $this->belongsTo('App\Supplier','supplier_id');
    }

    public function PriceProducts() {
        return $this->hasMany('App\PriceProduct','product_id');
    }
      
   
}
