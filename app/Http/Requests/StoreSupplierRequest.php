<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
        return [
                           'company_name'           =>    '',
                           'first_name'             =>    'required',
                           'last_name'              =>    'required',
                           'gender'                 =>    'required',
                           'birthday'               =>    'required',
                           'tel'                    =>    'required',
                           'fax'                    =>    '',
                           'address'                =>    '',
                           'email'                  =>    'required|email|unique:suppliers',
                           'image'                  =>    '',
                           'solde'                  =>    'numeric',
                           'solde_max'              =>    'numeric',
                           'reg_com'                =>    '',
                           'mat_fisc'               =>    '',
                           'num_art'                =>    '',
                           'bloque'                 =>    '',
                           'note'                   =>    '',
        ];
    }
}
