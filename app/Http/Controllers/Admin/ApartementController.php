<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Traits\media;
use Illuminate\Http\Request;
use App\Models\Admin\Apartement;
use App\Models\Admin\Gouvernement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Admin\ImgaeApartement;
use App\Models\ReservationApartement;
use App\Models\Admin\ServiceApartement;
use App\Models\Admin\DiscountApartement;
use App\Http\Requests\Apartement\UpdateApartement;
use App\Http\Requests\Apartement\StoreApartementRequest;

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
        $request = $data->except('_token', 'image','services','page','images');
        $request['image'] = $imageName;
        $stored = DB::table('apartments')->insertGetId($request);
       //$stored=Apartement::create($request);
        if ($stored) {
            $apartement = Apartement::find($stored);
            $apartement->services()->attach($data->services);
            for ($x = 0; $x <= count($data->images) - 1; $x++) {
                $imageName = $this->uploadManyMedia($data->images[$x], 'apartements/covers/', $x);
                ImgaeApartement::create(['image' =>  $imageName, 'apartement_id' => $stored]);
            }
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

        $allapartements=Apartement::paginate(8);
        return view('admin.Apartments.index',compact('allapartements'));
    }
    public function delete(Request $request)
    {
        $apartement=Apartement::find($request->id);
        if($apartement)
        {
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
                return redirect() -> route('adminHome');
            }
            $apartement = Apartement::select()->find($id);
            $allservices=ServiceApartement::select('id','name')->get();
            $ownservices=$apartement->services;
            $allgouvernements=Gouvernement::select('id','name')->get();
            return view('admin.Apartments.edit', compact('apartement', 'allgouvernements', 'allservices', 'ownservices'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('adminHome');
        }

    }
    public function update(UpdateApartement $data)
    {
        $apartement=Apartement::find($data->id);
        if ($apartement)
         {
            $id=$data->id;
            $result = $data->except('page', 'image', '_token', '_method','id','services','images');
            if ($data->has('image')) {
                $oldImage = DB::table('apartments')->select('image')->where('id', $id)->first()->image;
                $this->deleteMedia($oldImage, 'apartements');
                $imageName = $this->uploadMedia($data->image, 'apartements');
                $result['image'] = $imageName;
            }
            if ($data->has('images'))
            {
                   $oldImages =  $apartement->images;
                   foreach ($oldImages as $old) {
                       $this->deleteMedia($old->image, 'apartements/covers/');
                       DB::table('imagesapartements')->where('id', $old->id)->delete();
                   }
                   for ($x = 0; $x <= count($data->images) - 1; $x++) {
                    $imageName = $this->uploadManyMedia($data->images[$x], 'apartements/covers', $x);
                       ImgaeApartement::create(['image' =>  $imageName, 'apartement_id' => $apartement->id]);
                   }
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
    public function userIndex()
    {
        $apartements = Apartement::get()->Where('status', 1);        
        foreach ($apartements as $apart) {
            $apart->image = url('/') . '/assets/admin/img/apartements/' . $apart->image;
        }
        return view('Apartements.Apartements')->with('apartements',$apartements);
    }
    public function oneApartement($id)
    {
        $id=(int)$id;
        if(is_integer($id))
        {
            $apartement = Apartement::find($id);

            if($apartement)
            {
                        $apartement->image =  url('/') . '/assets/admin/img/apartements/' . $apartement->image;
                        return view('Apartements.ApartementForm')->with('apartement',$apartement);
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
    public function checkorderapartement(Request $data)
    {
        $id=$data->id;
        $id=(int)$id;
        if(is_integer($id))
        {
            $apartement=Apartement::find($id);
            if ($apartement) {
                    $discount = DiscountApartement::where('apartement_id',$id)
                    ->where('number_days', '<=', $data->numberdays)->orderby('number_days', 'DESC')->get();
           
                    if ($discount->count() > 0)
                    {
                 
                    $mainPrice = $apartement->price;
                    $price = $apartement->price * $data->numberdays;    //before dis
                    $dis =  ($discount[0]->rate * $price) / 100;  // dis    %
                    $finallPrice = $price - $dis;  // after dis
                    } else
                    {
                    $dis = 0;
                    $price = $apartement->price * $data->numberdays;
                    $finallPrice =   $apartement->price * $data->numberdays;
                    }
                     $cartapart = new \stdClass();
                $cartapart->apart_id =   $apartement->id;
                $cartapart->apart_name = $apartement->name_ar;
                $cartapart->main_price = $apartement->price;
                $cartapart->pricebefore  = $price;
                $cartapart->discount = $dis;
                $cartapart->finallPrice  = $finallPrice;
                $cartapart->begindate =  $data->begindate;
                $cartapart->enddate =     $data->enddate;
                $cartapart->customrname = $data->customrname;
                $cartapart->numberdays = $data->numberdays;
                $cartapart->number = $data->number;
                     $cartapart->personnes=$data->persones;
                     return view('Apartements.detail',compact('cartapart'));
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
    public function confirmorderapart(Request $data)
    {
        $id=$data->id;
        $id=(int)$id;
        if(is_integer($id))
        {
            $apartement=Apartement::find($id);
            if($apartement)
            {
                    $discount = DiscountApartement::where('apartement_id',$id)
                    ->where('number_days', '<=', $data->numberdays)->orderby('number_days', 'DESC')->get();
                    if ($discount->count() > 0)
                    {

                    $price = $apartement->price * $data->numberdays;    //before dis
                    $dis =  ($discount[0]->rate * $price) / 100;  // dis    %
                    $finallPrice = $price - $dis;  // after dis
                    } else
                    {
                    $dis = 0;
                    $price = $apartement->price * $data->numberdays;    //before dis
                    $finallPrice = $apartement->price * $data->numberdays;   // after dis
                    }
                    $newreservation=new ReservationApartement;
                $newreservation->user_id            = Auth::user()->id;
                $newreservation->apartement_id      = $id;
                $newreservation->apartement_name    = $apartement->name_ar;
                $newreservation->price              = $apartement->price;
                $newreservation->dis                = $dis;
                $newreservation->pricebefore        = $price;
                $newreservation->finallprice        = $finallPrice;
                $newreservation->Num                =  'A' . Auth::user()->id . time();
                $newreservation->numerdays          = $data->numberdays;
                $newreservation->customrname         = $data->customrname;
                $newreservation->personnes          = $data->personnes;
                $newreservation->begindate = $data->begindate;
                $newreservation->enddate   = $data->enddate;
                $newreservation->phone = $data->number;
                $newreservation->status =   1;
                $newreservation->Note =  '....';
                    $newreservation->save();
                $msg =  "لقد قام " . '  ' .  $data->customrname  . '  ' . " بطلب تأجير شقة    " . '  ' . $apartement->name_ar  . "وعدد الاشخاص " . $data->personnes;
                $msg .= " ورقم الواتساب الخاص به " . '  ' . $data->number . '  ' . " وحجز  " . '  ' . $data->numberdays . "  يوم ";
                $msg .= " وتاريخ الاستلام " . $data->begindate .  "  " . " حتى تاريخ "  . $data->enddate;
                $msg .= "  والتكلفه الاجماليه قبل الخصم   " . $price . "$" . "  والتكلفه الاجماليه بعد الخصم " . $finallPrice .  "$ بعد خصم مقداره " . $dis . "$";
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
        $allorders = ReservationApartement::paginate(8);
        return view('admin.orderapartements.index', compact('allorders'));
    }
    public function editorderapart($id)
    {
        $order = ReservationApartement::find($id);
        if ($order) {
            return view('admin.orderapartements.edit', compact('order'));
        } else {
            alert()->error('Oops....', 'this element does not exist .. try again');
            return redirect()->back();
        }
    }
    public function updateorderapart(Request $data)
    {
        $id = $data->id;
        $order = $order = ReservationApartement::find($id);
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
    public function deleteorderapart(Request $request)
    {
        $orderapart = ReservationApartement::find($request->id);
        if ($orderapart)
         {
            $orderapart->delete();
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
    public function showdetailapart($id)
    {
        $order = ReservationApartement::find($id);
        if ($order)
         {
            return view('admin.orderapartements.detail', compact('order'));
        } else
        {
            alert()->error('Oops....', 'this element does not exist .. try again');
            return redirect()->back();
        }
    }

    public function apartementApi()
    {
        $apartements = Apartement::get()->Where('status', 1);
        foreach ($apartements as $apart) {
            $apart->image = url('/') . '/assets/admin/img/apartements/' . $apart->image;
        }
        return response()->json(['apartements' => $apartements], 200);
    }

    public function Apartordered($govId)
    {
        // $hotels = DB::table('hotels')->where('gouvernement', $govId)->orderBy('sort', 'DESC')->get();

        $apartements = Apartement::where('gouvernement', $govId)->get()->Where('status', 1);
        foreach ($apartements as $apart) {
            $apart->image = url('/') . '/assets/admin/img/apartements/' . $apart->image;
        }

        return response()->json(['apartements', $apartements], 200);
    }
}
