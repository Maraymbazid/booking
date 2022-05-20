<?php

namespace App\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'unique:services,name|required|max:50',
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
