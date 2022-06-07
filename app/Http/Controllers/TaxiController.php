<?php

namespace App\Http\Controllers;

use App\Models\Taxi;
use App\Http\traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ReservationTaxi;
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
       // $taxi->company_id = $request->company_id;
        $taxi->price  = $request->price;
        $taxi->model  = $request->model;
        $taxi->save();
        return response()->json(['msg' => ' taxi created'], 200);
    }

    public function index()
    {
        $taxis = DB::table('taxis')
            ->join('companies', 'taxis.company_id', '=', 'companies.id')
            ->select('taxis.*', 'companies.name as company')
            ->get();
        return view('admin.taxi.index')->with('taxis', $taxis);
    }

    public function userIndex()
    {
        $taxis =Taxi::get();
        foreach ($taxis as $t) {
            $t->image = url('/') . '/assets/admin/img/taxi/' . $t->image;
        }
        return view('taxi.taxi')->with('taxis', $taxis);
    }

    public function edit($id)
    {
        $tax = DB::table('taxis')->where('id', $id)->first();
        $arr = [];
        array_push($arr, $tax);
        if ($tax) {
            return view('admin.taxi.edit')->with('arr', json_encode($arr));
        } else {
            return redirect()->back();
        }
    }
    public function update(Request $data)
    {
        // dd($data);
        $result = $data->except('page', 'image',  'taxId', '_token', '_method');
        if ($data->has('image')) {
            $oldImage = DB::table('taxis')->select('image')->where('id', $data->taxId)->first()->image;
            $this->deleteMedia($oldImage, 'taxi');
            $imageName = $this->uploadMedia($data->image, 'taxi');
            $result['image'] = $imageName;
        }
        $update = DB::table('taxis')->where('id', $data->taxId)->update($result);
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

    public function oneTaxi($id)
    {
        $id=(int)$id;
        if(is_integer($id))
        {
            $taxi=Taxi::find($id);
            if($taxi)
            {
                if(!empty($taxi->company_id))
                  {
                    $taxi = DB::table('taxis')
                    ->join('companies', 'taxis.company_id', '=', 'companies.id')
                    ->select('taxis.*', 'companies.name as company')
                    ->where('taxis.id', $id)->first();
                    $taxi->image = url('/') . '/assets/admin/img/taxi/' . $taxi->image;
                    return view('taxi.taxform')->with('tax',  $taxi);
                  }
                  else
                  {
                     $taxi->image = url('/') . '/assets/admin/img/taxi/' . $taxi->image;
                     return view('taxi.taxform')->with('tax',  $taxi);
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
    public function checkorder(Request $data)
    {
        $id=$data->id;
        $id = (int)$id;
        if(is_integer($id))
        {
            $taxi=Taxi::find($id);
            if($taxi)
            {
                     $image=$this->uploadMedia($data->ticket, 'taxi/tickets');
                     $carttaxi =  new \stdClass();
                     $carttaxi->user_id=1;
                     $carttaxi->taxi_id=$id;
                     $carttaxi->taxi_name=$taxi->name;
                     $carttaxi->price=$taxi->price;
                     $carttaxi->model=$taxi->model;
                     $carttaxi->phone=$data->phone;
                     $carttaxi->deliveryplace=$data->deliveryplace;
                     $carttaxi->nationality=$data->nationality;
                     $carttaxi->datearrive=$data->datearrive;
                     $carttaxi->destination=$data->destination;
                $carttaxi->chauffeur = $data->chauffeur;
                $carttaxi->ticket = $image;
                return view('taxi.detail', compact('carttaxi'));

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
    public function confirmorder(Request $data, $taxId)
    {
        $id = (int)$taxId;
        $cart=Taxi::find($id);
        if($cart)
        {
            $newreservation=new ReservationTaxi;
            $newreservation->user_id=1;
            $newreservation->taxi_id=$id;
            $newreservation->Num='DE0001';
            $newreservation->price=60;
            $newreservation->deliveryplace=$data->deliveryplace;
            $newreservation->nationality=$data->nationality;
            $newreservation->datearrive=$data->datearrive;
            $newreservation->destination=$data->destination;
            $newreservation->chauffeur = $data->chauffeur;
            $newreservation->status = 0;
            $newreservation->ticket=$data->ticket;
            $newreservation->save();

            return redirect()->route('userIndexTax')->with(['status', 'تم ارسال الطلب بنجاح ']);
        }
        else
        {
            return response()->json(['msg' => ' حدث هناك خطأ يرجى إعادة محاولة لاحقا '], 500);
        }
    }
   public function test()
   {
        return $this->image;
   }
}
