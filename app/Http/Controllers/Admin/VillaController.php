<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\traits\media;
use App\Models\Admin\Gouvernement;
use App\Models\Admin\ServiceApartement;
use App\Http\Requests\Villa\StoreVilla;
use App\Models\Admin\Villa;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Villa\UpdateVilla;
class VillaController extends Controller
{
    use media;
    public function create()
    {

        $allgouvernements=Gouvernement::select('id','name')->get();
        $allservices=ServiceApartement::select('id','name')->get();
        return view('admin.villas.create',compact('allgouvernements','allservices'));
    }
    public function  store(StoreVilla $data)
    {
        $imageName = $this->uploadMedia($data->image, 'villas');
        $request = $data->except('_token', 'image','services','page');
        $request['image'] = $imageName;
        $stored = DB::table('villas')->insertGetId($request);
        if ($stored)
        {
            $villa = Villa::find($stored);
            $villa->services()->attach($data->services);
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

        $allvillas=Villa::select()->get();
        return view('admin.villas.index',compact('allvillas'));
    }
    public function delete(Request $request)
    {
        $villa=Villa::find($request->id);
        if($villa)
        {
            $villa->services()->detach();
            $villa->delete();
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
            $villa = Villa::find($id);  // search in given table id only
            if (!$villa) {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('home');
            }
            $villa = villa::select()->find($id);
            $allservices=ServiceApartement::select()->get();
            $ownservices=$villa->services;
            $allgouvernements=Gouvernement::select('id','name')->get();
           return view('admin.villas.edit', compact('villa','allgouvernements','allservices','ownservices'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('home');
        }

    }
    public function update(UpdateVilla $data)
    {
        $villa=Villa::find($data->id);
        if ($villa)
         {
            $id=$data->id;
            $result = $data->except('page', 'image', '_token', '_method','id','services');
            if ($data->has('image')) {
                $oldImage = DB::table('villas')->select('image')->where('id', $id)->first()->image;
                $this->deleteMedia($oldImage, 'villas');
                $imageName = $this->uploadMedia($data->image, 'villas');
                $result['image'] = $imageName;
            }
            $update = $villa->update($result);
            $villa->services()->sync($data->services);
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

    public function userIndex()
    {
        $villas = Villa::select()->get();
        foreach ($villas as $t) {
            $t->image = url('/') . '/assets/admin/img/villas/' . $t->image;
        }
        return view('villas.villa', compact('villas'));
    }
}
