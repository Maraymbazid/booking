<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Gouvernement;
use  App\Http\Requests\Destination\StoreDestination;
use App\Models\Admin\Destination;
class DestinationController extends Controller
{
    public function create()
    {
        $allgouvernements=Gouvernement::select('id','name')->get();
        return view('admin.destinations.create1',compact('allgouvernements'));
    }
    public function store(StoreDestination $request)
    {
        $destination=Destination::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'gouvernement_id'=>$request->gouvernement_id,
        ]);
        if($destination)
           {
            $status = 200;
            $msg  = 'تم حفظ الداتا بنجاح ';
            }
        else 
          {
            $status = 500;
            $msg  = ' تعذر الحفظ هناك خطأ ما       ';
         }
    return response()->json([
        'status' => $status,
        'msg' => $msg
    ]);
    }
    public function index()
    {
        try
        {
            $alldestinations=Destination::select()->get();
            return view('admin.destinations.index',compact('alldestinations'));
        }
        catch(Exception $ex)
        {
                alert()->error('Oops....','Something went wrong .. try again');
                return redirect() -> route('home');
        }
    }
    public function delete(Request $request)
    {
        try
        {
            $destination=Destination::find($request->id);
            if ($destination)
            {
                $destination->delete();
                return response()->json
                ([
                    'msg' => 'تم الحذف بنجاح',
                    'id' => $request->id
                ],200);
            }
            else
            {
                return response()->json
                ([
                     'msg'  => ' تعذر الحذف هناك خطأ ما ',
                ],500);
            }
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('home');
        }
    }
    public function edit($id)
    {
        try
        {
            $destination=Destination::find($id);  // search in given table id only
            $allgouvernements=Gouvernement::select('id','name')->get();
        if (!$destination)
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('home');
            }
           return view('admin.destinations.edit', compact('destination','allgouvernements'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('home');
        }

    }
    public function update(StoreDestination $request)
    {
        $destination=Destination::find($request ->id);
        if (!$destination)
        {  
            return response()->json([
                'status' => false,
                'msg' =>'this element does not exist',
            ]);
        }
        else
        {
            $destination->update(
                [
                    'name' => $request->name,
                    'price' => $request->price,
                    'gouvernement_id'=> $request->gouvernement_id,
                ]
            );
            return response()->json([
                'status' => true,
                'msg' =>'تم تعديل بنجاح'
            ]);
        }
          
    }
}
