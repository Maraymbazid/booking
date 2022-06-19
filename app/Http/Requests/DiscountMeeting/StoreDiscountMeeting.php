<?php

namespace App\Http\Requests\DiscountMeeting;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountMeeting extends FormRequest
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
            'salle_id' => 'required|integer|exists:App\Models\Admin\MeetingSalles,id',
        ];
    }
    public function messages()
    {
        return  [
            'hour_count.required' => 'اختيار عدد الساعات ضروري',
            'discount.required' => 'لا يمكن ترك حقل نسبة الخصم فارغا',
            'salle_id.required' => 'اختيار القاعة ضروري',
            'numeric' => 'من فضلك أدخل صيغة صحيحة',
            'integer'  => 'من فضلك أدخل صيغة صحيحة',
            'min' => 'من فضلك ادخل رقم صحيح',
            'exists' => 'من فضلك اختار عناصر موجودة',
        ];
    }
}
