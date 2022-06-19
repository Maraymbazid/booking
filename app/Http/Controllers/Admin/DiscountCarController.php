<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DiscountCar\StoreDiscountCar;
use App\Http\Requests\DiscountCar\UpdateDiscountCar;
use App\Models\Company;
use App\Models\Car;
use App\Models\Admin\DiscountCar;
use Illuminate\Support\Facades\DB;
use Exception;
class DiscountCarController extends Controller
{
    public function index()
    {
        $allDiscounts=DiscountCar::paginate(8); 
        return view('admin.DiscountCar.index',compact('allDiscounts'));
    }
    public function create()
    {
        $allcars=Car::get();
        return view('admin.DiscountCar.create',compact('allcars'));
    }
    public function store(StoreDiscountCar $request)
    {
        $request = $request->except('_token','page');
        $stored = DB::table('discountcar')->insert($request);
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
    public function delete(Request $request)
    {
        $discountcar=DiscountCar::find($request->id);
        if($discountcar)
        {
            $discountcar->delete();
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
            $discountcar = DiscountCar::find($id);  // search in given table id only
        if (!$discountcar)
            {                
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('adminHome');
            }
            $discountcar = DiscountCar::select()->find($id);
            return view('admin.DiscountCar.edit', compact('discountcar'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('adminHome');
        }

    }
    public function update(UpdateDiscountCar $data)
    {
        $discount=DiscountCar::find($data->id);
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
