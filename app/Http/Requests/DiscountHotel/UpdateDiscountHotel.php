<?php

namespace App\Http\Requests\DiscountHotel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountHotel extends FormRequest
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
            'discount' => 'required|regex:/^\d+(\.\d{1,3})?$/|min:1|numeric',
        ];
    }
    public function messages()
    {
        return  [
            'day_count.required' => 'لا يمكن ترك حقل الايام فارغا',
            'discount.required' => 'لا يمكن ترك حقل نسبة الخصم فارغا',
            'numeric' => 'من فضلك أدخل صيغة صحيحة',
            'integer'  => 'من فضلك أدخل صيغة صحيحة',
            'min' => 'من فضلك ادخل رقم صحيح',
        ];
    }
}
