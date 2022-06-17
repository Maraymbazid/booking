<?php

namespace App\Http\Requests\Villa;

use Illuminate\Foundation\Http\FormRequest;

class StoreVilla extends FormRequest
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
            'name_ar' => 'required|max:100',
            //'name_en' => 'required|max:100',
            'description_ar'=> 'required|max:100',
           // 'description_en'=> 'required|max:100',
            'address_ar'=>'required|max:100',
            'image' => 'required|mimes:jpeg,jpg,png',
            'status' => 'required|integer|between:0,1',
            'price' => 'required|regex:/^\d+(\.\d{1,5})?$/|min:1|numeric',
            'area' => 'required|regex:/^\d+(\.\d{1,5})?$/|min:1|numeric',
            'gouvernement'=>'required',
            // we must need verify the id given by admin shoud equal to id stored in db
        ];
    }
    public function messages()
    {
        return  [
            'name_ar.required' => 'لا يمكن ترك اسم الفلة فارغا',
            'description_ar.required' => 'لا يمكن ترك حقل التوصيف فارغا',
            'address_ar.required' => 'لا يمكن ترك حقل العنوان فارغا',
            'image.required' => 'لا يمكن ترك حقل الصور فارغا',
            'status.required' =>'من فضلك اختار حالة مناسبة',
            'price.required' => 'لا يمكن ترك حقل الثمن فارغا',
            'area.required' => 'لا يمكن ترك حقل الحجم فارغا',
            'gouvernement.required'=> 'من فضلك حدد المحافظة الموجودة بيها هذه الفلة',
            'numeric' => 'من فضلك أدخل صيغة صحيحة',
            'integer'  => 'من فضلك أدخل صيغة صحيحة',
            'mimes' => 'من فضلك أدخل صيغة صحيحة',
            'min' => 'من فضلك ادخل رقم صحيح',
            'between' => 'من فضلك ادخل رقم صحيح',
            'max' => 'عدد الأحرف يتجاوز الحد المطلوب'
        ];
    }
}
