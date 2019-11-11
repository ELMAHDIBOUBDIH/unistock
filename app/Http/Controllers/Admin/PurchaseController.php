<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Purchase;
use App\Repositories\Purchase\PurchaseRepository;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\product\ProductRepository;
use App\Http\Requests\PurchaseRequest;

use Illuminate\Http\Request;
use Route;
use Carbon\Carbon;

class PurchaseController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(PurchaseRepository $purchase , SupplierRepository $supplier , ProductRepository $product )
    {
      $this->purchase = $purchase;
      $this->supplier = $supplier;
      $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $purchases = $this->purchase->model;
         switch (Route::currentRouteName()) {
           case 'api::purchases.orders':
               $purchases = $purchases->where('type','DV');
             break;
           case 'api::purchase.invoices':
               $purchases = $purchases->where('type','PI');
             break;
           case 'api::purchase.supplier.regulations':
               $purchases = $purchases->where('type','PSRG');
             break;
           case 'api::purchase.supplier.returns':
               $purchases = $purchases->where('type','PSRT');
             break;

         } 

         $purchases = $purchases->orderby('id','DESC')->paginate(25);
          
         foreach ($purchases as $purchase) {
              $purchase['supplier_name']  = $purchase->supplier->first_name .' '. $purchase->supplier->last_name;
          }

        

         return compact('purchases');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $now = Carbon::now();
        $suppliers = $this->supplier->model->all();
        $purchase = $this->purchase->model->orderby('id','desc')->first();
        $purchase->purchase_number = substr($now->year,-2) .''. $now->month.''.$now->day.''.str_pad($purchase->id,5,"0",STR_PAD_LEFT);
        $products=$this->product->model->all();

        return compact('suppliers','purchase','products');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {

         $input = $request->all();
         $purchase = $this->purchase->create($input);
         $success = 'success';

         return compact('purchase','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {

       return compact('purchase');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit( Purchase $purchase)
    {

         $suppliers = $this->supplier->model->all();

         return compact('purchase','suppliers');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseRequest $request, $id)
    {
        $input = $request->all();
        $purchase =$this->purchase->model->findOrFail($id);
        $purchase = $this->purchase->update($purchase, $input);
        $success='success';

        return compact('purchase','success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $success = $this->purchase->model->destroy($id);
        return compact('success');
    }
}
