<?php

namespace App\Http\Requests\Apartement;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartementRequest extends FormRequest
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
            'status' => 'required|integer|between:0,1'
            // we must need verify the id given by admin shoud equal to id stored in db
        ];
        
    }
}
