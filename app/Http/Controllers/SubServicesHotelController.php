<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubServicesHotel;
use App\Models\MainServicesHotel;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSubServicesHotelRequest;
use App\Http\Requests\UpdateSubServicesHotelRequest;

class SubServicesHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubByMainId(Request $request)
    {

        $value = $request->get('id');
        $dependent = $request->get('dependent');
        $services = DB::table('sub_services_hotels')->where('main_service_id', $value)->get();
        $output = '<option data-kt-flag="flags/united-states.svg" value="">' . ucfirst($dependent) . ' </option>';
        foreach ($services as $service) {
            $output .= '<option data-kt-flag="flags/united-states.svg" value="' . $service->id . '">' . $service->name . ' </option>';
        }
        echo $output;
    }
    public function getOneSub($id)
    {
        $sub = SubServicesHotel::find($id);
        return response()->json(['sub' => $sub], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubServicesHotelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubServicesHotelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubServicesHotel  $subServicesHotel
     * @return \Illuminate\Http\Response
     */
    public function show(SubServicesHotel $subServicesHotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubServicesHotel  $subServicesHotel
     * @return \Illuminate\Http\Response
     */
    public function edit(SubServicesHotel $subServicesHotel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubServicesHotelRequest  $request
     * @param  \App\Models\SubServicesHotel  $subServicesHotel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubServicesHotelRequest $request, SubServicesHotel $subServicesHotel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubServicesHotel  $subServicesHotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubServicesHotel $subServicesHotel)
    {
        //
    }
}
