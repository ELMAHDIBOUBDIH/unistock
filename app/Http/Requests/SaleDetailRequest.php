<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleDetailRequest extends FormRequest
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

                    'unit_price'             =>    'required|numeric', 
                    'quantity'               =>    'required|numeric', 
                    'tva_rate'               =>    'required|numeric', 
                    'montant_ttc'            =>    'required|numeric', 
                    'sale_id'                =>    'required|numeric', 
                    'product_id'             =>    'required|numeric', 
                      
                ];

            // Handle updates
            case 'put':
            case 'PUT':
                return [
                  
                    'unit_price'             =>    'required|numeric', 
                    'quantity'               =>    'required|numeric', 
                    'tva_rate'               =>    'required|numeric', 
                    'montant_ttc'            =>    'required|numeric', 
                    'sale_id'                =>    'required|numeric', 
                    'product_id'             =>    'required|numeric', 
                         
                ];

           
           
          }
    }
}
