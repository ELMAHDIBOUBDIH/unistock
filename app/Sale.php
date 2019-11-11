<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
     protected $table = 'sales';

    /**
     * The proprieties that can be filled in this model.
     */
    protected $fillable = ['sale_number','ref_id','type','customer_id','employee_id','date','total_tva','total_ht','total_ttc','remise','valide','note'];


    /**
     * Query the user that posted the trick.
     */
    public function saledetails()
    {
    return $this->hasMany('App\SaleDetail' ,'sale_id');
    }


    public function customer()
    {
        return $this->belongsTo('App\Customer','customer_id');
    }
    public function employee()
    {
        return $this->belongsTo('App\Employee','employee_id');
    }
}
