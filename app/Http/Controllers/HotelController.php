<?php

namespace App\Http\Controllers;
use App\Models\Hotel;
use App\Http\Traits\media;
use App\Models\Admin\Room;
use App\Models\HotelImage;
use App\Models\HotelOrder;
use App\Models\RoomDiscount;
use Illuminate\Http\Request;
use App\Models\Admin\Service;
use App\Models\MainServicesHotel;
use App\Models\Admin\Gouvernement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
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
        $hotels = Hotel::get();
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
        DB::beginTransaction();
        try {
            $imageName = $this->uploadMedia($data->image, 'Hotels');
            $hotel = new Hotel();
            $hotel->name_ar = $data->name_ar;
            $hotel->description_ar = $data->description_ar;
            $hotel->status = $data->status;
            $hotel->gouvernement = $data->gouvernement;
            $hotel->sort = $data->sort;
            $hotel->location = $data->location;
            $hotel->title = $data->title;
            $hotel->image = $imageName;
            $hotel->save();
            $subServices = json_decode($data->subserv);
            $count =  count($subServices);
            for ($i = 0; $i < $count; $i++) {
                DB::table('services_hotel')->insert([
                'hotel_id' =>   $hotel->id,
                'sub_id'    => $subServices[$i]->service_id
                ]);
            }
            for ($x = 0; $x <= count($data->covers) - 1; $x++) {
                $imageName1 = $this->uploadManyMedia($data->covers[$x], 'Hotels/covers', $x);
                HotelImage::create(['image' =>  $imageName1, 'hotel_id' => $hotel->id]);
            }
        } catch (\Exception $e) {
            Db::rollBack();
            return response()->json(['msg' => $e->getMessage()], 500);
        }
        DB::commit();

        if ($hotel) {
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

        $result = $data->except('page', 'image', 'covers', 'hotelId', '_token', '_method');
        if ($data->has('image')) {
            $oldImage = DB::table('hotels')->select('image')->where('id', $data->hotelId)->first()->image;
            // $this->deleteMedia($oldImage, 'hotels');
            $imageName = $this->uploadMedia($data->image, 'hotels');
            $result['image'] = $imageName;
        }
        if ($data->has('covers')) {
            $oldImages = DB::table('hotel_images')->where('hotel_id', $data->hotelId)->get();
            foreach ($oldImages as $old) {
                $this->deleteMedia($old->image, 'Hotels/covers');

                DB::table('hotel_images')->where('id', $old->id)->delete();
            }
            for ($x = 0; $x <= count($data->covers) - 1; $x++) {
                // $imageName = $this->uploadManyMedia($data->images[$x], 'hotels/covers', $x);
                $imageName1 = $this->uploadManyMedia($data->covers[$x], 'Hotels/covers', $x);
                HotelImage::create(['image' =>  $imageName1, 'hotel_id' => $data->hotelId]);
            }
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
        $delete = Hotel::find($id);
        $delete->rooms()->delete();
        $delete->delete();
        if ($delete) {
            alert()->success('deleted....', '  تم مسح الفندق بنجاح');
            return redirect()->route('Hotels');
        } else {
            alert()->error('Oops....', 'Something went wrong .. try again');
            return redirect()->route('Hotels');
        }
    }
    public function userIndex()
    {
        return view('hotels.hotels');
    }

    public function getAllHotelsForUser()
    {
        $hotels = DB::table('hotels')
            ->join('gouvernements', 'hotels.gouvernement', '=', 'gouvernements.id')
            ->select('hotels.*', 'gouvernements.name', 'gouvernements.id as govid')
            ->where('status', 1)
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
            ->where('status', 1)
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
  
    public function showroom($id)
    {
        $hotel = Hotel::with(['SubServices.MainSer' => function ($q) {
            // $q->groupBy('MainSer.main_service_id');
        }])->find($id);
        $rooms = $hotel->rooms;
    }
    public function afficherrooms($id)
    {
        $hotel=Hotel::find($id);
        if($hotel)
        {
            return view('admin.hotels.detailroom',compact('hotel'));
        }
        else
        {
            alert()->error('Oops....', 'this element does not exist .. try again');
            return redirect()->back();
        }
    }
}
