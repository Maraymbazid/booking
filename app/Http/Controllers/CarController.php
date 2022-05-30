<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function userIndex()
    {
        $cars = DB::table('cars')
            ->join('companies', 'cars.company_id', '=', 'companies.id')
            ->select('cars.*', 'companies.name as company')
            ->get();
        foreach ($cars as $t) {
            $t->image = url('/') . '/assets/admin/img/cars/' . $t->image;
        }
        return view('cars.cars')->with('cars', $cars);
    }
}
