<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Compte;
use App\Repositories\Compte\CompteRepository;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(CompteRepository $compte)
    {
      $this->compte = $compte;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comptes = $this->compte->model->all();

        return compact('comptes');
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
        $compte = $this->compte->create($input);
        $success = 'success';
        return compact('success', 'compte');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comptes  $Comptes
     * @return \Illuminate\Http\Response
     */
    public function show(Comptes $Comptes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comptes  $Comptes
     * @return \Illuminate\Http\Response
     */
    public function edit(Comptes $Comptes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comptes  $Comptes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $compte = $this->compte->model->findOrFail($id);
        $compte= $this->compte->update($compte, $input);
        $success = 'success';
        return  compact('success','compte');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comptes  $Comptes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = $this->compte->model->destroy($id);
        
        return compact('success');
    }
}
