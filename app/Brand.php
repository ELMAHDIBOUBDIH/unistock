<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    /**
     * The proprieties that can be filled in this model.
     */
    protected $fillable = [ 'name', 'description' ];
     /**
     * Query the user that posted the trick.
     */
    public function articles() {
        return $this->hasMany('App\Product','Brand_id');
    }
}
