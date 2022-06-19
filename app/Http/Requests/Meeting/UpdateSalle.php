<?php

namespace App\Http\Requests\Meeting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalle extends FormRequest
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
            'image' => 'mimes:jpeg,jpg,png',
            'images.*' => 'mimes:jpeg,jpg,png',
            'status' => 'required|integer|between:0,1',
            'price' => 'required|regex:/^\d+(\.\d{1,5})?$/|min:1|numeric',
            'area' => 'required|regex:/^\d+(\.\d{1,5})?$/|min:1|numeric',
            'guest'=>'required|integer|min:1|max:20',
            'type'=>'required|max:100',
            'gouvernement'=>'required|integer|exists:App\Models\Admin\Gouvernement,id',
            'services.*'=>'exists:App\Models\Admin\MeetingServices,id'
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
            'gouvernement.required'=> 'من فضلك حدد المحافظة الموجودة بيها هذه القاعة',
            'numeric' => 'من فضلك أدخل صيغة صحيحة',
            'integer'  => 'من فضلك أدخل صيغة صحيحة',
            'mimes' => 'من فضلك أدخل صيغة صحيحة',
            'min' => 'من فضلك ادخل رقم صحيح',
            'between' => 'من فضلك ادخل رقم صحيح',
            'max' => 'عدد الأحرف يتجاوز الحد المطلوب',
            'exists' => 'من فضلك اختار عناصر موجودة'
        ];
    }
}
