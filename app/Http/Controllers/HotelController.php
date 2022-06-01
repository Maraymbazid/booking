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

        // dd($data->all());
        // $count =  count($data->subserv);
        // for ($i = 0; $i < $count; $i++) {
        //     DB::table('services_hotel')->insert([
        //         'hotel_id' =>   1,
        //         'sub_id'    => $data->subserv[$i]['service_id']
        //     ]);
        // }

        // $request = $data->except('_token', 'image','services','page');
        // $request['image'] = $imageName;
        // $stored = DB::table('hotels')->insertGetId($request);
        $imageName = $this->uploadMedia($data->image, 'Hotels');
        $cover = $this->uploadMedia($data->cover, 'Hotels/cover');

        $hotel = new Hotel();
        $hotel->name_ar = $data->name_ar;
        $hotel->description_ar = $data->description_ar;
        $hotel->status = $data->status;
        $hotel->gouvernement = $data->gouvernement;
        $hotel->sort = $data->sort;
        $hotel->location = $data->location;
        $hotel->title = $data->title;
        $hotel->image = $imageName;
        $hotel->cover = $cover;
        $hotel->save();
        $subServices = json_decode($data->subserv);
        $count =  count($subServices);
        for ($i = 0; $i < $count; $i++) {
            // return response()->json(['test' => $subservices[$i]->service_id]);
            DB::table('services_hotel')->insert([
                'hotel_id' =>   $hotel->id,
                'sub_id'    => $subServices[$i]->service_id
            ]);
        }


        if ($hotel) {
            // $hotel = Hotel::find($stored);
            // $hotel->services()->attach($data->services);
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


    public function edit($id)
    {
        $allgouvernements = Gouvernement::select('id', 'name')->get();
        $hotel = DB::table('hotels')->where('id', $id)->first();
        $arr = [];
        array_push($arr, $hotel);
        if ($hotel) {
            return view('admin.hotels.edit')->with('arr', json_encode($arr))->with('allgouvernements', $allgouvernements);
        } else {
            return redirect()->back();
        }
    }


    public function update(Request $data)
    {

        $result = $data->except('page', 'image', 'cover', 'hotelId', '_token', '_method');
        if ($data->has('image')) {
            $oldImage = DB::table('hotels')->select('image')->where('id', $data->hotelId)->first()->image;
            $this->deleteMedia($oldImage, 'Hotels');
            $imageName = $this->uploadMedia($data->image, 'Hotels');
            $result['image'] = $imageName;
        }
        if ($data->has('cover')) {
            $oldcoverName = DB::table('hotels')->select('cover')->where('id', $data->hotelId)->first()->cover;
            $this->deleteMedia($oldcoverName, 'Hotels');
            $coverName = $this->uploadMedia($data->cover, 'Hotels');
            $result['cover'] = $coverName;
        }
        $update = DB::table('hotels')->where('id', $data->hotelId)->update($result);
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
    }

    public function userIndex()
    {
        $hotels = DB::table('hotels')->get();
        foreach ($hotels as $t) {
            $t->image = url('/') . '/assets/admin/img/hotels/' . $t->image;
        }
        return view('hotels.hotels')->with('hotels', $hotels);
    }
}
