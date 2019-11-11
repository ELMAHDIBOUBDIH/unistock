<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $table = 'employees';

    /**
     * The proprieties that can be filled in this model.
     */
   protected $fillable = ['employ_id','group_id','company_name','first_name','last_name','gender','birthday','tel','fax','email','address','image','qualification','recruitment_date','password','note'];

    /**
     * Query the user that posted the trick.
     */
}
