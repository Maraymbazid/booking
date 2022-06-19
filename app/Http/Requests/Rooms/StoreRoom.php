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
            'children'=> 'required|integer|between:0,20',
            'beds' => 'required|integer|between:0,20',
            'adults'=> 'required|integer|between:0,20',
            'images.*' => 'required|mimes:jpeg,jpg,png',
            'internet' => 'required|integer|between:0,1',
            'price' => 'required|regex:/^\d+(\.\d{1,5})?$/|min:1|numeric',
            'area' => 'required|regex:/^\d+(\.\d{1,5})?$/|min:1|numeric',
            'hotel_id'=>'required|exists:App\Models\Hotel,id',
            'services.*'=>'exists:App\Models\Admin\ServiceRoom,id'
            // we must need verify the id given by admin shoud equal to id stored in db
        ];

    }
    public function messages()
    {
        return  [
            'name_ar.required' => 'لا يمكن ترك اسم الغرفة فارغا',
            'beds.required' => 'لا يمكن ترك حقل السرائر فارغا',
            'children.required' => 'لا يمكن ترك حقل الاطفال فارغا',
            'adults.required' => 'لا يمكن ترك  حقل البالغين فارغا',
            'images.required' => 'لا يمكن ترك حقل الصور فارغا',
            'internet.required' =>'  من فضلك حدد اذا الانترنيت متوفر في الغرفة او لا ',
            'price.required' => 'لا يمكن ترك حقل الثمن فارغا',
            'area.required' => 'لا يمكن ترك حقل الحجم فارغا',
            'hotel_id.required'=> 'من فضلك حدد الفندق الموجودة داخله هذه الغرفة',
            'numeric' => 'من فضلك أدخل صيغة صحيحة',
            'integer'  => 'من فضلك أدخل صيغة صحيحة',
            'mimes' => 'من فضلك أدخل صيغة صحيحة',
            'min' => 'من فضلك ادخل رقم صحيح',
            'between' => 'من فضلك ادخل رقم صحيح',
            'exists' => 'من فضلك اختار عناصر موجودة'
        ];
    }

}
