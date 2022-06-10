<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Admin\Room;
use App\Models\HotelOrder;
use App\Models\RoomDiscount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HotelOrderController extends Controller
{

    public function adminIndex()
    {
       $orders = DB::table('hotel_orders')
            ->join('rooms', 'hotel_orders.room_id', 'rooms.id')
            ->join('hotels', 'hotel_orders.hotel_id', 'hotels.id')
            ->join('users', 'hotel_orders.user_id', 'users.id')
            ->select('hotel_orders.*', 'rooms.name_ar as room_name', 'rooms.id', 'hotels.name_ar as hotel_name', 'hotels.id', 'users.name as user_name', 'users.id')
            ->orderby('hotel_orders.id', 'DESC')->get();
        // return $orders;
        return view('admin.hotels.orders', compact('orders'));
    }
    public function userOrder()
    {
        $orders = DB::table('hotel_orders')
            ->join('rooms', 'hotel_orders.room_id', 'rooms.id')
            ->join('hotels', 'hotel_orders.hotel_id', 'hotels.id')
            ->join('users', 'hotel_orders.user_id', 'users.id')
            ->select('hotel_orders.*', 'rooms.name_ar as room_name', 'rooms.id', 'hotels.name_ar as hotel_name', 'hotels.id', 'users.name as user_name', 'users.id')
            ->where('hotel_orders.user_id',  '=', Auth::user()->id)
            ->orderby('hotel_orders.id', 'DESC')->get();
        return view('orders.index', compact('orders'));
    }
    public function order(Request $request, $hotelId)
    {
        $room =   Room::find($request->roomId);
        $hotel =  Hotel::find($hotelId);
        $discount = RoomDiscount::where('room_id', $request->roomId)
            ->where('day_count', '<=', $request->daycount)->orderby('day_count', 'DESC')->get();

        if ($discount->count() > 0) {
            $price = $room->price *  $request->daycount;    //before dis
            $dis =  ($discount[0]->discount * $price) / 100;  // dis
            $finallPrice = $price - $dis;  // after dis
        } else {
            $price = $room->price *  $request->daycount;
            $dis = 0;
            $finallPrice = $price;
        }
        $order = new HotelOrder();
        $order->hotel_id = $hotelId;
        $order->room_id = $request->roomId;
        $order->room_name = $room->name_ar;
        $order->hotel_name = $hotel->name_ar;
        $order->name = $request->name;
        $order->whatsapp = $request->whtsapp;
        $order->daycount = $request->daycount;
        $order->arrival = $request->arrival;
        $order->checkout = $request->checkout;
        $order->price1 = $price;
        $order->price2 = $finallPrice;
        $order->oneday = $room->price;
        $order->discount = $dis;
        $order->status = 0;
        // $username = ' احمد ';
        // $msg =  "لقد قام " . $request->name  . "بطلب غرفة   " . $room->name_ar . " التابعة لفندق " .  $hotel->name_ar;
        // $msg .= " ورقم الواتساب الخاص به " . $request->whtsapp . " وحجز  " .  $request->daycount . "يوم ";
        // $msg .= " وتاريخ وصوله " . $request->arrival . " والتكلفه الاجماليه " . $finallPrice .  "$ بعد خصم مقداره " . $dis . "$";
        // $msg .= "وهذا الطلب تم تنفيذه من حساب " . $username . " وتم تسجيل الطلب بنجاح ";
        // $res = Http::timeout(15)->get('https://api.telegram.org/bot5418440137:AAGUCn9yFMZWFNyf-o075nr5aL-Qu6nmvns/sendMessage?chat_id=@adawe23&text=' . $msg);
        return view('hotels.invoke', compact('order'));
    }


    public function store(Request $request, $hotelId, $roomId)
    {
        $room =   Room::find($roomId);
        $hotel =  Hotel::find($hotelId);
        $discount = RoomDiscount::where('room_id', $request->roomId)
            ->where('day_count', '<=', $request->daycount)->orderby('day_count', 'DESC')->get();
        if ($discount->count() > 0) {
            $price = $room->price *  $request->daycount;    //before dis
            $dis =  ($discount[0]->discount * $price) / 100;  // dis
            $finallPrice = $price - $dis;  // after dis
        } else {
            $price = $room->price *  $request->daycount;
            $dis = 0;
            $finallPrice = $price;
        }
        $order = new HotelOrder();
        $order->hotel_id    = $hotelId;
        $order->room_id     = $roomId;
        $order->name        = $request->name;
        $order->whatsapp    = $request->whatsapp;
        $order->daycount    = $request->daycount;
        $order->arrival     = $request->arrival;
        $order->checkout    = $request->checkout;
        $order->price       = $price;
        $order->total       = $finallPrice;
        $order->discount    = $dis;
        $order->status      = 0;
        $order->note        = '';
        $order->user_id    =  Auth::user()->id;
        $order->save();


        $msg =  "لقد قام " . '  ' .  $request->name  . '  ' . "بطلب غرفة   " . '  ' . $room->name_ar . '  ' . " التابعة لفندق " . '  ' . $hotel->name_ar;
        $msg .= " ورقم الواتساب الخاص به " . '  ' . $request->whatsapp . '  ' . " وحجز  " . '  ' . $request->daycount . "يوم ";

        $msg .= " وتاريخ وصوله " . $request->arrival . "  والتكلفه الاجماليه قبل الخصم" . $price . "$" . "والتكلفه الاجماليه بعد الخصم " . $finallPrice .  "$ بعد خصم مقداره " . $dis . "$";
        $msg .= "وهذا الطلب تم تنفيذه من حساب " .  Auth::user()->name . " وتم تسجيل الطلب بنجاح ";
        $res = Http::timeout(15)->get('https://api.telegram.org/bot5418440137:AAGUCn9yFMZWFNyf-o075nr5aL-Qu6nmvns/sendMessage?chat_id=@adawe23&text=' . $msg);


        return redirect()->route('userIndexhotel')->with(['status' => 'تم ارسال الطلب بنجاح ']);

    }

    public function editorderhotel($id)
    {
        $order=HotelOrder::find($id);
        if($order)
        {
            return view('admin.hotels.editorder',compact('order'));
        }
        else
        {
            alert()->error('Oops....','this element does not exist .. try again');
            return redirect() ->back();
        }
    }
    public function updateorderhotel(Request $data)
    {
        $id=$data->id;
        $order=$order=HotelOrder::find($id);
        if($order)
        {
           $update=$order->update([
               'note' => $data->note,
               'status'=> $data->status,
           ]);
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
}
