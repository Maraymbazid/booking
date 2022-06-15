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
            'discount' => 'required|regex:/^\d+(\.\d{1,3})?$/|min:1|numeric',
            'hotel_id' => 'required|integer',
            'room_id' => 'required|integer',
            'gouvernement_id' => 'required|integer',
        ];
    }
    public function messages()
    {
        return  [
            'day_count.required' => 'لا يمكن ترك حقل الايام فارغا',
            'discount.required' => 'لا يمكن ترك حقل نسبة الخصم فارغا',
            'hotel_id.required' => 'اختيار الفندق ضروري',
            'room_id.required' => 'اختيار الغرفة ضروري',
            'gouvernement_id.required' => 'اختيار المحافظة ضروري',
            'numeric' => 'من فضلك أدخل صيغة صحيحة',
            'integer'  => 'من فضلك أدخل صيغة صحيحة',
            'min' => 'من فضلك ادخل رقم صحيح',
        ];
    }
}
