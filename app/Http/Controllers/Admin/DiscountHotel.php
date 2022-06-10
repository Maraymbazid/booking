<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hotel;
use App\Models\Admin\Room;
use App\Models\RoomDiscount;
use Illuminate\Http\Request;
use App\Models\Admin\Gouvernement;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\HotelDiscount;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountHotel\StoreDiscountHotel;
use App\Http\Requests\DiscountHotel\UpdateDiscountHotel;

class DiscountHotel extends Controller
{
    public function index()
    {
        $allDiscounts = RoomDiscount::get();
        return view('admin.DiscountHotels.index', compact('allDiscounts'));
    }
    public function create()
    {
        $allgouvernements=Gouvernement::get();
        return view('admin.DiscountHotels.create',compact('allgouvernements'));
    }
    public function store(StoreDiscountHotel $request)
    {
        $request = $request->except('_token', 'page', 'gouvernement_id');
        $stored = DB::table('rooms_discount')->insert($request);
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
    public function getSubRooms(Request $request)
    {
        $value = $request->get('id');
        $dependent = $request->get('dependent');
        $rooms = DB::table('rooms')->where('hotel_id', $value)->get();
        $output = '<option data-kt-flag="flags/united-states.svg" value="">' . 'اختر غرفة' . ' </option>';
        foreach ($rooms as $room) {
            $output .= '<option data-kt-flag="flags/united-states.svg" value="' . $room->id . '">' . $room->name_ar . ' </option>';
        }
        echo $output;
    }
    public function getSubHotels(Request $request)
    {
        $value = $request->get('id');
        $dependent = $request->get('dependent');
        $hotels = DB::table('hotels')->where('gouvernement', $value)->get();
        $output = '<option data-kt-flag="flags/united-states.svg" value="">' . 'اختر الفندق' . ' </option>';
        foreach ($hotels as $hotel) {
            $output .= '<option data-kt-flag="flags/united-states.svg" value="' . $hotel->id . '">' . $hotel->name_ar . ' </option>';
        }
        echo $output;
    }
    public function delete(Request $request)
    {
        $discounthotel = RoomDiscount::find($request->id);
        if($discounthotel)
        {
            $discounthotel->delete();
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
            $discounthotel = HotelDiscount::find($id);  // search in given table id only
            if (!$discounthotel) {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('home');
            }
            $discounthotel = HotelDiscount::select()->find($id);
            return view('admin.DiscountHotels.edit', compact('discounthotel'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('home');
        }

    }
    public function update(UpdateDiscountHotel $data)
    {
        $discount=HotelDiscount::find($data->id);
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
