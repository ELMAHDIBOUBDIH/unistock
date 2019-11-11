<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	 protected $table = 'customers';

    /**
     * The proprieties that can be filled in this model.
     */
   protected $fillable = ['group_id','company_name','first_name','last_name','gender','birthday','tel','fax','address','email','image','solde','solde_max','reg_com','mat_fisc','num_art','bloque','note'];


    /**
     * Query the user that posted the trick.
     */
    public function sale()
    {
       return $this->hasMany('App\sale','customer_id');
    }
    
     public function CustomerGroup()
    {
       return $this->belongsTo('App\CustomerGroup','group_id');
    }
}
