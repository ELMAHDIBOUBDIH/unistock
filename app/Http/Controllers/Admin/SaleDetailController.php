<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\SaleDetail;
use App\Sale;
use App\Repositories\SaleDetail\SaleDetailRepository;
use Illuminate\Http\Request;
use App\Http\Requests\SaleDetailRequest;

class SaleDetailController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(SaleDetailRepository $sale_detail)
    {
      $this->sale_detail = $sale_detail;
     
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Sale $sale)
    {
        
       $sale_details = $this->sale_detail->model->where('sale_id' , $sale->id)->orderby('id','DESC')->get();
     
        return compact('sale' ,'sale_details');
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
    public function store(SaleDetailRequest $request)
    {
        
         $input = $request->all();
         $sale_detail=$this->sale_detail->create($input);
         $success = 'success';
         return compact('sale_detail','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\saleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function show(saleDetail $saleDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\saleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(saleDetail $saleDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\saleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function update(SaleDetailRequest $request, $id)
    {

        $input = $request->all();
        $sale_detail = $this->sale_detail->model->findOrFail($id);

        $sale_detail= $this->sale_detail->update($sale_detail, $input);

       
        $success = 'success';
        return  compact('success','sale_detail');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\saleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
       $success = $this->sale_detail->model->destroy($id);
        return compact('success');
    }
}
