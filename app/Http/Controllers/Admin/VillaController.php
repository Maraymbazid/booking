<?php

namespace App\Http\Controllers\Admin;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\media;
use App\Models\Admin\Villa;
use App\Models\ReservationVilla;
use App\Models\Admin\Gouvernement;
use App\Models\Admin\ImagesVillas;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\DiscountVilla;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Villa\StoreVilla;
use App\Models\Admin\ServiceApartement;
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
        $request = $data->except('_token', 'image','services','page','images');
        $request['image'] = $imageName;
        $stored = DB::table('villas')->insertGetId($request);
        if ($stored)
        {
            $villa = Villa::find($stored);
            $villa->services()->attach($data->services);
            for ($x = 0; $x <= count($data->images) - 1; $x++) {
                $imageName = $this->uploadManyMedia($data->images[$x], 'villas/covers/', $x);
                ImagesVillas::create(['image' =>  $imageName, 'villa_id' => $stored]);
            }
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

        $allvillas=Villa::paginate(8);
        return view('admin.villas.index',compact('allvillas'));
    }
    public function delete(Request $request)
    {
        $villa=Villa::find($request->id);
        if($villa)
        {
            $villa->services()->detach();
            $villa->images()->delete();
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
                return redirect() -> route('adminHome');
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
            return redirect() -> route('adminHome');
        }

    }
    public function update(UpdateVilla $data)
    {
        $villa=Villa::find($data->id);
        if ($villa)
         {
            $id=$data->id;
            $result = $data->except('page', 'image', '_token', '_method','id','services','images');
            if ($data->has('image')) {
                $oldImage = DB::table('villas')->select('image')->where('id', $id)->first()->image;
                $this->deleteMedia($oldImage, 'villas');
                $imageName = $this->uploadMedia($data->image, 'villas');
                $result['image'] = $imageName;
            }
            if ($data->has('images'))
            {
                   $oldImages =  $villa->images;
                   foreach ($oldImages as $old) {
                       $this->deleteMedia($old->image, 'villas/covers/');
                       DB::table('imagesvillas')->where('id', $old->id)->delete();
                   }
                   for ($x = 0; $x <= count($data->images) - 1; $x++) {
                       $imageName = $this->uploadManyMedia($data->images[$x], 'villas/covers/', $x);
                       ImagesVillas::create(['image' =>  $imageName, 'villa_id' => $villa->id]);
                   }
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
                return view('villas.VillaForm')->with('villa', $villa);
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

                    $price = $villa->price * $data->numberdays;    //before dis
                    $dis =  ($discount[0]->discount * $price) / 100;  // dis    %
                    $finallPrice = $price - $dis;  // after dis
                    } else
                    {
                        $dis = 0;
                    $price = $villa->price * $data->numberdays;    //before dis
                    $finallPrice =  $villa->price * $data->numberdays;  // after dis
                    }
                $cartvilla = new \stdClass();
                $cartvilla->villa_id           = $villa->id;
                $cartvilla->villa_name         = $villa->name_ar;
                $cartvilla->main_price              = $villa->price;
                $cartvilla->discount           = $dis;
                $cartvilla->pricebefore        = $price;
                $cartvilla->finallPrice        = $finallPrice;
                $cartvilla->begindate          = $data->begindate;
                $cartvilla->enddate            = $data->enddate;
                $cartvilla->customrname        = $data->customrname;
                $cartvilla->numberdays         = $data->numberdays;
                $cartvilla->number             = $data->number;
                $cartvilla->personnes          = $data->persones;
                return view('villas.detail', compact('cartvilla'));
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

                    $price = $villa->price * $data->numberdays;    //before dis
                    $dis =  ($discount[0]->discount * $price) / 100;  // dis    %
                    $finallPrice = $price - $dis;  // after dis
                    } else
                    {
                        $dis = 0;
                    $price = $villa->price * $data->numberdays;    //before dis
                    $finallPrice =  $villa->price * $data->numberdays;  // after dis
                    }
                    $newreservation=new ReservationVilla;
                    $newreservation->user_id =  Auth::user()->id;
                    $newreservation->villa_id  = $id;
                    $newreservation->villa_name  =  $villa->name_ar;
                    $newreservation->price             = $villa->price;
                    $newreservation->discount                = $dis;
                    $newreservation->pricebefore        = $price;
                    $newreservation->finallprice        = $finallPrice;
                    $newreservation->Num          =  'V' . Auth::user()->id . time();
                    $newreservation->numerdays  = $data->numberdays;
                    $newreservation->customrname=$data->customrname;
                    $newreservation->personnes=$data->personnes;
                    $newreservation->begindate=$data->begindate;
                    $newreservation->enddate=$data->enddate;
                    $newreservation->phone=$data->number;
                    $newreservation->status = 1;
                    $newreservation->note = '....';
                    $newreservation->save();
                    $msg =  "لقد قام " . '  ' .  $data->customrname  . '  ' . "  بطلب تأجير فيلا    " . '    ' . $villa->name_ar  . "وعدد الاشخاص " . $data->personnes;
                    $msg .= " ورقم الواتساب الخاص به " . '  ' . $data->number . '  ' . " وحجز  " . '  ' . $data->numberdays . "  يوم ";
                    $msg .= " وتاريخ الاستلام " . $data->begindate . "حتى تاريخ " . $data->enddate  .  "   والتكلفه الاجماليه قبل الخصم   " . $price . "$" . "  والتكلفه الاجماليه بعد الخصم " . $finallPrice .  "$ بعد خصم مقداره " . $dis . "$";
                    $msg .= "وهذا الطلب تم تنفيذه من حساب " .  Auth::user()->name . "  وتم تسجيل الطلب بنجاح والرقم المرجعي للطلب " . " " . $newreservation->Num;
                    $res = Http::timeout(15)->get('https://api.telegram.org/bot5418440137:AAGUCn9yFMZWFNyf-o075nr5aL-Qu6nmvns/sendMessage?chat_id=@adawe23&text=' . $msg);
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
        $allorders = ReservationVilla::paginate(8);
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
        if($data->status!= 1 && $data->status!= 2 && $data->status!= 3 && $data->status!= 4)
        {
            return response()->json([
                'status' => 500,
                'msg' =>' تعذر التعديل هناك خطأ ما'
            ]);
        }
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
