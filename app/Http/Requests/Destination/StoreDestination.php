<?php

namespace App\Http\Requests\Destination;

use Illuminate\Foundation\Http\FormRequest;

class StoreDestination extends FormRequest
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
            'price' => 'required|regex:/^\d+(\.\d{1,5})?$/|min:1|numeric',
            'gouvernement_id'=>'required|integer',
            // we must need verify the id given by admin shoud equal to id stored in db
        ];
        
    }
    public function messages()
    {
        return  [
            'name.required' => 'لا يمكن ترك اسم الواجهة فارغا',
            'price.required' => 'لا يمكن ترك حقل الثمن فارغا',
            'gouvernement_id.required'=> 'من فضلك حدد المحافظة الموجودة بيها هذه الواجهة',
            'numeric' => 'من فضلك أدخل صيغة صحيحة',
            'min' => 'من فضلك ادخل رقم صحيح',
            'max' => 'عدد الأحرف يتجاوز الحد المطلوب'
        ];
    }
}
