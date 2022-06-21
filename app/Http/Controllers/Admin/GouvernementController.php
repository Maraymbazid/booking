<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Gouvernements\GouvernementRequest;
use App\Models\Admin\Gouvernement;
use Exception;
class GouvernementController extends Controller
{
    public function index()
    {
        try
        {
            $allgouvernements=Gouvernement::paginate(8);
            return view('admin.gouvernements.index',compact('allgouvernements'));
        }
        catch(Exception $ex)
        {
                alert()->error('Oops....','Something went wrong .. try again');
                return redirect() -> route('adminHome');
        }
    }
    public function create()
    {
        return view('admin.gouvernements.create1');
    }
    public function store(GouvernementRequest $request)
    {
         $gouvernement=Gouvernement::create([
                    'name'=>$request->name,
                ]);
                if($gouvernement)
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
    public function delete(Request $request)
    {
        try
        {
            $gouvernement = Gouvernement::find($request->id);
            if (!$gouvernement)
            {
                alert()->error('Oops....','this element does not exist .. try again');
                return redirect() -> route('adminHome');
            }
            $gouvernement->delete();
                return response()->json([
                    'status' => true,
                    'msg' => 'تم الحذف بنجاح',
                    'id' => $request->id
                ]);

        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('adminHome');
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
                return redirect() -> route('adminHome');
            }
            $gouvernement = Gouvernement::select('id', 'name')->find($id);
           return view('admin.gouvernements.edit', compact('gouvernement'));
        }
        catch(Exception $ex)
        {
            alert()->error('Oops....','Something went wrong .. try again');
            return redirect() -> route('adminHome');
        }

    }
    public function update(GouvernementRequest $request)
    {
        $gouvernement = Gouvernement::find($request ->id);
        if (!$gouvernement)
            return response()->json([
                'status' => false,
                'msg' =>'this element does not exist',
            ]);
        $gouvernement->update(
            [
                'name' => $request->name,
            ]
        );
        return response()->json([
            'status' => true,
            'msg' =>'تم تعديل بنجاح'
        ]);
    }
}
