<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Gouvernement;
use App\Models\Admin\MeetingSalles;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\MeetingServices;
use App\Http\Traits\media;

use App\Http\Requests\Meeting\StoreSalle;
use App\Http\Requests\Meeting\UpdateSalle;
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
        $request = $data->except('_token', 'image','services','page');
        $request['image'] = $imageName;
        $stored = DB::table('meeting_rooms')->insertGetId($request);
        if ($stored)
        {
            $salle = MeetingSalles::find($stored);
            $salle->services()->attach($data->services);
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

        $allmeetingrooms=MeetingSalles::select()->get();
        return view('admin.meetings.index',compact('allmeetingrooms'));
    }
    public function delete(Request $request)
    {
        $salle=MeetingSalles::find($request->id);
        if($salle)
        {
            $salle->services()->detach();
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
                return redirect() -> route('home');
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
            return redirect() -> route('home');
        }

    }
    public function update(UpdateSalle $data)
    {
        $salle=MeetingSalles::find($data->id);
        if ($salle)
         {
            $id=$data->id;
            $result = $data->except('page', 'image', '_token', '_method','id','services');
            if ($data->has('image')) {
                $oldImage = DB::table('meeting_rooms')->select('image')->where('id', $id)->first()->image;
                $this->deleteMedia($oldImage, 'salles');
                $imageName = $this->uploadMedia($data->image, 'salles');
                $result['image'] = $imageName;
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
}
