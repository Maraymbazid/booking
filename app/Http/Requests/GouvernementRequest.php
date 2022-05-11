<?php

namespace App\Http\Requests;

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
            'name' => 'unique:gouvernements,name|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|required|max:60',
        ];
    }
    public function messages()
    {
        return  [
            'name.required' => 'name is required',
            'name.max'      => 'do not pass 60 caracters',

        ];
    }
}
