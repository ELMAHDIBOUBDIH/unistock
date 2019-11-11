<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Customer;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\CustomerGroup\CustomerGroupRepository;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{

  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct( CustomerRepository $customer ,CustomerGroupRepository $CustomerGroup)
    {
      $this->customer = $customer;
      $this->CustomerGroup = $CustomerGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $input = $request->all(); 
        $customers = $this->customer->search_filter($input);
        $CustomerGroups = $this->CustomerGroup->model->all();

        foreach ($customers as $customer) {
        $customer['group']  = $customer->CustomerGroup->name;
        }

        return compact('customers', 'CustomerGroups');

    }
    public function search()
    {
        $resluts = $this->customer->model->take(25)->get();
        return compact('resluts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     $CustomerGroups = $this->CustomerGroup->model->all();
        return compact('CustomerGroups');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
         $input = $request->all();
         $customer = $this->customer->create($input);
         $success ='success';

         return compact('success','customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {

         return compact('customer');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {

        $CustomerGroups = $this->CustomerGroup->model->all();

        return compact('customer','CustomerGroups');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {

        $input = $request->all();
        $customer =$this->customer->model->findOrFail($id);
        $result = $this->customer->update($customer, $input);
        $success='success';
        // session()->flash('message',$result['message']);
        return compact('customer','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = $this->customer->model->destroy($id);
        return compact('success');
    }
}
