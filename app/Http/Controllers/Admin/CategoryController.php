<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Category;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(CategoryRepository $category)
    {
      $this->category = $category;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        $categories = $this->category->model->where('parent_id', null)->orderBy('id', 'asc')->paginate(15);
    
       foreach ($categories as $category) {    
         $category['products_count']=$category->articles()->count();
        }

        $all_categories = $this->category->model->all();
        $breadcrumbs = [['url' =>  '' , 'name' => trans('text.categories') ]];
        $category = null;
        return compact('categories', 'all_categories', 'breadcrumbs', 'category');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $input = $request->all();
        $category = $this->category->create($input);
        $success = 'success';
        return compact('success', 'category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        $categories = $this->category->model->where('parent_id', $category->id)->orderBy('id', 'asc')->paginate(25);
        $all_categories = $this->category->model->all();
        $breadcrumbs = $category->getBreadcrumbs();
        return compact('category', 'categories', 'all_categories', 'breadcrumbs');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        $all_categories = $this->category->model->all();

        return compact('category', 'all_categories');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request,  $id)
    {

        $input = $request->all();
        $category = $this->category->model->findOrFail($id);
        $category= $this->category->update($category, $input);
        $success = 'success';
        return  compact('success','category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
       $result = $this->category->model->destroy($id);
        return ['success' => true];
    }
}
