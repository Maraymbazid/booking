<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationCar;
use App\Models\ReservationTaxi;
use App\Models\ReservationVilla;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ReservationApartement;

class OrdersController extends Controller
{
    public function userHotelOrder()
    {
        $orders = DB::table('hotel_orders')
            ->join('rooms', 'hotel_orders.room_id', 'rooms.id')
            ->join('hotels', 'hotel_orders.hotel_id', 'hotels.id')
            ->join('users', 'hotel_orders.user_id', 'users.id')
            ->select('hotel_orders.*', 'rooms.name_ar as room_name', 'rooms.id as room_id', 'hotels.name_ar as hotel_name', 'hotels.id as hotel_id', 'users.name as user_name', 'users.id as user_id')
            ->where('hotel_orders.user_id',  '=', Auth::user()->id)
            ->orderby('hotel_orders.id', 'DESC')->paginate(6);

        return view('orders.index', compact('orders'));
    }
    public function userTaxiOrder()
    {
        $taxis = ReservationTaxi::where('user_id',  '=', Auth::user()->id)->paginate(6);
        return view('orders.indexTaxi', compact('taxis'));
    }
    public function userCarOrder()
    {
        $cars = ReservationCar::where('user_id',  '=', Auth::user()->id)->paginate(6);
        return view('orders.indexCars', compact('cars'));
    }
    public function userVillaOrder()
    {
        $villas = ReservationVilla::where('user_id',  '=', Auth::user()->id)->paginate(6);
        return view('orders.indexVillas', compact('villas'));
    }
    public function userAppartOrder()
    {
        $apparts = ReservationApartement::where('user_id',  '=', Auth::user()->id)->paginate(6);
        return view('orders.indexAppart', compact('apparts'));
    }
}
