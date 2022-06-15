<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\media;

use App\Models\Admin\Gouvernement;
use App\Models\Admin\ServiceApartement;
use App\Http\Requests\Villa\StoreVilla;
use App\Models\Admin\Villa;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Villa\UpdateVilla;
use App\Models\Admin\DiscountVilla;
use App\Models\ReservationVilla;
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
    public function oneVilla($id)
    {
        $id=(int)$id;
        if(is_integer($id))
        {
            $villa=Villa::find($id);
            if($villa)
            {
                        $villa->image = url('/') . '/assets/admin/img/villas/' . $villa->image;
                        return view('villas.villaForm')->with('villa',$villa);
            }
            else
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() ->back();
            }
        }
        else
        {
            alert()->error('Oops....','this element does not exist .. try again');
            return redirect() -> back();
        }
    }
    public function checkordervilla(Request $data)
    {
        $id=$data->id;
        $id=(int)$id;
        if(is_integer($id))
        {
            $villa=Villa::find($id);
            if($villa)
            {
                    $discount = DiscountVilla::where('villa_id',$id)
                    ->where('number_days', '<=', $data->numberdays)->orderby('number_days', 'DESC')->get();
                    if ($discount->count() > 0)
                    {
                        $dis =  ($discount[0]->rate * $villa->price) / 100;  // dis
                        $price = $villa->price *  $data->numberdays;    //before dis
                        $finallPrice = $price - $dis;  // after dis
                    } else
                    {
                        $dis = 0;
                        $price = $villa->price;
                        $finallPrice = $villa->price;
                    }
                     $cartvilla = new \stdClass();
                     $cartvilla->villa_id=$villa->id;
                     $cartvilla->villa_name=$villa->name_ar;
                     $cartvilla->price=$finallPrice;
                     $cartvilla->begindate=$data->begindate;
                     $cartvilla->enddate=$data->enddate;
                     $cartvilla->customrname=$data->customrname;
                $cartvilla->numberdays = $data->numberdays;
                $cartvilla->number = $data->number;
                     $cartvilla->personnes=$data->persones;
                     return view('villas.detail',compact('cartvilla'));
            }
            else
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() ->back();
            }
        }
        else
        {
            alert()->error('Oops....','this element does not exist .. try again');
            return redirect() ->back();
        }
    }
    public function confirmordervilla(Request $data)
    {
        $id=$data->id;
        $id=(int)$id;
        if(is_integer($id))
        {
            $villa=Villa::find($id);
            if($villa)
            {
                    $discount = DiscountVilla::where('villa_id',$id)
                    ->where('number_days', '<=', $data->numberdays)->orderby('number_days', 'DESC')->get();
                    if ($discount->count() > 0)
                    {
                        $dis =  ($discount[0]->rate * $villa->price) / 100;  // dis
                        $price = $villa->price *  $data->numberdays;    //before dis
                        $finallPrice = $price - $dis;  // after dis
                    } else
                    {
                        $dis = 0;
                        $price = $villa->price;
                        $finallPrice = $villa->price;
                    }
                    $newreservation=new ReservationVilla;
                    $newreservation->user_id=1;
                    $newreservation->villa_id=$id;
                    $newreservation->price=$finallPrice;
                    $newreservation->Num='DE0001';
                    $newreservation->numerdays=$data->numberdays;
                    $newreservation->customrname=$data->customrname;
                    $newreservation->personnes=$data->personnes;
                    $newreservation->begindate=$data->begindate;
                    $newreservation->enddate=$data->enddate;
                    $newreservation->phone=$data->number;
                    $newreservation->status='pending';
                    $newreservation->save();
                    return response()->json(['msg' => 'تم تأكيد حجزك'], 200);
            }
            else
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() ->back();
            }
        }
        else
        {
            alert()->error('Oops....','this element does not exist .. try again');
            return redirect() ->back();
        }
    }
    public function getallorders()
    {
        $allorders = ReservationVilla::get();
        return view('admin.ordervillas.index', compact('allorders'));
    }
    public function editordervilla($id)
    {
        $order = ReservationVilla::find($id);
        if ($order)
         {
            return view('admin.ordervillas.edit', compact('order'));
        } else
        {
            alert()->error('Oops....', 'this element does not exist .. try again');
            return redirect()->back();
        }
    }
    public function updateordervilla(Request $data)
    {
        $id = $data->id;
        $order = $order = ReservationVilla::find($id);
        if ($order)
        {
            $update = $order->update([
                'Note' => $data->note,
                'status' => $data->status,
            ]);
            if ($update) {

                $status = 200;
                $msg  = 'تم تعديل الداتا بنجاح ';
            } else {
                $status = 500;
                $msg  = ' تعذر التعديل هناك خطأ ما';
            }
        } else
         {
            $status = 500;
            $msg  = ' تعذر التعديل هناك خطأ ما';
        }
        return response()->json([
                'status' => $status,
                'msg' => $msg,
            ]);
    }
    public function deleteordervilla(Request $request)
    {
        $ordervilla = ReservationVilla::find($request->id);
        if ($ordervilla)
         {
            $ordervilla->delete();
            return response()->json([
                    'msg'  => 'تم حذف الداتا بنجاح ',
                    'id' => $request->id,
                ], 200);
        } else
         {
            return response()->json([
                    'msg'  => ' تعذر الحذف هناك خطأ ما ',
                ], 500);
        }
    }
    public function showdetailvilla($id)
    {
        $order = ReservationVilla::find($id);
        if ($order)
         {
            return view('admin.ordervillas.detail', compact('order'));
        } else
        {
            alert()->error('Oops....', 'this element does not exist .. try again');
            return redirect()->back();
        }
    }
    public function villaApi()
    {
        $villas = Villa::select()->get();
        foreach ($villas as $t) {
            $t->image = url('/') . '/assets/admin/img/villas/' . $t->image;
        }
        return response()->json(['villas' => $villas], 200);
    }

    public function Villaordered($govId)
    {
        // $hotels = DB::table('hotels')->where('gouvernement', $govId)->orderBy('sort', 'DESC')->get();
        $villas = Villa::where('gouvernement', $govId)->get();
        foreach ($villas as $t) {
            $t->image = url('/') . '/assets/admin/img/villas/' . $t->image;
        }


        return response()->json(['villas', $villas], 200);
    }
}
