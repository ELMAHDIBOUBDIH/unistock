<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\PriceProduct;
use App\Repositories\PriceProduct\PriceProductRepository;
use Illuminate\Http\Request;

class PriceProductController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(PriceProductRepository $price_product)
    {
      $this->price_product = $price_product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $price_products = $this->price_product->model->all(); 
        return compact('price_products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
         $price_product = $this->price_product->create($input);
         $success ='success';

         return compact('success','price_product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PriceProduct  $priceProduct
     * @return \Illuminate\Http\Response
     */
    public function show(PriceProduct $priceProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PriceProduct  $priceProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceProduct $priceProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PriceProduct  $priceProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();
        $price_product =$this->price_product->model->findOrFail($id);
        $result = $this->price_product->update($price_product, $input);
        $success='success';
       
        return compact('price_product','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PriceProduct  $priceProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceProduct $priceProduct)
    {
        //
    }
}
