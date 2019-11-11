<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
                  'brand'                  =>   '', 
                  'reference'              =>    'required', 
                  'designation'            =>    'required', 
                  'code_barre'             =>    'numeric', 
                  'unit'                   =>    '', 
                  'cond'                   =>    'numeric', 
                  'tva'                    =>    'numeric', 
                  'product_facturable'     =>    'boolean', 
                  'product_perissable'     =>    'boolean', 
                  'date_p'                 =>    'date', 
                  'alert_p'                =>    '', 
                  'etat'                   =>    'required', 
                  'image'                  =>    '', 
                  'description'            =>    'max:255', 
                  'price_ht'               =>    'required|numeric|max:price_ttc', 
                  'price_ttc'              =>    'required|numeric', 
                  'last_price'             =>    'numeric', 
                  'pmp'                    =>    'numeric', 
                  'qnt_initial'            =>    'numeric', 
                  'alert_stock'            =>    'numeric', 
                  'pack'                   =>    'required|boolean', 
                  'qnt_pack'               =>    'numeric', 
                  'price_pack'             =>    'numeric', 
                  'price_unit_pack'        =>    'numeric', 
                  'price_of_qnt'           =>    'numeric', 
                  'note'                   =>    'max:500', 
                  'category_id'            =>    'required', 
                  'supplier_id'            =>    'required'
        ];
    }
}
