<?php

namespace App\Http\Controllers;


use App\Models\Hotel;
use App\Http\traits\media;
use Illuminate\Http\Request;
use App\Models\Admin\Gouvernement;
use App\Models\Admin\Service;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateHotelRequest;

class HotelController extends Controller
{
    use media;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = DB::table('hotels')->get();
        return view('admin.hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allgouvernements = Gouvernement::select('id', 'name')->get();
        $allservices=Service::select('id','name')->get();
        return view('admin.hotels.create', compact('allgouvernements','allservices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHotelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        $imageName = $this->uploadMedia($data->image, 'Hotels');
        $request = $data->except('_token', 'image','services','page');
        $request['image'] = $imageName;
        $stored = DB::table('hotels')->insertGetId($request);
        if ($stored) {
            $hotel = Hotel::find($stored);
            $hotel->services()->attach($data->services);
            $status = 200;
            $msg  = 'تم حفظ الداتا بنجاح ';
        } else {
            $status = 500;
            $msg  = ' تعذر الحفظ هناك خطأ ما       ';
        }
        return response()->json([
            'status' => $status,
            'msg' => $msg,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allgouvernements = Gouvernement::select('id', 'name')->get();
        $hotel = DB::table('hotels')->where('id', $id)->first();
        if ($hotel) {
            return view('admin.hotels.edit', compact('hotel', 'allgouvernements'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHotelRequest  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id)
    {

        $result = $data->except('page', 'image', '_token', '_method');
        if ($data->has('image')) {
            $oldImage = DB::table('hotels')->select('image')->where('id', $id)->first()->image;
            $this->deleteMedia($oldImage, 'Hotels');
            $imageName = $this->uploadMedia($data->image, 'Hotels');
            $result['image'] = $imageName;
        }
        $update = DB::table('hotels')->where('id', $id)->update($result);
        if ($update) {
            alert()->success('Updated....', '  تم تعديل بينانات الفندق بنجاح');
            return redirect()->route('Hotels');
        } else {
            alert()->error('Oops....', 'Something went wrong .. try again');
            return redirect()->route('Hotels');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('hotels')->where('id', $id)->delete();
        if ($delete) {
            alert()->success('deleted....', '  تم مسح الفندق بنجاح');
            return redirect()->route('Hotels');
        } else {
            alert()->error('Oops....', 'Something went wrong .. try again');
            return redirect()->route('Hotels');
        }
    }
    public function test()
    {
        $hotel = Hotel::find(7);
        $hotel->services()->attach(12);
       // return $hotel->services;

    }
}
