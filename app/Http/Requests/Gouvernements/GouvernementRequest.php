<?php

namespace App\Http\Requests\Gouvernements;

use Illuminate\Foundation\Http\FormRequest;

class GouvernementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // test 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return  [
            'name' => 'unique:gouvernements,name|required|max:60',
        ];
    }
    public function messages()
    {
        return  [
            'name.required' => 'لا يمكن ترك اسم المحافظة فارغا',
            'name.unique' => 'اسم هذه المحافظة يوجد سابقا',
            'name.max'      => 'عدد الأحرف يتجاوز الحد المطلوب',

        ];
    }
}
