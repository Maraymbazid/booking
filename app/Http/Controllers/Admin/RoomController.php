<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hotel;
use App\Models\Image;
use App\Http\Traits\media;
use App\Models\Admin\Room;
use Illuminate\Http\Request;
use App\Models\Admin\PivotOne;
use App\Models\Admin\ServiceRoom;
use App\Models\Admin\NameServices;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rooms\StoreRoom;
use App\Http\Requests\Rooms\UpdateRoom;

class RoomController extends Controller
{
    use media;
    public function index()
    {
        $allrooms=Room::get();
        return view('admin.rooms.index',compact('allrooms'));
    }
    public function create()
    {
        $services = ServiceRoom::get();
        $NamesServices=NameServices::get();
        $hotels = Hotel::get();
        return view('admin.rooms.create',compact('services','hotels','NamesServices'));
    }
    public function store(StoreRoom $data)
    {


        $request = $data->except('_token', 'images', 'services', 'page');
        $stored = new Room();
        $stored->name_ar =  $data->name_ar;
        $stored->adults = $data->adults;
        $stored->children = $data->children;
        $stored->hotel_id = $data->hotel_id;
        $stored->area = $data->area;
        $stored->price = $data->price;
        $stored->beds = $data->beds;
        $stored->internet = $data->internet;
        $stored->save();


        if ($stored)
         {
            $stored->services()->attach($data->services);
            for ($x = 0; $x <= count($data->images) - 1; $x++) {
                $imageName = $this->uploadManyMedia($data->images[$x], 'rooms', $x);
                Image::create(['name' =>  $imageName, 'room_id' => $stored->id]);
            }
         $status = 200;
         $msg  = 'تم حفظ الداتا بنجاح ';
        } else
        {
            $status = 500;
            $msg  = ' تعذر الحفظ هناك خطأ ما';
         }
         return response()->json
        ([
            'status' => $status,
            'msg' => $msg,
        ]);
    }
    public function delete(Request $request)
    {
        $room = Room::find($request->id);
            if($room)
            {
                $room->services()->detach();
                $room->delete();
                return response()->json
                ([
                    //'status' => true,
                    'msg'  => 'تم حفظ الداتا بنجاح ',
                    'id'=>$request->id,
                ],200);
        } else
            {
                return response()->json
                ([
                    //'status' => false,
                     'msg'  => ' تعذر الحذف هناك خطأ ما ',
                ],500);
            }

    }
    public function edit($id)
    {
        try
        {
            $room = Room::find($id);  // search in given table id only
        if (!$room)
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('allrooms');
            }
            $room = Room::select()->find($id);
            $services = ServiceRoom::get();
            $NamesServices=NameServices::get();
            $servicesids=PivotOne::select()->get();
            $hotels = Hotel::get();
           return view('admin.rooms.edit', compact('room','services','NamesServices','hotels','servicesids'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('allrooms');
        }

    }
    public function update(UpdateRoom $data)
    {
       $room=Room::find($data->id);
       if($room)
       {
        $result = $data->except('page', 'image', '_token','services','id');
        if ($data->has('image'))
         {
            $oldImage = DB::table('rooms')->select('image')->where('id', $data->id)->first()->image;
            $this->deleteMedia($oldImage, 'rooms');
            $imageName = $this->uploadMedia($data->image, 'rooms');
            $result['image'] = $imageName;
        }
        $update = $room->update($result);
        $room->services()->sync($data->services);
            if ($update)
        {
            $status = 200;
            $msg  = 'تم تعديل الداتا بنجاح ';

        }
        } else
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
    // public function test()
    // {
    //     $room=Hotel::find(28);
    //     return $room->rooms->name_ar;
    // }

}
