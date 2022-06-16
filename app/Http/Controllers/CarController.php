<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ReservationCar;
use App\Models\Admin\DiscountCar;
use \stdClass;
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
        $car->model  = $request->model;
        $car->save();

        return response()->json(['msg' => 'تم حفظ الداتا بنجاح '], 200);
    }

    public function index()
    {
        $cars =Car::get();
        return view('admin.cars.index')->with('cars', $cars);
    }

    public function edit($id)
    {
        $car = DB::table('cars')->where('id', $id)->first();
        $arr = [];
        array_push($arr, $car);
        if ($car) {
            return view('admin.cars.edit')->with('arr', json_encode($arr));
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $data)
    {
        // dd($data);
        $result = $data->except('page', 'image',  'carId', '_token', '_method');
        if ($data->has('image')) {
            $oldImage = DB::table('cars')->select('image')->where('id', $data->carId)->first()->image;
            $this->deleteMedia($oldImage, 'cars');
            $imageName = $this->uploadMedia($data->image, 'cars');
            $result['image'] = $imageName;
        }
        $update = DB::table('cars')->where('id', $data->carId)->update($result);
        if ($update) {
            return response()->json([
                'status' => 'done',
                'msg' => 'تم تعديل الداتا بنجاح ',
            ]);
        } else {
            alert()->error('Oops....', 'Something went wrong .. try again');
            return redirect()->route('Hotels');
        }
    }
    public function delete(Request $request)
    {
        $car=Car::find($request->id);
        if($car)
        {
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
                // return $car->discount->rate;
                // if(!empty($car->company_id))
                //   {
                //     $car = DB::table('cars')
                //     ->join('companies', 'cars.company_id', '=', 'companies.id')
                //     ->select('cars.*', 'companies.name as company')
                //     ->where('cars.id', $id)->first();
                //     $car->image = url('/') . '/assets/admin/img/cars/' . $car->image;
                //     return view('cars.carForm')->with('car',  $car);
                //   }
                //   else
                //   {
                     $car->image = url('/') . '/assets/admin/img/cars/' . $car->image;
                      return view('cars.carForm')->with('car',  $car);
                  //}
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
                        $dis =  ($discount[0]->rate * $car->price) / 100;  // dis
                        $price = $car->price *  $data->numberdays;    //before dis
                        $finallPrice = $price - $dis;  // after dis
                    } else
                    {
                        $dis = 0;
                        $price = $car->price;
                        $finallPrice = $car->price;
                    }
                     $cartcar = new \stdClass();
                     $cartcar->car_id=$car->id;
                     $cartcar->car_name=$car->name;
                     $cartcar->modal=$car->model;
                     $cartcar->price=$finallPrice;
                     $cartcar->deliveryplace=$data->deliveryplace;
                     $cartcar->customrname=$data->customrname;
                     $cartcar->date=$data->date;
                     $cartcar->receivingplace=$data->receivingplace;
                     $cartcar->numberdays=$data->numberdays;
                     $cartcar->number=$data->number;
                     return view('cars.detail',compact('cartcar'));
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
                $dis =  ($discount[0]->rate * $car->price) / 100;  // dis
                $price = $car->price *  $data->numberdays;    //before dis
                $finallPrice = $price - $dis;  // after dis
            } else {
                $dis = 0;
                $price = $car->price;
                $finallPrice = $car->price;
            }
            $newreservation=new ReservationCar;
            $newreservation->user_id=1;
            $newreservation->car_id=$id;
            $newreservation->price=$finallPrice;
            $newreservation->Num='DE0001';
            $newreservation->deliveryplace=$data->deliveryplace;
            $newreservation->customrname=$data->customrname;
            $newreservation->receivingplace=$data->receivingplace;
            $newreservation->date=$data->date;
            $newreservation->numberdays=$data->numberdays;
            $newreservation->number=$data->number;
            $newreservation->status='pending';
            $newreservation->save();
            return response()->json(['msg' => 'تم حفظ بيانتك بنجاح',], 200);

        }
        else
        {
            return response()->json(['msg' => ' حدث هناك خطأ يرجى إعادة محاولة لاحقا '], 500);
        }
    }

    public function getallorders()
    {
        $allorders=ReservationCar::get();
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
       if($order)
       {
          $update=$order->update([
              'Note' => $data->note,
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
        $cars = DB::table('cars')
        ->join('companies', 'cars.company_id', '=', 'companies.id')
        ->select('cars.*', 'companies.name as company')
        ->get();
        foreach ($cars as $car) {
            $car->image = url('/') . '/assets/admin/img/cars/' . $car->image;
        }
        return response()->json(['cars' => $cars], 200);
    }
}
