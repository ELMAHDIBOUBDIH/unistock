<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
	 protected $table = 'sale_details';

    /**
     * The proprieties that can be filled in this model.
     */
   protected $fillable = ['sale_id','product_id','unit_price','quantity','tva_rate','montant_ttc'];

     /**
     * Query the user that posted the trick.
     */
       public function product() {

        return $this->belongsTo('App\Product','product_id');
    }


       public function sale() {

        return $this->belongsTo('App\Sale','sale_id');
    }
     
}
