<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseProduct extends Model
{
  // protected $table = 'WarehouseProduct';

    /**
     * The proprieties that can be filled in this model.
     */
    
    protected $fillable = ['warehouse_id','product_id','quantity','quantity_reserved','zone','shelf','note'];
     /**
     * Query the user that posted the trick.
     */
}
