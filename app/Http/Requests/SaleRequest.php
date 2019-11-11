<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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

                       'sale_number'            =>   'required',
                       'date'                   =>    'required|date',
                       'type'                   =>    'required',
                       'total_tva'              =>    'numeric',
                       'total_ht'               =>    'numeric',
                       'total_ttc'              =>    'numeric',
                       'remise'                 =>    'numeric',
                       'valide'                 =>    'required',
                       'note'                   =>    '',
                       'customer_id'            =>    'required|numeric',
                       'employee_id'            =>    'required|numeric',
                ];

            // Handle updates
            case 'put':
            case 'PUT':
                return [

                       'sale_number'            =>   'required',
                       'date'                   =>    'required|date',
                       'type'                   =>    'required',
                       'total_tva'              =>    'numeric',
                       'total_ht'               =>    'numeric',
                       'total_ttc'              =>    'numeric',
                       'remise'                 =>    'numeric',
                       'valide'                 =>    'required',
                       'note'                   =>    '',
                       'customer_id'            =>    'required|numeric',
                       'employee_id'            =>    'required|numeric',

                ];



          }
    }
}
