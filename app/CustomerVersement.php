<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerVersement extends Model
{
    protected $table = 'customer_versements';
 
 /**
     * The proprieties that can be filled in this model.
     */


   protected $fillable = ['n_versement','date_v','valide','solde','versement','reste','n_cheque','note','id_compte','id_mode','ref_id','customer_id'];
}
