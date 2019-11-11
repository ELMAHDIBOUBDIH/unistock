<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Sale;
use App\Repositories\Sale\SaleRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Http\Requests\SaleRequest;
use Illuminate\Http\Request;
use Route;

class SaleController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(SaleRepository $sale,CustomerRepository $customer)
    {

      $this->sale = $sale;
      $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sales = $this->sale->model;
      switch (Route::currentRouteName()) {
        case 'api::sales.quotations':
            $sales = $sales->where('type','DV');
          break;
        case 'api::sales.orders':
            $sales = $sales->where('type','DV');
          break;
        case 'api::sales.invoices':
            $sales = $sales->where('type','DV');
          break;
        case 'api::sales.client.regulations':
            $sales = $sales->where('type','DV');
          break;
        case 'api::sales.client.returns':
            $sales = $sales->where('type','DV');
          break;

      }
      $sales = $sales->orderby('id','DESC')->paginate(25);
        //select customer_name
        $customers = [];
        $users = [];
        $customers = [];
        $customers = [];
         return compact('sales', 'customers',  'users', 'types', 'regions');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $customers = $this->customer->model->all();

        return compact('customers');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
         $input = $request->all();

         $sale = $this->sale->create($input);
         $success = 'success';

         return compact('sale','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {

        return compact('sale');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {

       $customers = $this->customer->model->all();
       return compact('sale','customers');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request,$id)
    {
        $input = $request->all();
        $sale =$this->sale->model->findOrFail($id);
        $sale = $this->sale->update($sale, $input);
        $success='success';

        return compact('sale','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $success = $this->sale->model->destroy($id);
        return compact('success');
    }
}
