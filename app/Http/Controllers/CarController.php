<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ReservationCar;
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

        return response()->json(['msg' => ' car created'], 200);
    }

    public function index()
    {
        $cars = DB::table('cars')
            ->join('companies', 'cars.company_id', '=', 'companies.id')
            ->select('cars.*', 'companies.name as company')
            ->get();

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
                'msg' => 'done',
            ]);
        } else {
            alert()->error('Oops....', 'Something went wrong .. try again');
            return redirect()->route('Hotels');
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
                if(!empty($car->company_id))
                  {
                    $car = DB::table('cars')
                    ->join('companies', 'cars.company_id', '=', 'companies.id')
                    ->select('cars.*', 'companies.name as company')
                    ->where('cars.id', $id)->first();
                    $car->image = url('/') . '/assets/admin/img/cars/' . $car->image;
                    return view('cars.carForm')->with('car',  $car);
                  }
                  else
                  {
                     $car->image = url('/') . '/assets/admin/img/cars/' . $car->image;
                      return view('cars.carForm')->with('car',  $car);
                  }
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
                     $cartcar = new \stdClass();
                     $cartcar->car_id=$car->id;
                     $cartcar->car_name=$car->name;
                     $cartcar->modal=$car->model;
                     $cartcar->price=$car->price;
                     $cartcar->deliveryplace=$data->deliveryplace;
                     $cartcar->nationality=$data->nationality;
                     $cartcar->date=$data->date;
                     $cartcar->receivingplace=$data->receivingplace;
                     $cartcar->chauffeur=$data->chauffeur; 
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
            $newreservation=new ReservationCar;
            $newreservation->user_id=1;
            $newreservation->car_id=$id;
            // you should handle discount 
            $newreservation->price=10;
            $newreservation->Num='DE0001';
            $newreservation->deliveryplace=$data->deliveryplace;
            $newreservation->nationality=$data->nationality;
            $newreservation->receivingplace=$data->receivingplace;
            $newreservation->date=$data->date;
            $newreservation->chauffeur=$data->chauffeur; 
            $newreservation->numberdays=$data->numberdays; 
            $newreservation->number=$data->number; 
            $newreservation->status=0;	
            $newreservation->save();
            return response()->json(['msg' => 'تم تأكيد حجزك'], 200);

        }
        else
        {
            return response()->json(['msg' => ' حدث هناك خطأ يرجى إعادة محاولة لاحقا '], 500);
        }
    }
   

}
