<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\WarehouseOutput;
use App\Repositories\WarehouseOutput\WarehouseOutputRepository;
use Illuminate\Http\Request;

class WarehouseOutputController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(WarehouseOutput $warehouse_output, WarehouseOutputRepository $warehouse_outputRepo)
    {
      $this->warehouse_output = $warehouse_output;
      $this->warehouse_outputRepo = $warehouse_outputRepo;
      $this->middleware('editor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WarehouseOutput  $warehouseOutput
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseOutput $warehouseOutput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WarehouseOutput  $warehouseOutput
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseOutput $warehouseOutput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WarehouseOutput  $warehouseOutput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WarehouseOutput $warehouseOutput)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WarehouseOutput  $warehouseOutput
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseOutput $warehouseOutput)
    {
        //
    }
}
