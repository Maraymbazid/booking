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
       //$stored=Apartement::create($request);
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
       
        $allapartements=Apartement::select('id','name_ar','description_ar','address_ar','gouvernement','status')->get();
        return view('admin.Apartments.index',compact('allapartements'));
    }
    public function delete(Request $request)
    {
        try
        {
            $apartement = Apartement::find($request->id);
            if (!$apartement)
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('home');
            }
            $apartement->delete();
                return response()->json([
                    'status' => true,
                    'msg' => 'تم الحذف بنجاح',
                    'id' => $request->id
                ]);

        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('home');
        }
    }
    public function edit($id)
    {
        try
        {
            $apartement = Apartement::find($id);  // search in given table id only
            $allgouvernements=Gouvernement::select('id','name')->get();
        if (!$apartement)
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('home');
            }
            $apartement = Apartement::select('id', 'name_ar','description_ar','address_ar','status','gouvernement','image')->find($id);
           return view('admin.Apartments.edit', compact('apartement','allgouvernements'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('home');
        }

    }
    public function update(Request $data)
    {
        $id=$data->id;
        $result = $data->except('page', 'image', '_token', '_method');
        if ($data->has('image')) {
            $oldImage = DB::table('apartments')->select('image')->where('id', $id)->first()->image;
            $this->deleteMedia($oldImage, 'apartements');
            $imageName = $this->uploadMedia($data->image, 'apartements');
            $result['image'] = $imageName;
        }
        //return $result['image'];
        $update = DB::table('apartments')->where('id', $id)->update($result);
        if ($update) {
            return response()->json([
                'status' => true,
                'msg' => 'تم تعديل بنجاح',
            ]);
        } else {
            return response()->json([
                'status' => true,
                'msg'  => 'تعذر الحفظ هناك خطأ ما',
            ]);
        }
    }

}
