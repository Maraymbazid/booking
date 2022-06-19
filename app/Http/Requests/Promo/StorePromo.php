<?php

namespace App\Http\Requests\Promo;

use Illuminate\Foundation\Http\FormRequest;

class StorePromo extends FormRequest
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
            'name' => 'required|max:40',
            'begindate' => 'required|date',
            'enddate' => 'required|date',
            'personnes' => 'required|integer|min:1',
            'status' => 'required|integer|between:0,1',
            'discount' => 'required|regex:/^\d+(\.\d{1,3})?$/|min:1|numeric',
            'taxi_id' => 'required|integer|exists:App\Models\Taxi,id',
        ];
    }
    public function messages()
    {
        return  [
            'name.required' => 'لا يمكن ترك حقل الاسم فارغا',
            'personnes.required' => 'لا يمكن ترك عدد الاشخاص فارغا',
            'discount.required' => 'لا يمكن ترك نسبة الخصم فارغة',
            'begindate.required' => 'لايمكن ترك تاريخ البدء فارغ',
            'enddate.required' => 'لا يمكن ترك تاريخ نهاية فارغ',
            'status.required'=> 'من فضلك اختار حالة مناسبة للبرمو',
            'taxi_id.required' => 'من فضلك اختار تاكسي',
            'numeric' => 'من فضلك أدخل صيغة صحيحة',
            'integer'  => 'من فضلك أدخل صيغة صحيحة',
            'min' => 'من فضلك ادخل رقم صحيح',
            'max' => 'عدد الاحرف يتجاوز الحد المطلوب',
            'exists' => 'من فضلك اختار عناصر موجودة'
        ];
    }
}
