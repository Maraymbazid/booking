<?php

namespace App\Http\Controllers;

use \stdClass;
use App\Models\Car;
use App\Http\Traits\media;
use Illuminate\Http\Request;
use App\Models\ReservationCar;
use App\Models\Admin\DiscountCar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Admin\ImageCar;
use App\Http\Requests\Car\UpdateCar;
use Exception;
class CarController extends Controller
{
    use media;

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $imageName = $this->uploadMedia($request->image, 'cars');
        $car = new Car();
        $car->name = $request->name;
        $car->image = $imageName;
        $car->company_id = $request->company_id;
        $car->price  = $request->price;
        $car->meth  = $request->meth;
        $car->model  = $request->model;
        $car->save();
        for ($x = 0; $x <= count($request->images) - 1; $x++) {
            $imageName = $this->uploadManyMedia($request->images[$x], 'cars/covers/', $x);
            ImageCar::create(['image' =>  $imageName, 'car_id' => $car->id]);
        }

        return response()->json(['msg' => 'تم حفظ الداتا بنجاح '], 200);
    }

    public function index()
    {
        $cars =Car::paginate(8);
        return view('admin.cars.index')->with('cars', $cars);
    }

    public function edit($id)
    {
        $car = DB::table('cars')->where('id', $id)->first();
        // $arr = [];
        // array_push($arr, $car);
        if ($car) {
            return view('admin.cars.edit',compact('car'));
        } else {
            return redirect()->back();
        }
    }

    public function update(UpdateCar $data)
    {
        $result = $data->except('page', 'image',  'carId', '_token', '_method','images');
        $car=Car::find($data->carId);
        if($car)
        {
            if ($data->has('image'))
            {
                $oldImage = DB::table('cars')->select('image')->where('id', $data->carId)->first()->image;
                $this->deleteMedia($oldImage, 'cars');
                $imageName = $this->uploadMedia($data->image, 'cars');
                $result['image'] = $imageName;
            }
            if ($data->has('images'))
            {
                   $oldImages =  $car->images;
                   foreach ($oldImages as $old) {
                       $this->deleteMedia($old->image, 'cars/covers/');
                       DB::table('imagescars')->where('id', $old->id)->delete();
                   }
                   for ($x = 0; $x <= count($data->images) - 1; $x++) {
                       $imageName = $this->uploadManyMedia($data->images[$x], 'cars/covers/', $x);
                       ImageCar::create(['image' =>  $imageName, 'car_id' => $car->id]);
                   }
           }
            $updatecar = $car->update($result);
            if ($updatecar)
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
        $car=Car::find($request->id);
        if($car)
        {
            $car->images()->delete();
            $car->delete();
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
        $cars =Car::get();

        foreach ($cars as $car) {
            $car->image = url('/') . '/assets/admin/img/cars/' . $car->image;
        }
        return view('cars.cars')->with('cars', $cars);
    }
    public function oneCar($id)
    {
        $id=(int)$id;
        if(is_integer($id))
        {
            $car=Car::find($id);
            if($car)
            {
                if ($car->meth == 3) {
                    $car->meth = ' شهريا ';
                    $car->dis = ' شهور ';
                    $car->inp = 'المده بالشهر ';
                } elseif ($car->meth == 2) {
                    $car->meth = ' اسبوعيا ';
                    $car->dis = ' اسبوع ';
                    $car->inp = ' المده بالاسابيع ';
                } else {
                    $car->meth = ' يوميا ';
                    $car->dis = ' يوم ';
                    $car->inp = 'المده باليوم ';
                }
                     $car->image = url('/') . '/assets/admin/img/cars/' . $car->image;
                      return view('cars.carForm')->with('car',  $car);

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
    public function checkordercar(Request $data)
    {
        $id=$data->id;
        $id=(int)$id;
        if(is_integer($id))
        {
            $car=Car::find($id);
            if($car)
            {
                    $discount = DiscountCar::where('car_id',$id)
                    ->where('number_days', '<=', $data->numberdays)->orderby('number_days', 'DESC')->get();
                    if ($discount->count() > 0)
                    {
                    $mainPrice = $car->price;
                    $price = $car->price *  $data->numberdays;    //before dis
                    $dis =  ($discount[0]->rate * $price) / 100;  // dis    %
                    $finallPrice = $price - $dis;  // after dis
                } else {
                    $mainPrice = $car->price;
                    $dis = 0;
                    $price = $car->price *  $data->numberdays;
                    $finallPrice = $car->price *  $data->numberdays;
                }
                if ($car->meth == 3) {
                    $method = ' الشهر ';
                    $show = ' الشهور ';
                } elseif ($car->meth == 2) {
                    $method = ' الاسبوع ';
                    $show = ' الاسابيع ';
                } else {
                    $method = ' اليوم ';
                    $show = ' الايام ';
                    }
                $cartcar = new \stdClass();
                $cartcar->mainPrice = $mainPrice;     //main price in day
                $cartcar->beforedis = $price;          // price before dis
                $cartcar->discount  = $dis;          //  dis
                $cartcar->price = $finallPrice;          // price after dis
                $cartcar->car_id = $car->id;           //car_id
                $cartcar->car_name = $car->name;
                $cartcar->method = $method;
                $cartcar->show = $show;
                $cartcar->modal = $car->model;
                $cartcar->deliveryplace = $data->deliveryplace;
                $cartcar->customrname = $data->customrname;
                $cartcar->date = $data->date;
                $cartcar->receivingplace = $data->receivingplace;
                $cartcar->numberdays = $data->numberdays;
                $cartcar->number = $data->number;
                return view('cars.detail', compact('cartcar'));
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
    public function confirmordercar(Request $data)
    {
        $id=$data->id;
        $car=Car::find($id);
        if($car)
        {
            $discount = DiscountCar::where('car_id',$id)
            ->where('number_days', '<=', $data->numberdays)->orderby('number_days', 'DESC')->get();
            if ($discount->count() > 0) {
                $mainPrice = $car->price;
                $price = $car->price *  $data->numberdays;    //before dis
                $dis =  ($discount[0]->rate * $price) / 100;  // dis    %
                $finallPrice = $price - $dis;  // after dis
            } else {
                $mainPrice = $car->price;
                $dis = 0;
                $price = $car->price *  $data->numberdays;
                $finallPrice = $car->price *  $data->numberdays;
            }
            if ($car->meth == 3) {
                $method = ' الشهر ';
                $show = ' الشهور ';
                $ms = ' شهر ';
            } elseif ($car->meth == 2) {
                $method = ' الاسبوع ';
                $show = ' الاسابيع ';
                $ms = ' اسبوع ';
            } else {
                $method = ' اليوم ';
                $show = ' الايام ';
                $ms = ' يوم ';

            }
            $newreservation=new ReservationCar;
            $newreservation->user_id   = Auth::user()->id;
            $newreservation->car_id    = $id;
            $newreservation->car_name    =  $car->name;
            $newreservation->mainPrice = $mainPrice;     //main price in day
            $newreservation->beforeDis = $price;          // price before dis
            $newreservation->discount  = $dis;          //  dis
            $newreservation->price     = $finallPrice;
            $newreservation->method     = $method;
            $newreservation->show       = $show;
            $newreservation->Num = 'C' . Auth::user()->id . time();
            $newreservation->deliveryplace=$data->deliveryplace;
            $newreservation->customrname = $data->customrname;
            $newreservation->receivingplace=$data->receivingplace;
            $newreservation->date=$data->date;
            $newreservation->numberdays=$data->numberdays;
            $newreservation->number=$data->number;
            $newreservation->status = 1;
            $newreservation->save();

            $msg =  "لقد قام " . '  ' .  $data->customrname  . '  ' . " بطلب تأجير سياره    " . '  ' . $car->name  . "  " . " والموديل" . " " .  $car->model;
            $msg .= " ورقم الواتساب الخاص به " . '  ' . $data->number . '  ' . " وحجز  " . '  ' . $data->numberdays .  $ms;
            $msg .= " وتاريخ الاستلام " . $data->date . "  والتكلفه الاجماليه قبل الخصم   " . $price . "$" . "  والتكلفه الاجماليه بعد الخصم " . $finallPrice .  "$ بعد خصم مقداره " . $dis . "$";
            $msg .= "   ومكان استلام السياره   " . "    " .  $data->receivingplace . "    " .   "ومكان تسليم السياره " . "   " . $data->deliveryplace . "    ";
            $msg .= "وهذا الطلب تم تنفيذه من حساب " .  Auth::user()->name . "  وتم تسجيل الطلب بنجاح والرقم المرجعي للطلب " . " " . $newreservation->Num;
            $res = Http::timeout(15)->get('https://api.telegram.org/bot5418440137:AAGUCn9yFMZWFNyf-o075nr5aL-Qu6nmvns/sendMessage?chat_id=@adawe23&text=' . $msg);
            return response()->json(['msg' => 'تم حفظ بيانتك بنجاح',], 200);

        }
        else
        {
            return response()->json(['msg' => ' حدث هناك خطأ يرجى إعادة محاولة لاحقا '], 500);
        }
    }

    public function getallorders()
    {
        $allorders=ReservationCar::paginate(8);
        return view('admin.ordercars.index',compact('allorders'));
    }
    public function editordercar($id)
    {
        $order=ReservationCar::find($id);
        if($order)
        {
            return view('admin.ordercars.edit',compact('order'));
        }
        else
        {
            alert()->error('Oops....','this element does not exist .. try again');
            return redirect() ->back();
        }
    }
    public function updateorder(Request $data)
    {
       $id=$data->id;
       $order=$order=ReservationCar::find($id);
       if($data->status!= 1 && $data->status!= 2 && $data->status!= 3 && $data->status!= 4)
       {
           return response()->json([
               'status' => 500,
               'msg' =>' تعذر التعديل هناك خطأ ما'
           ]);
       }
       if($order)
       {
          $update=$order->update([
              'note' => $data->note,
              'status'=> $data->status,
          ]);
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
    public function show($id)
    {
        $order=ReservationCar::find($id);
        if($order)
        {
            return view('admin.ordercars.detail',compact('order'));
        }
        else
        {
            alert()->error('Oops....','this element does not exist .. try again');
            return redirect() ->back();
        }
    }
    public function deleteordercar(Request $request)
    {
        $ordercar=ReservationCar::find($request->id);
        if($ordercar)
        {
            $ordercar->delete();
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
                 'msg'  => ' تعذر الحذف هناك خطأ ما ',
            ],500);
        }
    }

    public function carApi()
    {
        $cars = Car::get();
        foreach ($cars as $car) {
            $car->image = url('/') . '/assets/admin/img/cars/' . $car->image;
            if ($car->meth == 3)   $car->meth = 'شهر';
            if ($car->meth == 2)   $car->meth = 'اسبوع';
            if ($car->meth == 1)   $car->meth = 'يوم';
        }
        return response()->json(['cars' => $cars], 200);
    }
}
