<?php

namespace App\Http\Controllers;

use App\Models\Taxi;
use App\Http\Traits\media;
use Illuminate\Http\Request;
use App\Models\Admin\ImageTaxi;
use App\Models\Admin\PromoCode;
use App\Models\ReservationTaxi;
use App\Models\Admin\Destination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TaxiController extends Controller
{
    use media;
    private  $image;
    public function create()
    {
        return view('admin.taxi.create');
    }

    public function store(Request $request)
    {
        // you should check if the request has company id or not
        $imageName = $this->uploadMedia($request->image, 'taxi');
        $taxi = new Taxi();
        $taxi->name = $request->name;
        $taxi->image = $imageName;
        $taxi->company_id = $request->company_id;
        $taxi->price  = $request->price;
        $taxi->model  = $request->model;
        $taxi->save();
        for ($x = 0; $x <= count($request->images) - 1; $x++) {
            $imageName = $this->uploadManyMedia($request->images[$x], 'taxi/covers/', $x);
            ImageTaxi::create(['image' =>  $imageName, 'taxi_id' => $taxi->id]);
        }
        return response()->json(['msg' => 'تم حفظ الداتا بنجاح '], 200);
    }

    public function index()
    {
        $taxis =Taxi::get();
        return view('admin.taxi.index')->with('taxis', $taxis);
    }
    public function edit($id)
    {
        $taxi = DB::table('taxis')->where('id', $id)->first();
        // $arr = [];
        // array_push($arr, $tax);
        if ($taxi)
         {
            return view('admin.taxi.edit', compact('taxi'));
        }
        else
        {
            return redirect()->back();
        }
    }
    public function update(Request $data)
    {
        $taxi =Taxi::find($data->taxId);
        $result = $data->except('page', 'image','taxId', '_token', '_method','images');
        if($taxi)
        {
            if ($data->has('image')) {
                $oldImage = DB::table('taxis')->select('image')->where('id', $data->taxId)->first()->image;
                $this->deleteMedia($oldImage, 'taxi');
                $imageName = $this->uploadMedia($data->image, 'taxi');
                $result['image'] = $imageName;
            }
            if ($data->has('images'))
            {
                   $oldImages =  $taxi->images;
                   foreach ($oldImages as $old) {
                       $this->deleteMedia($old->image, 'taxi/covers/');
                       DB::table('imagestaxis')->where('id', $old->id)->delete();
                   }
                   for ($x = 0; $x < count($data->images); $x++) {
                       $imageName = $this->uploadManyMedia($data->images[$x], 'taxi/covers/', $x);
                       ImageTaxi::create(['image' =>  $imageName, 'taxi_id' => $taxi->id]);
                   }
           }
            $updatetaxi = $taxi->update($result);
            if ($updatetaxi)
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
    public function delete(Request $request)
    {
        $taxi=Taxi::find($request->id);
        if($taxi)
        {
            $taxi->images()->delete();
            $taxi->delete();
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
    public function userIndex()
    {
        $taxis = Taxi::get();
        foreach ($taxis as $t) {
            $t->image = url('/') . '/assets/admin/img/taxi/' . $t->image;
        }
        return view('taxi.taxi')->with('taxis', $taxis);
    }

    public function oneTaxi($id)
    {
        $id = (int)$id;
        if (is_integer($id))
         {
            $taxi = Taxi::find($id);
            $alldestinations=Destination::select()->get();
            if ($taxi)
                {
                        $taxi->image = url('/') . '/assets/admin/img/taxi/' . $taxi->image;
                        return view('taxi.taxform',compact('taxi','alldestinations'));
                }
             else
                {
                alert()->error('Oops....', 'this element does not exist .. try again');
                return redirect()->back();
                }
        }
        else
            {
            alert()->error('Oops....', 'this element does not exist .. try again');
            return redirect()->back();
            }
    }
    public function getpricedestination(Request $request)
    {
        $value = $request->get('id');
        $dependent = $request->get('dependent');
        $destination =Destination::find($value);
        $output='<label for="place" class="col-sm-2 col-form-label">   سعر الواجهة  </label>
                    <div class="col-lg-10 col-12">
                        <input type="text" class="form-control" id="price" name="price" value="' .$destination->price . '">
                    </div>';
        echo $output;
    }
    public function applyPromo($promo)
    {
        $pro =  PromoCode::where('name', $promo)->where('status', 1)->where('personnes', '>', 0)->first();
        if ($pro) {
            $now = date('Y-m-d');
            if ($now <= $pro->enddate) {
                return ['status' => true, 'promo' => $pro];
            } else {
                return  ['status'  => false, 'promo' =>  'هذا الكود منتهي '];
            }
        } else {
            return ['status' => false, 'promo' =>  'هذا الكود غير صالح '];
        }
    }
    public function checkorder(Request $data)
    {
        $id = $data->id;
        $id = (int)$id;
        $id_destination=$data->destination;

        if (is_integer($id)) {
            $taxi = Taxi::find($id);
            $destination = Destination::find($id_destination);
            if ($taxi && $destination) {
                if ($data->promo) {
                    $promo = $this->applyPromo($data->promo);
                    if ($promo['status'] !== false) {
                        $discount = $promo['promo']->discount;
                    } else {
                        return redirect()->back()->with(['promomsg' => $promo['promo']]);
                    }
                } else {
                    $discount = null;
                }
                if ($discount !== null) {
                    $mainPrice = $destination->price;
                    $price = $destination->price;    //before dis
                    $dis =  ($discount * $price) / 100;  // dis    %
                    $finallPrice = $price - $dis;  // after dis
                    $pr = $promo['promo']->name;
                } else {
                    $mainPrice = $destination->price;
                    $price     = $destination->price;    //before dis
                    $dis       = 0;
                    $finallPrice = $destination->price;
                    $pr = null;
                }
                $image = $this->uploadMedia($data->ticket, 'taxi/tickets');
                $carttaxi =  new \stdClass();
                $carttaxi->user_id =   Auth::user()->id;
                $carttaxi->taxi_id = $id;
                $carttaxi->taxi_name = $taxi->name;
                $carttaxi->discount = $dis;
                $carttaxi->pr = $pr;
                $carttaxi->finallPrice = $finallPrice;
                $carttaxi->model = $taxi->model;
                $carttaxi->phone = $data->phone;
                $carttaxi->deliveryplace = $data->deliveryplace;
                $carttaxi->customrname = $data->customrname;
                $carttaxi->datearrive = $data->datearrive;
                $carttaxi->destination_name = $destination->name;
                $carttaxi->destination_id= $destination->id;
                $carttaxi->chauffeur = $data->chauffeur;
                $carttaxi->ticket = $image;

                return view('taxi.detail', compact('carttaxi'));
            } else {
                alert()->error('Oops....', 'this element does not exist .. try again');
                return redirect()->back();
            }
        } else {
            alert()->error('Oops....', 'this element does not exist .. try again');
            return redirect()->back();
        }
    }
    public function confirmorder(Request $data)
    {
        $id =$data->id;
        $id = (int)$id;
        $id_destination=$data->destination_id;
        $taxi = Taxi::find($id);
        $destination=Destination::find($id_destination);

        if ($taxi && $destination)
        {
            if ($data->promo) {
                $promo = $this->applyPromo($data->promo);
                if ($promo['status'] !== false) {
                    $discount = $promo['promo']->discount;
                    $mainPrice = $destination->price;
                    $price = $destination->price;    //before dis
                    $dis =  ($discount * $price) / 100;  // dis    %
                    $finallPrice = $price - $dis;  // after dis
                    $pr = $promo['promo']->name;
                } else {
                    $mainPrice = $destination->price;
                    $price     = $destination->price;    //before dis
                    $dis       = 0;
                    $finallPrice = $destination->price;
                    $pr = null;
                }
            } else {
                $mainPrice = $destination->price;
                $price     = $destination->price;    //before dis
                $dis       = 0;
                $finallPrice = $destination->price;
                $pr = null;
            }
            $newreservation = new ReservationTaxi;
            $newreservation->user_id =  Auth::user()->id;
            $newreservation->taxi_id = $id;
            $newreservation->taxi_name =  $taxi->name;
            $newreservation->Num = 'T' . Auth::user()->id . time();
            $newreservation->price = $destination->price;
            $newreservation->pro = $pr;
            $newreservation->discount = $dis;
            $newreservation->finallprice = $finallPrice;
            $newreservation->number = $data->phone;
            $newreservation->deliveryplace = $data->deliveryplace;
            $newreservation->customername = $data->customername;
            $newreservation->datearrive = $data->datearrive;
            $newreservation->destination = $data->destination_id;
            $newreservation->destination_name = $destination->name;
            $newreservation->chauffeur = $data->chauffeur;
            $newreservation->status = 1;
            $newreservation->ticket = $data->ticket;
            $newreservation->note = '.....';
            $newreservation->save();
            $im =   url('/') . "/assets/admin/img/taxi/tickets/" .  $data->ticket;
            if ($pr !== null) {
                $promoTry = $promo['promo']->personnes - 1;
                PromoCode::where('id',  $promo['promo']->id)->update([
                    'personnes' =>  $promoTry,
                ]);
            }
            $msg =  "لقد قام " . '  ' .  $data->customername  . '  ' . " بطلب تأجير تاكسي    " . '  ' .  $taxi->name  . " " . " والموديل" . $taxi->model;
            if ($pr !== null) {
                $msg .= "  واستعمل برومو " . '  ' . $pr;
                $msg .= "  وباقي  " . '  ' .  $promoTry . " استعمال";
            }
            $msg .= " ورقم الواتساب الخاص به " . '  ' . $data->phone;
            $msg .= " وتاريخ الوصول " . $data->datearrive . "  والتكلفه الاجماليه قبل الخصم   " . $price . "$" . "  والتكلفه الاجماليه بعد الخصم " . $finallPrice .  "$ بعد خصم مقداره " . $dis . "$";
            $msg .= "   ومكان استلام السياره   " . "  " .  $data->deliveryplace . "  والواجهة " . " " . $destination->name . " ";
            if ($data->chauffeur !== 0) {
                $msg .= " وطلب معها سائق ";
            }
            $msg .= "وهذا الطلب تم تنفيذه من حساب " .  Auth::user()->name . "  وتم تسجيل الطلب بنجاح والرقم المرجعي للطلب " . " " . $newreservation->Num;
            $msg .=  " وصورة التيكت " .  $im;
            $res = Http::timeout(15)->get('https://api.telegram.org/bot5418440137:AAGUCn9yFMZWFNyf-o075nr5aL-Qu6nmvns/sendMessage?chat_id=@adawe23&text=' . $msg);

            return response()->json([
                'status' => 200,
                'msg' => 'تم حفظ بيانتك بنجاح',
            ]);
        } else {
            return response()->json([
                'status' => '500',
                'msg' => ' حدث هناك خطأ يرجى إعادة محاولة لاحقا '
            ]);

        }
    }
    public function getallorders()
    {
        $allorders = ReservationTaxi::get();
        return view('admin.orderstaxiis.index', compact('allorders'));
    }
    public function editordertaxi($id)
    {
        $order = ReservationTaxi::find($id);
        if ($order) {
            return view('admin.orderstaxiis.edit', compact('order'));
        } else {
            alert()->error('Oops....', 'this element does not exist .. try again');
            return redirect()->back();
        }
    }
    public function updateordertaxi(Request $data)
    {
        $id = $data->id;
        $order = $order = ReservationTaxi::find($id);
        if ($order) {
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
        } else {
            $status = 500;
            $msg  = ' تعذر التعديل هناك خطأ ما';
        }
        return response()->json([
                'status' => $status,
                'msg' => $msg,
            ]);
    }
    public function deleteordertaxi(Request $request)
    {
        $ordertaxi = ReservationTaxi::find($request->id);
        if ($ordertaxi) {
            $ordertaxi->delete();
            return response()->json([
                    'msg'  => 'تم حذف الداتا بنجاح ',
                    'id' => $request->id,
                ], 200);
        } else {
            return response()->json([
                    'msg'  => ' تعذر الحذف هناك خطأ ما ',
                ], 500);
        }
    }
    public function showdetailtaxi($id)
    {
        $order = ReservationTaxi::find($id);
        $destination=Destination::find($order->destination);
        if($order && $destination) {
            $order->ticket = url('/') . '/assets/admin/img/taxi/tickets/' . $order->ticket;
            $order->destination=$destination->name;
            return view('admin.orderstaxiis.detail', compact('order'));
        } else {
            alert()->error('Oops....', 'this element does not exist .. try again');
            return redirect()->back();
        }
    }

    public function taxApi()
    {
        $taxis = Taxi::get();
        foreach ($taxis as $t) {
            $t->image = url('/') . '/assets/admin/img/taxi/' . $t->image;
        }
        return response()->json(['taxis' => $taxis], 200);
    }
}
