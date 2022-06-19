<?php

namespace App\Http\Requests\Compnay;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompany extends FormRequest
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
            'name' => 'unique:companies,name|required|max:60',
        ];
    }
    public function messages()
    {
        return  [
            'name.required' => 'لا يمكن ترك اسم  الشركة فارغا',
            'name.unique' => 'اسم  هذه الشركة يوجد سابقا',
            'name.max'      => 'عدد الأحرف يتجاوز الحد المطلوب',

        ];
    }
}
