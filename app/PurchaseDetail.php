<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
	 protected $table = 'purchase_details';

    /**
     * The proprieties that can be filled in this model.
     */
	protected $fillable = ['purchase_id','product_id','unit_price','quantity','tva_rate','montant_ttc'];
    //
      /**
     * Query the user that posted the trick.
     */

      public function product() {
        return $this->belongsTo('App\Product','product_id');
    }


public function purchase() {
        return $this->belongsTo('App\Purchase','purchase_id');
    }

 }