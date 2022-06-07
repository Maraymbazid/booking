<?php

namespace App\Http\Requests\DiscountVilla;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountVilla extends FormRequest
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
        return  [
            'number_days'=>'required|integer|min:1',
            'rate' => 'required|regex:/^\d+(\.\d{1,3})?$/|min:1|numeric',
            'gouvernement_id' => 'required|integer',
            'villa_id' => 'required|integer',
        ];
    }
}