<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Employee;
use App\Repositories\Employee\EmployeeRepository;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct( EmployeeRepository $employee)
    {
      $this->employee = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employee->model->paginate(25);
        return compact('employees');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $resluts = $this->employee->model->take(25)->get();
        return compact('resluts');
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
    public function store(EmployeeRequest $request)
    {
        $input = $request->all();
        $employee = $this->employee->create($input);

         $success ='success';
        return compact('success','employee');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return compact('employee');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
      return compact('employee');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $input = $request->all();
        $employee =$this->employee->model->findOrFail($id);

        $result = $this->employee->update($employee, $input);
        $success='success';
        return compact('employee','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = $this->employee->model->destroy($id);
        return compact('success');
    }
}
