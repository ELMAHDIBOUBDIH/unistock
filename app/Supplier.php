<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
     protected $table = 'suppliers';

    /**
     * The proprieties that can be filled in this model.
     */
    protected $fillable = ['company_name','first_name','last_name','gender','female','male','birthday','tel','fax','address','email','image','solde','solde_max','reg_com','mat_fisc','num_art','bloque','note'];

     /**
     * Query the user that posted the trick.
     */
     public function purchases()
    {
       return $this->hasMany('App\purchase','supplier_id');
    }

     public function products()
    {
       return $this->hasMany('App\products','supplier_id');
    }
}
