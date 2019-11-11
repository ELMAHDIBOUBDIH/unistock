<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\WarehouseInput;
use App\Repositories\WarehouseInput\WarehouseInputRepository;
use Illuminate\Http\Request;

class WarehouseInputController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(WarehouseInput $warehouse_input, WarehouseInputRepository $warehouse_inputRepo)
    {
      $this->warehouse_input = $warehouse_input;
      $this->warehouse_inputRepo = $warehouse_inputRepo;
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
     * @param  \App\WarehouseInput  $warehouseInput
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseInput $warehouseInput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WarehouseInput  $warehouseInput
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseInput $warehouseInput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WarehouseInput  $warehouseInput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WarehouseInput $warehouseInput)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WarehouseInput  $warehouseInput
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseInput $warehouseInput)
    {
        //
    }
}
