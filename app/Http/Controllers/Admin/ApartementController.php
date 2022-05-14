<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Apartement;
use App\Http\traits\media;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Apartement\StoreApartementRequest;
use App\Models\Admin\Gouvernement;


class ApartementController extends Controller
{
    use media;
    public function create()
    {
        
        $allgouvernements=Gouvernement::select('id','name')->get();
        return view('admin.Apartments.create',compact('allgouvernements'));
    }

    public function store(StoreApartementRequest $data)
    {
        $imageName = $this->uploadMedia($data->image, 'apartements');
        $request = $data->except('_token', 'image');
        $request['image'] = $imageName;
        $stored = DB::table('apartments')->insert($request);
        if ($stored) {
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
       
       return  $results = DB::table('apartments')->get();
       // return  view('payslips')->with('data',$results);
       //return  $allapartements=Apartement::select('name_en','name_ar','description_ar','description_en','gouvernement','status')->get();
        //return view('admin.Apartments.index',compact('allapartements'));
    }

}
