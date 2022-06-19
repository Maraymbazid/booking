<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\MeetingSalles;
use App\Models\MeetingDiscount;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DiscountMeeting\StoreDiscountMeeting;
use App\Http\Requests\DiscountMeeting\UpdateDiscountMeeting;
use Exception;
class DiscountSalleController extends Controller
{
    public function create()
    {
        $allsalles=MeetingSalles::get();
        return view('admin.discountsalles.create',compact('allsalles'));
    }
    public function index()
    {
        $allDiscounts =MeetingDiscount::paginate(8);
        return view('admin.discountsalles.index',compact('allDiscounts'));
    }
    public function store(StoreDiscountMeeting $request)
    {

        $request = $request->except('_token','page');
        $stored = DB::table('meetings_discount')->insert($request);
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
    public function delete(Request $request)
    {
        $discountsalle=MeetingDiscount::find($request->id);
        if($discountsalle)
        {
            $discountsalle->delete();
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
            $discountsalle = MeetingDiscount::find($id);  // search in given table id only
        if (!$discountsalle)
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('adminHome');
            }
            $discountsalle =MeetingDiscount::select()->find($id);
            return view('admin.discountsalles.edit', compact('discountsalle'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('adminHome');
        }

    }
    public function update(UpdateDiscountMeeting $data)
    {
        $discount=MeetingDiscount::find($data->id);
        if ($discount)
         {
            $result = $data->except('page','_token','id');
            $update = $discount->update(
                [
                    'hour_count' => $result['hour_count'],
                    'discount'     => $result['discount'],
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
