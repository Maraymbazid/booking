<?php

namespace App\Http\Requests\DiscountApartement;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountApartement extends FormRequest
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
            'gouvernement_id' => 'required|integer|exists:App\Models\Admin\Gouvernement,id',
            'apartement_id' => 'required|integer|exists:App\Models\Admin\Apartement,id',
        ];
    }
    public function messages()
    {
        return  [
            'number_days.required' => 'لا يمكن ترك حقل الايام فارغا',
            'rate.required' => 'لا يمكن ترك حقل نسبة الخصم فارغا',
            'apartement_id.required' => 'اختيار الشقة ضروري',
            'gouvernement_id.required' => 'اختيار المحافظة ضروري',
            'numeric' => 'من فضلك أدخل صيغة صحيحة',
            'integer'  => 'من فضلك أدخل صيغة صحيحة',
            'min' => 'من فضلك ادخل رقم صحيح',
            'exists' => 'من فضلك اختار عناصر موجودة',
        ];
    }
}
