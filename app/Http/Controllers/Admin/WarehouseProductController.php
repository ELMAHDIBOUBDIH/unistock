<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\WarehouseProduct;
use App\Repositories\WarehouseProduct\WarehouseProductRepository;
use Illuminate\Http\Request;

class WarehouseProductController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(WarehouseProductRepository $warehouse_product)
    {
      $this->warehouse_product = $warehouse_product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $warehouse_products = $this->warehouse_product->model->all();
        return compact('warehouse_products');
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
         $warehouse_product = $this->warehouse_product->create($input);
         $success ='success';

         return compact('success','warehouse_product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WarehouseProduct  $warehouseProduct
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseProduct $warehouseProduct)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WarehouseProduct  $warehouseProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseProduct $warehouseProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WarehouseProduct  $warehouseProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $input = $request->all();
        $warehouse_product =$this->warehouse_product->model->findOrFail($id);
        $result = $this->warehouse_product->update($warehouse_product, $input);
        $success='success';

        return compact('warehouse_product','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WarehouseProduct  $warehouseProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseProduct $warehouseProduct)
    {
        //
    }
}
