<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\SupplierVersement;
use Illuminate\Http\Request;
use App\Repositories\SupplierVersement\SupplierVersementRepository;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\PaymentMode\PaymentModeRepository;
use App\Repositories\Compte\CompteRepository;

class SupplierVersementController extends Controller
{
    /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(SupplierVersementRepository $Supplier_versement, PaymentModeRepository $payment_mode ,CompteRepository $compte,SupplierRepository $Supplier)
    {
        $this->Supplier_versement = $Supplier_versement;
        $this->payment_mode       = $payment_mode;
        $this->compte             = $compte;
        $this->Supplier          = $Supplier;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $Supplier_versements = $this->Supplier_versement->model->all();
      return compact('Supplier_versements');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $Suppliers = $this->Supplier->model->all();
      $payment_modes = $this->payment_mode->model->all();
      $compte = $this->compte->model->all();

      return compact('Suppliers','payment_modes','compte');
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
      $Supplier_versement= $this->Supplier_versement->create($input);
      $success ='success';
      return compact('Supplier_versement','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SupplierVersements  $SupplierVersements
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $Supplier_versement = $this->Supplier_versement->model->findOrFail($id);
      
      return compact('Supplier_versement');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SupplierVersements  $SupplierVersements
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $Supplier_versement = $this->Supplier_versement->model->findOrFail($id);
      $Suppliers = $this->Supplier->model->all();
      $payment_modes = $this->payment_mode->model->all();
      $compte = $this->compte->model->all();

      return compact('Suppliers','payment_modes','compte','Supplier_versement');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SupplierVersements  $SupplierVersements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       $input = $request->all();
       $Supplier_versement = $this->Supplier_versement->model->findOrFail($id);
       $Supplier_versement= $this->Supplier_versement->update($Supplier_versement, $input);
       $success='success';
       return  compact('Supplier_versement','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SupplierVersements  $SupplierVersements
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $success = $this->Supplier_versement->model->destroy($id);
        return compact('success');
    }
    
}
