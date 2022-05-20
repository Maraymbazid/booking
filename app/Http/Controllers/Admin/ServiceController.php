<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Services\StoreRequest;
use App\Models\Admin\Service;
class ServiceController extends Controller
{
    public function index()
    {
        try
        {
            $allservices=Service::select('id','name')->get();
            return view('admin.services.index',compact('allservices'));
        }
        catch(Exception $ex)
        {
                alert()->error('Oops....','Something went wrong .. try again');
                return redirect() -> route('home');
        }
    }
    public function create()
    {
        return view('admin.services.create1');
    }
    public function store(StoreRequest $request)
    {
        $service=Service::create([
            'name'=>$request->name,
        ]);
        if($service)
           {
            $status = 200;
            $msg  = 'تم حفظ الداتا بنجاح ';
            }
        else 
          {
            $status = 500;
            $msg  = ' تعذر الحفظ هناك خطأ ما       ';
          }
        return response()->json([
            'status' => $status,
            'msg' => $msg
        ]);
    }
    public function delete(Request $request)
    {
            $service = Service::find($request->id);
            if($service)
            {
                $service->delete();
                return response()->json
                ([
                    //'status' => true,
                    'msg'  => 'تم حفظ الداتا بنجاح ',
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
            $service = Service::find($id);  // search in given table id only
        if (!$service)
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('home');
            }
            $service = Service::select('id', 'name')->find($id);
           return view('admin.services.edit', compact('service'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('home');
        }

    }
    public function update(StoreRequest $request)
    {
        try
        {
            $service = Service::find($request->id);  // search in given table id only
            if (!$service)
                {
                    alert()->error('Oops....','this element does not exist .. try again');
                    return redirect() -> route('allservices');
                }
            $service->update([
                'name' => $request->name,
            ]);
            alert()->success('Updated....', '  تم تعديل بينانات بنجاح');
            return redirect()->route('allservices');
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('allservices');
        }

    }
    // public function test()
    // {
    //     $service = Service::find(6);
    //     return $service->hotels;

    // }
}