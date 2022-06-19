<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Villa;
use App\Models\Admin\Gouvernement;
use App\Models\Admin\DiscountVilla;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DiscountVilla\StoreDiscountVilla;
use App\Http\Requests\DiscountVilla\UpdateDiscountVilaa;
use Exception;
class DiscountVillaController extends Controller
{
    public function create()
    {
        $allgouvernements=Gouvernement::get();
        return view('admin.DiscountVillas.create',compact('allgouvernements'));
    }
    public function getSubvillas(Request $request)
    {
        $value = $request->get('id');
        $dependent = $request->get('dependent');
        $villas = DB::table('villas')->where('gouvernement', $value)->get();
        $output = '<option data-kt-flag="flags/united-states.svg" value="">' . ' اختر فلة' . ' </option>';
        foreach (  $villas as $villa) {
            $output .= '<option data-kt-flag="flags/united-states.svg" value="' . $villa->id . '">' . $villa->name_ar . ' </option>';
        }
        echo $output;
    }
    public function store(StoreDiscountVilla $request)
    {

        $request = $request->except('_token','page');
        $stored = DB::table('discountvillas')->insert($request);
        if ($stored)
        {
            $status = 200;
            $msg  = 'تم حفظ الداتا بنجاح ';
        } else
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
        $allDiscounts=DiscountVilla::paginate(8);
        return view('admin.DiscountVillas.index',compact('allDiscounts'));
    }
    public function delete(Request $request)
    {
        $discountvilla=DiscountVilla::find($request->id);
        if($discountvilla)
        {
            $discountvilla->delete();
            return response()->json
            ([
                'msg'  => 'تم حذف الداتا بنجاح ',
                'id'=>$request->id,
            ],200);
        } else
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
            $discountvilla = DiscountVilla::find($id);  // search in given table id only
        if (!$discountvilla) {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('adminHome');
            }
            $discountvilla = DiscountVilla::select()->find($id);
            return view('admin.DiscountVillas.edit', compact('discountvilla'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('adminHome');
        }

    }
    public function update(UpdateDiscountVilaa $data)
    {
        $discount=DiscountVilla::find($data->id);
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

            } else
            {
                $status = 500;
                $msg  = ' تعذر التعديل هناك خطأ ما';
            }
        } else
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
