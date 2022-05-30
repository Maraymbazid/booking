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
}
