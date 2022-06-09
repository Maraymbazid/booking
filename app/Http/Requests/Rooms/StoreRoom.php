<?php

namespace App\Http\Requests\Rooms;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoom extends FormRequest
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

    /**  $this->validate($request, [

     * Get the validation rules that apply to the request.
     *
     * @return array
     */
        public function rules()
    {
        return  [
            'name_ar' => 'required|max:100',
            //'name_en' => 'required|max:100',
            'children'=> 'required|integer|between:0,10',
           // 'description_en'=> 'required|max:100',
            'adults'=> 'required|integer|between:0,10',
            'images' => 'required',
            'images.*' => 'required|mimes:jpeg,jpg,png',
            'internet' => 'required|integer|between:0,1',
            'price' => 'required|regex:/^\d+(\.\d{1,5})?$/|min:1|numeric',
            'area' => 'required|regex:/^\d+(\.\d{1,5})?$/|min:1|numeric',
            // 'image' => 'required|mimes:jpeg,jpg,png',
            'hotel_id'=>'required',
            // we must need verify the id given by admin shoud equal to id stored in db
        ];

    }

}
