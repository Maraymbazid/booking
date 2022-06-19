<?php

namespace App\Http\Requests\DiscountMeeting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountMeeting extends FormRequest
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
            'hour_count'=>'required|integer|min:1',
            'discount' => 'required|regex:/^\d+(\.\d{1,3})?$/|min:1|numeric',
        ];
    }
    public function messages()
    {
        return  [
            'hour_count.required' => 'اختيار عدد الساعات ضروري',
            'discount.required' => 'لا يمكن ترك حقل نسبة الخصم فارغا',
            'numeric' => 'من فضلك أدخل صيغة صحيحة',
            'min' => 'من فضلك ادخل رقم صحيح',
        ];
    }
}
