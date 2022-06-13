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
            'gouvernement_id'=>'required',
            // we must need verify the id given by admin shoud equal to id stored in db
        ];
        
    }
}
