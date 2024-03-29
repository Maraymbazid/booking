<?php

namespace App\Http\Controllers\Admin;
use App\Http\Traits\media;
use App\Models\MeetingOrder;
use Illuminate\Http\Request;
use App\Models\MeetingDiscount;
use App\Models\Admin\Gouvernement;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\MeetingSalles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Admin\MeetingServices;
use App\Http\Requests\Meeting\StoreSalle;
use App\Http\Requests\Meeting\UpdateSalle;
use App\Models\Admin\ImagesMeeting;
use App\Models\Admin\OrderMeeting;
use Exception;
class MeetingSallesController extends Controller
{
    use media;
    public function create()
    {

        $allgouvernements=Gouvernement::select('id','name')->get();
        $allservices=MeetingServices::select('id','name')->get();
        return view('admin.meetings.create',compact('allgouvernements','allservices'));
    }
    public function  store(StoreSalle $data)
    {
        $imageName = $this->uploadMedia($data->image, 'salles');
        $request = $data->except('_token', 'image','services','page','images');
        $request['image'] = $imageName;
        $stored = DB::table('meeting_rooms')->insertGetId($request);
        if ($stored)
        {
            $salle = MeetingSalles::find($stored);
            $salle->services()->attach($data->services);
            for ($x = 0; $x <= count($data->images) - 1; $x++) {
                $imageName = $this->uploadManyMedia($data->images[$x], 'salles/covers/', $x);
                ImagesMeeting::create(['image' =>  $imageName, 'meeting_id' =>$stored]);
            }
            $status = 200;
            $msg  = 'تم حفظ الداتا بنجاح ';
        }
        else
        {
            $status = 500;
            $msg  = 'تعذر الحفظ هناك خطأ ما';
        }
        return response()->json([
            'status' => $status,
            'msg' => $msg
        ]);

    }
    public function index()
    {
        $allmeetingrooms=MeetingSalles::paginate(8);
        return view('admin.meetings.index',compact('allmeetingrooms'));
    }
    public function delete(Request $request)
    {
        $salle=MeetingSalles::find($request->id);
        if($salle)
        {
            $salle->delete();
            return response()->json
            ([
                'msg'  => 'تم حذف الداتا بنجاح ',
                'id'=>$request->id,
            ],200);
        }
       else
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
            $salle = MeetingSalles::find($id);  // search in given table id only
        if (!$salle)
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('adminHome');
            }
            $salle = MeetingSalles::select()->find($id);
            $allservices=MeetingServices::select()->get();
            $ownservices=$salle->services;
            $allgouvernements=Gouvernement::select('id','name')->get();
           return view('admin.meetings.edit', compact('salle','allgouvernements','allservices','ownservices'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('adminHome');
        }

    }
    public function update(UpdateSalle $data)
    {
        $salle=MeetingSalles::find($data->id);
        if ($salle)
         {
            $id=$data->id;
            $result = $data->except('page', 'image', '_token', '_method','id','services','images');
            if ($data->has('image')) {
                $oldImage = DB::table('meeting_rooms')->select('image')->where('id', $id)->first()->image;
                $this->deleteMedia($oldImage, 'salles');
                $imageName = $this->uploadMedia($data->image, 'salles');
                $result['image'] = $imageName;
            }
            if ($data->has('images'))
            {
                   $oldImages =  $salle->images;
                   foreach ($oldImages as $old) {
                       $this->deleteMedia($old->image, 'salles/covers/');
                       DB::table('imagesmeetings')->where('id', $old->id)->delete();
                   }
                   for ($x = 0; $x <= count($data->images) - 1; $x++) {
                    $imageName = $this->uploadManyMedia($data->images[$x], 'salles/covers/', $x);
                    ImagesMeeting::create(['image' =>  $imageName, 'meeting_id' =>$salle->id]);
                   }
           }
            $update = $salle->update($result);
            $salle->services()->sync($data->services);
            if ($update)
            {

                $status = 200;
                $msg  = 'تم تعديل الداتا بنجاح ';

            }
            else
            {
                $status = 500;
                $msg  = ' تعذر التعديل هناك خطأ ما';
            }
        }
        else
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

    public function meetingApi()
    {
        $MeetingRooms = MeetingSalles::get();
        foreach ($MeetingRooms as $t) {
            $t->image = url('/') . '/assets/admin/img/salles/' . $t->image;
        }
        return response()->json(['MeetingRooms' => $MeetingRooms], 200);
    }
    public function userindex()
    {
        return view('meeting.meetingroom');
    }
    public function oneMeetingRoom($id)
    {
        try {
            $salle = MeetingSalles::find($id);  // search in given table id only
            if (!$salle) {
                alert()->error('Oops....', 'this element does not exist .. try again');
                return redirect()->route('meetinguserindex');
            }
            $salle = MeetingSalles::select()->find($id);
            $salle->image = url('/') . '/assets/admin/img/salles/' . $salle->image;
            // return  $salle->services;
            return view('meeting.onemeetingroom', compact('salle'));
        } catch (Exception $ex) {
            alert()->error('Oops....', 'Something went wrong .. try again');
            return redirect()->route('meetinguserindex');
        }
    }

    public function checkOrder(Request $request)
    {
        // dd($request);
        $id = $request->id;
        $id = (int)$id;
        if (is_integer($id)) {
            $room = MeetingSalles::find($id);
            if ($room) {
                if ($request->numberdays !== null) {
                    $discount = MeetingDiscount::where('salle_id', $id)
                        ->where('hour_count', '<=', $request->numberdays)->orderby('hour_count', 'DESC')->get();
                    if ($discount->count() > 0) {
                        $mainPrice = $room->price;
                        $price = $room->price *  $request->hours;    //before dis
                        $dis =  ($discount[0]->hour_count * $price) / 100;  // dis    %
                        $finallPrice = $price - $dis;  // after dis
                    } else {
                        $dis = 0;
                        $mainPrice = $room->price;
                        $price = $room->price *  $request->hours;
                        $finallPrice = $room->price *  $request->hours;
                    }
                } else {
                    $dis = 0;
                    $mainPrice = $room->price;
                    $price = $room->price *  $request->hours;
                    $finallPrice = $room->price *  $request->hours;
                }
                $cart = new \stdClass();
                $cart->mainPrice = $mainPrice;     //main price in day
                $cart->beforeDis = $price;          // price before dis
                $cart->discount  = $dis;          //  dis
                $cart->price = $finallPrice;          // price after dis
                $cart->room_id = $room->id;           //car_id
                $cart->meetingName = $room->name_ar;
                $cart->date = $request->date;
                $cart->start_time = $request->start_time;
                $cart->hours = $request->hours;
                $cart->end_time = $request->end_time;
                $cart->numberDays = $request->numberdays;
                $cart->number = $request->number;
                $cart->persones = $request->persones;
                $cart->customerName = $request->customername;
                return view('meeting.detail', compact('cart'));
            } else {
                alert()->error('Oops....', 'this element does not exist .. try again');
                return redirect()->back();
            }
        } else {
            alert()->error('Oops....', 'this element does not exist .. try again');
            return redirect()->back();
        }
    }
    public function saveOrder(Request $request)
    {

        $id = $request->id;
        $id = (int)$id;
        if (is_integer($id)) {
            $room = MeetingSalles::find($id);

            if ($room) {
                if ($request->numberdays !== null) {
                    $discount = MeetingDiscount::where('salle_id', $id)
                        ->where('hour_count', '<=', $request->numberdays)->orderby('hour_count', 'DESC')->get();
                    if ($discount->count() > 0) {
                        $mainPrice = $room->price;
                        $price = $room->price *  $request->hours;    //before dis
                        $dis =  ($discount[0]->hour_count * $price) / 100;  // dis    %
                        $finallPrice = $price - $dis;  // after dis
                    } else {
                        $dis = 0;
                        $mainPrice = $room->price;
                        $price = $room->price *  $request->hours;
                        $finallPrice = $room->price *  $request->hours;
                    }
                } else {
                    $dis = 0;
                    $mainPrice = $room->price;
                    $price = $room->price *  $request->hours;
                    $finallPrice = $room->price *  $request->hours;
                }
                $cart = new MeetingOrder();
                $cart->order_number = 'M' . Auth::user()->id . time();
                $cart->meeting_id   = $room->id;           //meet_id
                $cart->meeting_name   = $room->name_ar;
                $cart->user_id      =  Auth::user()->id;
                $cart->date = $request->date;
                $cart->start_time = $request->start_time;
                $cart->hours = $request->hours;
                $cart->end_time = $request->end_time;
                $cart->numberdays = $request->numberdays;
                $cart->number = $request->number;
                $cart->persones = $request->persones;
                $cart->customername = $request->customername;
                $cart->main_price = $mainPrice;     //main price in day
                $cart->pricebefore = $price;          // price before dis
                $cart->discount  = $dis;          //  dis
                $cart->finallPrice = $finallPrice;          // price after dis
                $cart->status = 1;
                $cart->note      = '';
                $cart->save();
                $msg =  "لقد قام " . '  ' .  $request->customername  . '  ' . " بطلب حجز قاعة اجتماعات     " . '  ' . $room->name  . " ";
                $msg .= " ورقم الواتساب الخاص به " . '  ' . $request->number . '  ';
                if ($request->numberdays !== null) {
                    $msg .= " وحجز  " . '  ' . $request->numberdays . "  يوم ";
                }
                $msg .= " وحجز  " . '  ' . $request->hours . "  ساعه فى اليوم  ";
                $msg .= " وتاريخ الحجز " . '  ' . $request->date . '  ' . " من الساعه   " . '  ' . $request->start_time . "  الي الساعة  "  . '  ' . $request->end_time;
                $msg .= " وعدد الافراد " .  $request->persones;
                $msg .= "   والتكلفه الاجماليه قبل الخصم   " . $price . "$" . "  والتكلفه الاجماليه بعد الخصم " . $finallPrice .  "$ بعد خصم مقداره " . $dis . "$";
                $msg .= "وهذا الطلب تم تنفيذه من حساب " .  Auth::user()->name . "  وتم تسجيل الطلب بنجاح والرقم المرجعي للطلب " . " " . $cart->order_number;
                $res = Http::timeout(15)->get('https://api.telegram.org/bot5418440137:AAGUCn9yFMZWFNyf-o075nr5aL-Qu6nmvns/sendMessage?chat_id=@adawe23&text=' . $msg);
                return redirect()->route('userMeetOrder');
            } else {
                alert()->error('Oops....', 'this element does not exist .. try again');
                return redirect()->back();
            }
        } else {
            alert()->error('Oops....', 'this element does not exist .. try again');
            return redirect()->back();
        }
    }
    public function getallorders()
    {
        $allorders=OrderMeeting::orderBy('created_at', 'desc')->paginate(8);
        return view('admin.ordermeetings.index',compact('allorders'));
    }
    public function editordersalle($id)
    {
        $salle = OrderMeeting::find($id);
        if ($salle) {
            return view('admin.ordermeetings.edit', compact('salle'));
        } else {
            alert()->error('Oops....', 'this element does not exist .. try again');
            return redirect()->back();
        }
    }
    public function updateordersalles(Request $data)
    {
        $id = $data->id;
        $order=OrderMeeting::find($id);
        if($data->status!= 1 && $data->status!= 2 && $data->status!= 3 && $data->status!= 4)
        {
            return response()->json([
                'status' => 500,
                'msg' =>' تعذر التعديل هناك خطأ ما'
            ]);
        }
        if ($order)
        {
            $update = $order->update([
                'note' => $data->note,
                'status' => $data->status,
            ]);
            if ($update) {

                $status = 200;
                $msg  = 'تم تعديل الداتا بنجاح ';
            } else {
                $status = 500;
                $msg  = ' تعذر التعديل هناك خطأ ما';
            }
        }
        else
         {
            $status = 500;
            $msg  = ' تعذر التعديل هناك خطأ ما';
        }
        return response()->json([
                'status' => $status,
                'msg' => $msg,
            ]);
    }
    public function deleteordersalle(Request $request)
    {
        $ordersalle = OrderMeeting::find($request->id);
        if ($ordersalle)
         {
            $ordersalle->delete();
            return response()->json([
                    'msg'  => 'تم حذف الداتا بنجاح ',
                    'id' => $request->id,
                ], 200);
        } else
         {
            return response()->json([
                    'msg'  => ' تعذر الحذف هناك خطأ ما ',
                ], 500);
        }
    }
    public function showdetailsalles($id)
    {
        $order = OrderMeeting::find($id);
        if ($order)
         {
            return view('admin.ordermeetings.detail', compact('order'));
        } else
        {
            alert()->error('Oops....', 'this element does not exist .. try again');
            return redirect()->back();
        }
    }
}
