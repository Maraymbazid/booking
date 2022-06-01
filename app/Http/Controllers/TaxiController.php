<?php

namespace App\Http\Controllers;

use App\Models\Taxi;
use App\Http\traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxiController extends Controller
{
    use media;


    public function create()
    {
        return view('admin.taxi.create');
    }

    public function store(Request $request)
    {
        $imageName = $this->uploadMedia($request->image, 'taxi');
        $taxi = new Taxi();
        $taxi->name = $request->name;
        $taxi->image = $imageName;
        $taxi->company_id = $request->company_id;
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
        $taxis = DB::table('taxis')
            ->join('companies', 'taxis.company_id', '=', 'companies.id')
            ->select('taxis.*', 'companies.name as company')
            ->get();
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
        $tax = DB::table('taxis')->where('id', $id)->first();
        $tax->image = url('/') . '/assets/admin/img/taxi/' . $tax->image;
        return view('taxi.taxform')->with('tax',  $tax);
    }
}
