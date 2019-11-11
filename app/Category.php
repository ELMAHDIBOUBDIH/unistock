<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $table = 'categories';

    /**
     * The proprieties that can be filled in this model.
     */
    protected $fillable = [ 'name', 'parent_id', 'description' ];


    /**
     * Get the language of the article.
     */
    public function parente() {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    /**
     * Query the user that posted the trick.
     */
    public function articles() {
        return $this->hasMany('App\Product','category_id');
    }

    public function getBreadcrumbs() {
      $breadcrumbs = [];
      $breadcrumbs[] = ['url' =>  '' , 'name' => $this->name ];
      $cat = $this->parente;
      while ($cat) {
        $breadcrumbs[] = ['url' =>  '/admin/categories/' . $cat->id, 'name' => $cat->name];
        $cat = $cat->parente;
      }
      $breadcrumbs[] = ['url' =>  '/admin/categories' , 'name' => trans('text.categories') ];
      return array_reverse($breadcrumbs);
    }
}
