<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Warehouse;
use App\Repositories\Warehouse\WarehouseRepository;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct( WarehouseRepository $warehouse)
    {
      $this->warehouse = $warehouse;
    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $warehouses = $this->warehouse->model->paginate(20);
       
        return compact('warehouses');
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
         $warehouse= $this->warehouse->create($input);
         $success ='success';
         return compact('warehouse','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();
        $warehouse = $this->warehouse->model->findOrFail($id);
        $warehouse= $this->warehouse->update($warehouse, $input);
         $success='success';
        return  compact('warehouse','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
         $success = $this->warehouse->model->destroy($id);
        return compact('success');
    }
}
