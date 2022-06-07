<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Gouvernement;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Apartement;
use App\Models\Admin\DiscountApartement;
use App\Http\Requests\DiscountApartement\StoreDiscountApartement; 
use App\Http\Requests\DiscountApartement\UpdateDiscountApartement;
class DiscountApartementController extends Controller
{
    public function create()
    {
        $allgouvernements=Gouvernement::get();
        return view('admin.DiscountApartements.create',compact('allgouvernements'));
    }
    public function getSubApartements(Request $request)
    {
        $value = $request->get('id');
        $dependent = $request->get('dependent');
        $apartements = DB::table('apartments')->where('gouvernement', $value)->get();
        $output = '<option data-kt-flag="flags/united-states.svg" value="">' . ' اختر شقة' . ' </option>';
        foreach ( $apartements as $apartement) {
            $output .= '<option data-kt-flag="flags/united-states.svg" value="' . $apartement->id . '">' . $apartement->name_ar . ' </option>';
        }
        echo $output;
    }
    public function store(StoreDiscountApartement $request)
    {
       $request = $request->except('_token','page');
        $stored = DB::table('discountapartement')->insert($request);
        if ($stored) 
        {
            $status = 200;
            $msg  = 'تم حفظ الداتا بنجاح ';
        } 
        else 
        {
            $status = 500;
            $msg  = 'تعذر الحفظ هناك خطأ ما';
        }
        return response()->json([
            'status' => $status,
            'msg' => $msg
        ]);
    }
    public function index()
    {
        $allDiscounts=DiscountApartement::get();
        return view('admin.DiscountApartements.index',compact('allDiscounts'));
    }
    public function delete(Request $request)
    {
        $discountapartement=DiscountApartement::find($request->id);
        if($discountapartement)
        {
            $discountapartement->delete();
            return response()->json
            ([
                'msg'  => 'تم حذف الداتا بنجاح ',
                'id'=>$request->id,
            ],200);
        }
       else 
        {
            return response()->json
            ([
                //'status' => false,
                 'msg'  => ' تعذر الحذف هناك خطأ ما ',
            ],500);
        }
    }
    public function edit($id)
    {
        try
        {
            $discountapartement = DiscountApartement::find($id);  // search in given table id only
        if (!$discountapartement)
            {                
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('home');
            }
            $discountapartement = DiscountApartement::select()->find($id);
            return view('admin.DiscountApartements.edit', compact('discountapartement'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('home');
        }

    }
    public function update(UpdateDiscountApartement $data)
    {
        $discount=DiscountApartement::find($data->id);
        if ($discount)
         {
            $result = $data->except('page','_token','id');
            $update = $discount->update(
                [
                    'number_days' => $result['number_days'],
                    'rate'     => $result['rate'],
                ]
            );
            if ($update) 
            {
                
                $status = 200;
                $msg  = 'تم تعديل الداتا بنجاح ';
                
            }
            else 
            {
                $status = 500;
                $msg  = ' تعذر التعديل هناك خطأ ما';
            }
        }
        else 
        {
           $status = 500;
           $msg  = ' تعذر التعديل هناك خطأ ما';
        }
        return response()->json
       ([
           'status' => $status,
           'msg' => $msg,
       ]);
        
    }
}
