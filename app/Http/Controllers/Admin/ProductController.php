<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Product;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\PriceProduct\PriceProductRepository;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\CustomerGroup\CustomerGroupRepository;
use App\Repositories\Brand\BrandRepository;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct( ProductRepository $product,CategoryRepository $category ,PriceProductRepository $Priceproduct , SupplierRepository $supplier, CustomerGroupRepository $CustomerGroup,BrandRepository $brand)
    {
      $this->product = $product;
      $this->category = $category;
      $this->Priceproduct = $Priceproduct;
      $this->supplier = $supplier;
      $this->CustomerGroup = $CustomerGroup;
      $this->brand = $brand;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          $input = $request->all();
          $products = $this->product->search_input($input);

          foreach ($products as $product) {
              $product['category_name']  = $product->Category->name;
              $product['brand_name']     = $product->Brand->name;
          }
          $categories  = $this->category->model->all();
          $brands=$this->brand->model->all();
          return compact('products', 'categories', 'brands');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $resluts = $this->product->model->take(25)->get();
        return compact('resluts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function create()
    {

        $categories  = $this->category->model->all();
        $suppliers=$this->supplier->model->all();
        foreach ($suppliers as $supplier) {
        $supplier['name']  = $supplier->first_name .' '. $supplier->last_name ;
           }
          
        $CustomerGroup=$this->CustomerGroup->model->all();
        $brands=$this->brand->model->all();
        return compact('categories','suppliers','CustomerGroup','brands');
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
         $product = $this->product->create($input);
         $success = 'success';
         return compact('success', 'product');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $products = $this->product->model->paginate(25);
        $product['category_name']     = $product->Category->name;
        $product['brand_name']        = $product->Brand->name;
        $product['supplier_name']     = $product->Supplier->first_name.' '.$product->Supplier->last_name;

         return compact('product', 'products');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

         $categories  = $this->category->model->all();
         $suppliers=$this->supplier->model->all();
         $brands=$this->brand->model->all();
         foreach ($suppliers as $supplier) {
         $supplier['name']  = $supplier->first_name .' '. $supplier->last_name ;
         }
         $CustomerGroup=$this->CustomerGroup->model->all();
         $all_prices = $product->PriceProducts;
         $prices = array();
        foreach ($CustomerGroup as $key => $groupe) { 

          $prices['price_ht'][$key]= '';
          $prices['price_ttc'][$key]= '';
          $prices['marge'][$key]= '';

        }
        foreach ($all_prices as $key => $price ) {

               $prices['price_ht'][$price['group_id']]= $price['montant_ht'];
               $prices['price_ttc'][$price['group_id']]= $price['montant_ttc'];
               $prices['marge'][$price['group_id']]= $price['marge'];
         }

        
         return compact('product','categories','suppliers','brands','CustomerGroup','prices');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
       $input = $request->all();
       $product = $this->product->model->findOrFail($id);
       $product = $this->product->update($product, $input);
       $success = 'success';
        return  compact('success','product');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $success = $this->product->model->destroy($id);

       return  compact('success');
    }
}
