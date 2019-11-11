<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         switch ($this->getMethod())
        {
            // handle creates
            case 'post':
            case 'POST':
           
                return [
                           'company_name'           =>    'required',
                           'first_name'             =>    'required',
                           'last_name'              =>    'required',
                           'gender'                 =>    'required',
                           'birthday'               =>    'date',
                           'tel'                    =>    'required',
                           'fax'                    =>    '',
                           'address'                =>    '',
                           'email'                  =>    'required|email|unique:employees',
                           'image'                  =>    '',
                           'qualification'          =>    '',
                           'recruitment_date'       =>    '',
                           'password'               =>    'required',
                           'note'                   =>    ''

                ];

            // Handle updates
            case 'put':
            case 'PUT':
                return [
                  
                           'company_name'           =>   'required',
                           'first_name'             =>    'required',
                           'last_name'              =>    'required',
                           'gender'                 =>    'required',
                           'birthday'               =>    'date',
                           'tel'                    =>    'required',
                           'fax'                    =>    '',
                           'address'                =>    '',
                           'email'                  =>    'required|unique:employees,email,'.$this->id,
                           'image'                  =>    '',
                           'qualification'          =>    '',
                           'recruitment_date'       =>    '',
                           'password'               =>    'required',
                           'note'                   =>    '',
                         
                ];

           
           
          }
    }
}
