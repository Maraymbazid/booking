<?php

namespace App\Http\Controllers;

use App\Models\HotelOrder;
use App\Models\MeetingOrder;
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
        $orders = HotelOrder::where('user_id',  '=', Auth::user()->id)->paginate(6);
        return view('orders.index', compact('orders'));
    }
    public function showOneOrderFoUser($id)
    {
        $order = HotelOrder::find($id);
        return view('orders.single.singlehotelorder', compact('order'));
    }
    public function userTaxiOrder()
    {
        $taxis = ReservationTaxi::where('user_id',  '=', Auth::user()->id)->paginate(6);
        return view('orders.indexTaxi', compact('taxis'));
    }
    public function singleTaxOrder($id)
    {
        $order = ReservationTaxi::where('id', $id)->first();
        // return $order;
        return view('orders.single.singletaxi', compact('order'));
    }

    public function userCarOrder()
    {
        $cars = ReservationCar::where('user_id',  '=', Auth::user()->id)->paginate(6);
        return view('orders.indexCars', compact('cars'));
    }
    public function singleCarOrder($id)
    {
        $order = ReservationCar::where('id', $id)->first();
        // return $order;
        return view('orders.single.singlecar', compact('order'));
    }


    public function userVillaOrder()
    {
        $villas = ReservationVilla::where('user_id',  '=', Auth::user()->id)->paginate(6);
        return view('orders.indexVillas', compact('villas'));
    }
    public function singleVillaOrder($id)
    {
        $order = ReservationVilla::where('id', $id)->first();
        // return $order;
        return view('orders.single.singleappart', compact('order'));
    }


    public function userAppartOrder()
    {
        $apparts = ReservationApartement::where('user_id',  '=', Auth::user()->id)->paginate(6);
        return view('orders.indexAppart', compact('apparts'));
    }
    public function singleApartOrder($id)
    {
        $order = ReservationApartement::where('id', $id)->first();
        // return $order;
        return view('orders.single.singleappart', compact('order'));
    }

    public function userMeetOrder()
    {
        $meets = MeetingOrder::where('user_id',  '=', Auth::user()->id)->paginate(6);
        return view('orders.indexMeetingRoom', compact('meets'));
    }

    public function singleMeetOrder($id)
    {
        $order = MeetingOrder::where('id', $id)->first();
        // return $order;
        return view('orders.single.singlemeet', compact('order'));
    }
}
