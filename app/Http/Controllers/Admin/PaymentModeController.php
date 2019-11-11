<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Repositories\PaymentMode\PaymentModeRepository;
use Illuminate\Http\Request;

class PaymentModeController extends Controller
{
    /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(PaymentModeRepository $payment_mode)
    {
      $this->payment_mode = $payment_mode;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_modes = $this->payment_mode->model->all();

        return compact('payment_modes');
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
        $payment_mode = $this->payment_mode->create($input);
        $success = 'success';
        return compact('success', 'payment_mode');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\modes  $modes
     * @return \Illuminate\Http\Response
     */
    public function show(modes $modes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modes  $modes
     * @return \Illuminate\Http\Response
     */
    public function edit(modes $modes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modes  $modes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $payment_mode = $this->payment_mode->model->findOrFail($id);
        $payment_mode= $this->payment_mode->update($payment_mode, $input);
        $success = 'success';
        return  compact('success','payment_mode');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modes  $modes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = $this->payment_mode->model->destroy($id);
        
        return compact('success');
    }
}
