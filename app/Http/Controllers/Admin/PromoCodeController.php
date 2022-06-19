<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Taxi;
use App\Models\Admin\PromoCode;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Promo\StorePromo;
use Exception;
class PromoCodeController extends Controller
{
    public function create()
    {
        $alltaxis=Taxi::get();
        return view('admin.promocode.create',compact('alltaxis'));
    }
    public function store(StorePromo $request)
    {
        $request = $request->except('_token','page');
        $stored = DB::table('promocode')->insert($request);
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
        $allpromo=PromoCode::paginate(8);
        return view('admin.promocode.index',compact('allpromo'));
    }
    public function delete(Request $request)
    {
        $promo=PromoCode::find($request->id);
        if($promo)
        {
            $promo->delete();
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
            $promo = PromoCode::find($id);  // search in given table id only
        if (!$promo)
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('adminHome');
            }
            $promo = PromoCode::select()->find($id);
            $alltaxis=Taxi::get();
            return view('admin.promocode.edit', compact('promo','alltaxis'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('adminHome');
        }
    }
    public function update(StorePromo $data)
    {
        $promo=PromoCode::find($data->id);
        if ($promo)
         {
            $result = $data->except('page','_token','id');
            $update = $promo->update($result);
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
