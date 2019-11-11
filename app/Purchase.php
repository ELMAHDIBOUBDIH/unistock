<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
   protected $table = 'purchases';

    /**
     * The proprieties that can be filled in this model.
     */
    protected $fillable = ['purchase_number','ref_id','type','supplier_id','employee_id','Date','total_tva','total_ht','total_ttc','remise','valide','note'];

    
    /**
     * Query the user that posted the trick.
     */

    public function Purchasedetails() 
    {
    return $this->hasMany('App\PurchaseDetail' ,'purchase_id');
    }


    public function supplier()
    {
        return $this->belongsTo('App\Supplier','supplier_id');
    }
    public function employee()
    {
        return $this->belongsTo('App\Employee','employee_id');
    }
}
