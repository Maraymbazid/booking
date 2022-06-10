<?php

namespace App\Http\Requests\DiscountHotel;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountHotel extends FormRequest
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
            'day_count' => 'required|integer|min:1',
            'day_count' => 'required|regex:/^\d+(\.\d{1,3})?$/|min:1|numeric',
            'hotel_id' => 'required|integer',
            'room_id' => 'required|integer',
        ];

    }
}
