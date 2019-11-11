<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Supplier;
use App\Repositories\Supplier\SupplierRepository;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct( SupplierRepository $supplier)
    {
      $this->supplier = $supplier;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $input = $request->all(); 
        $suppliers = $this->supplier->search_filter($input);
        return compact('suppliers');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $resluts = $this->supplier->model->take(25)->get();
        return compact('resluts');
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
    public function store(StoreSupplierRequest $request)
    {

        $input = $request->all();
        $supplier = $this->supplier->create($input);

        $success ='success';
        return compact('success','supplier');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {

         return compact('supplier');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {

         return compact('supplier');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request,$id)
    {
        $input = $request->all();
        $supplier =$this->supplier->model->findOrFail($id);
        $supplier = $this->supplier->update($supplier, $input);
        $success='success';
        return compact('supplier','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = $this->supplier->model->destroy($id);
        return compact('success');
    }

}
