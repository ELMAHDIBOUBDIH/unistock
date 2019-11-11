<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierVersement extends Model
{
     protected $table = 'supplier_versements';
 
 /**
     * The proprieties that can be filled in this model.
     */


   protected $fillable = ['n_versement','date','valide','solde','versement','reste','n_cheque','note','id_compte','id_mode','ref_id','supplier_id'];
}
