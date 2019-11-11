<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\CustomerVersement;
use Illuminate\Http\Request;
use App\Repositories\CustomerVersement\CustomerVersementRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\PaymentMode\PaymentModeRepository;
use App\Repositories\Compte\CompteRepository;

class CustomerVersementController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(CustomerVersementRepository $customer_versement, PaymentModeRepository $payment_mode ,CompteRepository $compte,CustomerRepository $customer)
    {
        $this->customer_versement = $customer_versement;
        $this->payment_mode       = $payment_mode;
        $this->compte             = $compte;
        $this->customer           = $customer;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $customer_versements = $this->customer_versement->model->all();
      return compact('customer_versements');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $customers = $this->customer->model->all();
      $payment_modes = $this->payment_mode->model->all();
      $compte = $this->compte->model->all();

      return compact('customers','payment_modes','compte');
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
      $customer_versement= $this->customer_versement->create($input);
      $success ='success';
      return compact('customer_versement','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerVersements  $customerVersements
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $customer_versement = $this->customer_versement->model->findOrFail($id);
      
      return compact('customer_versement');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerVersements  $customerVersements
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $customer_versement = $this->customer_versement->model->findOrFail($id);
      $customers = $this->customer->model->all();
      $payment_modes = $this->payment_mode->model->all();
      $compte = $this->compte->model->all();

      return compact('customers','payment_modes','compte','customer_versement');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerVersements  $customerVersements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       $input = $request->all();
       $customer_versement = $this->customer_versement->model->findOrFail($id);
       $customer_versement= $this->customer_versement->update($customer_versement, $input);
       $success='success';
       return  compact('customer_versement','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerVersements  $customerVersements
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $success = $this->customer_versement->model->destroy($id);
        return compact('success');
    }
}
