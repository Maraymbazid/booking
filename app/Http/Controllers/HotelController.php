<?php

namespace App\Http\Controllers;


use App\Models\Hotel;
use App\Http\Traits\media;
use App\Models\Admin\Room;
use App\Models\HotelOrder;
use App\Models\RoomDiscount;
use Illuminate\Http\Request;
use App\Models\Admin\Service;
use App\Models\MainServicesHotel;
use App\Models\Admin\Gouvernement;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateHotelRequest;
use Illuminate\Support\Facades\Crypt;
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
        $allservices = Service::select('id', 'name')->get();
        return view('admin.hotels.create', compact('allgouvernements', 'allservices'));
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
            // $this->deleteMedia($oldImage, 'hotels');
            $imageName = $this->uploadMedia($data->image, 'hotels');
            $result['image'] = $imageName;
        }
        if ($data->has('cover')) {
            $oldcoverName = DB::table('hotels')->select('cover')->where('id', $data->hotelId)->first()->cover;
            // $this->deleteMedia($oldcoverName, 'hotels/cover/');
            $coverName = $this->uploadMedia($data->cover, 'hotels/cover/');
            $result['cover'] = $coverName;
        }
        $update = DB::table('hotels')->where('id', $data->hotelId)->update($result);
        if ($update) {
            return response()->json([
                'status' => 'done',
                'msg' => 'done',
            ]);
        } else {
            return response()->json([
                'status' => 'done',
                'msg' => ' هناك خطأ ما من فضلك أعد تحميل الصفحة',
            ], 400);
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
    // public function test()
    // {
    //     $hotel = Hotel::find(7);
    //     $hotel->services()->attach(12);
    // }

    public function userIndex()
    {
        return view('hotels.hotels');
    }

    public function getAllHotelsForUser()
    {
        $hotels = DB::table('hotels')
            ->join('gouvernements', 'hotels.gouvernement', '=', 'gouvernements.id')
            ->select('hotels.*', 'gouvernements.name', 'gouvernements.id as govid')
            ->orderby('hotels.sort', 'DESC')->get();
        foreach ($hotels as $t) {
            $t->image = url('/') . '/assets/admin/img/Hotels/' . $t->image;
        }
        return response()->json(['hotels', $hotels], 200);
    }

    public function hotelsordered($govId)
    {
        // $hotels = DB::table('hotels')->where('gouvernement', $govId)->orderBy('sort', 'DESC')->get();
        $hotels = DB::table('hotels')
            ->join('gouvernements', 'hotels.gouvernement', '=', 'gouvernements.id')
            ->select('hotels.*', 'gouvernements.name', 'gouvernements.id as govid')
            ->where('hotels.gouvernement', $govId)
            ->orderby('hotels.sort', 'DESC')->get();
        foreach ($hotels as $t) {
            $t->image = url('/') . '/assets/admin/img/Hotels/' . $t->image;
        }
        return response()->json(['hotels', $hotels], 200);
    }
    public function hoteldetail($id)
    {
        try {
            $hotel = Hotel::find($id);  // search in given table id only
            if (!$hotel) {
                alert()->error('Oops....', 'this element does not exist .. try again');
                return redirect()->route('home1');
            }
            $hotel = Hotel::select()->find($id);
            return view('hotels.detail', compact('hotel'));
        } catch (Exception $ex) {
            alert()->error('Oops....', 'Something went wrong .. try again');
            return redirect()->route('home1');
        }
    }
    public function getRoomsByHotelId($id)
    {
        $hotel = Hotel::with(['SubServices.MainSer' => function ($q) {
            // $q->groupBy('MainSer.main_service_id');
        }])->find($id);
        $rooms = $hotel->rooms;
        $hotel->cover  = url('/') . '/assets/admin/img/Hotels/cover/' . $hotel->cover;

        foreach ($rooms as $t) {
            $t->services   = $t->services;
            $t->discount   = $t->Discount;
            $t->images      = $t->Images;
        }
        foreach ($rooms as $t) {
            foreach ($t->images as $s) {
                $s->name = url('/') . '/assets/admin/img/rooms/' . $s->name;
            }
        }
        $main_services = MainServicesHotel::all();
        return view('hotels.hotelroom', compact('hotel', 'rooms', 'main_services'));
    }
    public function test()
    {
        $encryptedValue = '$2y$10$64mlLfYlDA13qsh.UdD.2uhxgD/XB2.9IIEdGNkH78PvtKLNgd6NG';
 
        $secret = Crypter::encrypt('some text here'); 
    }
 

}
