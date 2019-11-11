<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\CustomerGroup;
use App\Repositories\CustomerGroup\CustomerGroupRepository;
use Illuminate\Http\Request;

class CustomerGroupController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct(CustomerGroupRepository $customergroup)
    {
      $this->customergroup = $customergroup;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $customergroups = $this->customergroup->model->all();
       return compact('customergroups');
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
    public function store(Request $request)
    {
         $input = $request->all();
         $customergroup= $this->customergroup->create($input);
         $success ='success';
         return compact('customergroup','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $customergroup = $this->customergroup->model->findOrFail($id);
        $customergroup= $this->customergroup->update($customergroup, $input);
         $success='success';
        return  compact('customergroup','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $success = $this->customergroup->model->destroy($id);
        return compact('success');
    }
}
