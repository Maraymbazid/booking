<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCar extends FormRequest
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
            'name' => 'required|max:100',
            'model'  => 'required|max:100',
            'image' => 'mimes:jpeg,jpg,png',
            'images.*'=>'mimes:jpeg,jpg,png',
            'price' => 'required|regex:/^\d+(\.\d{1,5})?$/|min:1|numeric',
            //'company_id'=>'exists:App\Models\Company,id',
        ];
    }
    public function messages()
    {
        return  [
            'name.required' => 'لا يمكن ترك   حقل الاسم فارغا',
            'price.required' => 'لا يمكن ترك حقل الثمن فارغا',
            'model.required' => 'لا يمكن ترك حقل موديل فارغا',
            'numeric' => 'من فضلك أدخل صيغة صحيحة',
            'mimes' => 'من فضلك أدخل صيغة صحيحة',
            'min' => 'من فضلك ادخل رقم صحيح',
            'max' => 'عدد الأحرف يتجاوز الحد المطلوب',
            'exists' => 'من فضلك اختار عناصر موجودة',
        ];
    }
}
