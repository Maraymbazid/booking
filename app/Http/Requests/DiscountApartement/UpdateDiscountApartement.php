<?php

namespace App\Http\Requests\DiscountApartement;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountApartement extends FormRequest
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
            // 'hotel_id' => 'required|integer',
            // 'room_id' => 'required|integer',
        ];
    }
}
