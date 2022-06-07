<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Admin\Room;
use App\Models\HotelOrder;
use App\Models\RoomDiscount;
use Illuminate\Http\Request;

class HotelOrderController extends Controller
{
    public function order(Request $request, $hotelId)
    {
        $room =   Room::find($request->roomId);
        $hotel =  Hotel::find($hotelId);
        $discount = RoomDiscount::where('room_id', $request->roomId)
            ->where('day_count', '<=', $request->daycount)->orderby('day_count', 'DESC')->get();
        if ($discount->count() < 0) {
            $dis =  ($discount[0]->discount * $room->price) / 100;  // dis
            $price = $room->price *  $request->daycount;    //before dis
            $finallPrice = $price - $dis;  // after dis
        } else {
            $dis = 0;
            $price = $room->price;
            $finallPrice = $room->price;
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
        $order->price = $finallPrice;
        $order->oneday = $room->price;
        $order->discount = $dis;
        $order->status = 0;

        // $order->total = $request->total;
        return view('hotels.invoke', compact('order'));
    }


    public function store(Request $request, $hotelId, $roomId)
    {
        $room =   Room::find($roomId);
        $hotel =  Hotel::find($hotelId);
        $discount = RoomDiscount::where('room_id', $request->roomId)
            ->where('day_count', '<=', $request->daycount)->orderby('day_count', 'DESC')->get();
        if ($discount->count() < 0) {
            $dis =  ($discount[0]->discount * $room->price) / 100;  // dis
            $price = $room->price *  $request->daycount;    //before dis
            $finallPrice = $price - $dis;  // after dis

        } else {
            $dis = 0;
            $price = $room->price;
            $finallPrice = $room->price;
        }

        $order = new HotelOrder();
        $order->hotel_id = $hotelId;
        $order->room_id = $roomId;
        $order->name = $request->name;
        $order->whatsapp = $request->whatsapp;
        $order->daycount = $request->daycount;
        $order->arrival = $request->arrival;
        $order->checkout = $request->checkout;
        $order->price = $finallPrice;
        $order->discount = $dis;
        $order->status = 0;
        $order->total = $request->total;
        return view('hotels.invoke', compact('order'));
    }
}
