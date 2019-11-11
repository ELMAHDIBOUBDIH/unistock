<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
	protected $table = 'Warehouses';

    /**
     * The proprieties that can be filled in this model.
     */
    protected $fillable = ['name','address','note'];
     /**
     * Query the user that posted the trick.
     */
}
