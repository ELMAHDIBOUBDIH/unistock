<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $table = 'customer_groups';
     /**
     * The proprieties that can be filled in this model.
     */
   protected $fillable = ['name','description'];
}
