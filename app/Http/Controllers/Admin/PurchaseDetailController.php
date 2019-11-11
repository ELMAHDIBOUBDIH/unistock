<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\PurchaseDetail;
use App\Purchase;
use App\Repositories\PurchaseDetail\PurchaseDetailRepository;
use App\Repositories\Purchase\PurchaseRepository;
use App\Http\Requests\PurchaseDetailRequest;
use Illuminate\Http\Request;

class PurchaseDetailController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct( PurchaseDetailRepository $purchase_detail)
    {
      $this->purchase_detail = $purchase_detail;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Purchase $purchase)
    {
        
       $purchase_details = $this->purchase_detail->model->where('purchase_id' , $purchase->id)->orderby('id','DESC')->get();
     
        return compact('purchase' ,'purchase_details');
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
    public function store(PurchaseDetailRequest $request)
    {
         $input = $request->all();
         $purchase_detail=$this->purchase_detail->create($input);
         $success = 'success';
         return compact('purchase_detail','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseDetailRequest $request, $id)
    {

        $input = $request->all();
        $purchase_detail = $this->purchase_detail->model->findOrFail($id);

        $purchase_detail= $this->purchase_detail->update($purchase_detail, $input);

       
        $success = 'success';
        return  compact('success','purchase_detail');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
       $success = $this->purchase_detail->model->destroy($id);
        return compact('success');
    }
}
