<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Gouvernements\GouvernementRequest;
use App\Models\Admin\Gouvernement;

class GouvernementController extends Controller
{
    public function index()
    {
        try
        {
            $allgouvernements=Gouvernement::select('id','name')->get();
            return view('admin.gouvernements.index',compact('allgouvernements'));
        }
        catch(Exception $ex)
        {
                alert()->error('Oops....','Something went wrong .. try again');
                return redirect() -> route('home');
        }
    }
    public function action()
    {
        return response()->json(['status'=>true,"redirect_url"=>url('admin/allgouvernement')]);
    }
    public function create()
    {
        return view('admin.gouvernements.create1');
    }
    public function store(GouvernementRequest $request)
    {
        try {
                $gouvernement=Gouvernement::create([
                    'name'=>$request->name,
                ]);
                if($gouvernement)
                {
                    alert()-> success('Added....', 'gouvernement added successfully');
                    return redirect() -> route('allgouvernement');
                }
           }
        catch(Exception $ex)
        {
                alert()->error('Oops....','Something went wrong .. try again');
                return redirect() -> route('allgouvernement');
        }
    }
    public function delete(Request $request)
    {
        try
        {
            $gouvernement = Gouvernement::find($request->id);
            if (!$gouvernement)
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('home');
            }
            $gouvernement->delete();
                return response()->json([
                    'status' => true,
                    'msg' => 'deleted successfully',
                    'id' => $request->id
                ]);

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
            $gouvernement = Gouvernement::find($id);  // search in given table id only
        if (!$gouvernement)
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('home');
            }
            $gouvernement = Gouvernement::select('id', 'name')->find($id);
           return view('admin.gouvernements.edit', compact('gouvernement'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('home');
        }

    }
    public function update(Request $request)
    {
       try
       {
        $gouvernement = Gouvernement::find($request ->id);
        if (!$gouvernement)
            return response()->json([
                'status' => false,
                'msg' =>'this element does not exist',
            ]);

        //update data
        $gouvernement->update(
            [
                'name' => $request->name,
            ]
        );

        return response()->json([
            'status' => true,
            'msg' =>'updated successufully'
        ]);
       }
       catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('home');
        }
    }
}
