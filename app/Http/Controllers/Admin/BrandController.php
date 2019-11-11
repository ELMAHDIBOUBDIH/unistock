<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Brand;
use App\Repositories\Brand\BrandRepository;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(BrandRepository $brand)
    {
      $this->brand = $brand;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = $this->brand->model->all();
    
        return compact('brands');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $brand = $this->brand->create($input);
        $success = 'success';
        return compact('success', 'brand');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function show(Brands $brands)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function edit(Brands $brands)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $brand = $this->brand->model->findOrFail($id);
        $brand= $this->brand->update($brand, $input);
        $success = 'success';
        return  compact('success','brand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = $this->brand->model->destroy($id);
        
        return compact('success');
    }
}
