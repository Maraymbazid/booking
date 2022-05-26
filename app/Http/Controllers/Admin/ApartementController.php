<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Apartement;
use App\Models\Admin\ServiceApartement;
use App\Http\traits\media;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Apartement\StoreApartementRequest;
use App\Http\Requests\Apartement\UpdateApartement;
use App\Models\Admin\Gouvernement;


class ApartementController extends Controller
{
    use media;
    public function create()
    {
        
        $allgouvernements=Gouvernement::select('id','name')->get();
        $allservices=ServiceApartement::select('id','name')->get();
        return view('admin.Apartments.create',compact('allgouvernements','allservices'));
    }

    public function store(StoreApartementRequest $data)
    {
        $imageName = $this->uploadMedia($data->image, 'apartements');
        $request = $data->except('_token', 'image','services','page');
        $request['image'] = $imageName;
        $stored = DB::table('apartments')->insertGetId($request);
       //$stored=Apartement::create($request);
        if ($stored) {
            $apartement = Apartement::find($stored);
            $apartement->services()->attach($data->services);
            $status = 200;
            $msg  = 'تم حفظ الداتا بنجاح ';
            $status = 200;
            $msg  = 'تم حفظ الداتا بنجاح ';
        } else {
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
       
        $allapartements=Apartement::select('id','name_ar')->get();
        return view('admin.Apartments.index',compact('allapartements'));
    }
    public function delete(Request $request)
    {
        $apartement=Apartement::find($request->id);
        if($apartement)
        {
            $apartement->services()->detach();
            $apartement->delete();
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
            $apartement = Apartement::find($id);  // search in given table id only
        if (!$apartement)
            {                
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('home');
            }
            $apartement = Apartement::select()->find($id);
            $allservices=ServiceApartement::select('id','name')->get();
            $ownservices=$apartement->services;
            $allgouvernements=Gouvernement::select('id','name')->get();
           return view('admin.Apartments.edit', compact('apartement','allgouvernements','allservices','ownservices'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('home');
        }

    }
    public function update(UpdateApartement $data)
    {
        $apartement=Apartement::find($data->id);
        if ($apartement)
         {
            $id=$data->id;
            $result = $data->except('page', 'image', '_token', '_method','id','services');
            if ($data->has('image')) {
                $oldImage = DB::table('apartments')->select('image')->where('id', $id)->first()->image;
                $this->deleteMedia($oldImage, 'apartements');
                $imageName = $this->uploadMedia($data->image, 'apartements');
                $result['image'] = $imageName;
            }
            $update = $apartement->update($result);
            $apartement->services()->sync($data->services);
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
