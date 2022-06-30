<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AdminController extends Controller
{
    public function getlogin()
    {
        return view('admin.auth.login');
    }
   public function login(Request $request)
   {
       if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {
            return redirect()->route('adminHome');
       }
       return redirect()->back()->with(['error' => 'the Credentials does not match records ']);
   }
   public function logout()
   {
       auth()->guard('admin')->logout();
       return  redirect()->route('get.admin.login');
   }
   public function users()
   {
    $allusers=User::paginate(8);
    return view('admin.users.index',compact('allusers'));
   }
   public function disableuser(Request $request)
   {
    $user=User::find($request->id);
    if($user)
    {
        $user->update([
            'status' => '0',
        ]);
        return response()->json([
            'msg'  => '  تم إلغاء تفعيل المستخدم  بنجاح',
            ], 200);
    } 
    else 
    {
        return response()->json([
                //'status' => false,
                'msg'  => ' تعذر  تفعيل هناك خطأ ما ',
            ], 500);
    }
   }
   public function enableuser(Request $request)
   {
    $user=User::find($request->id);
    if($user)
    {
        $user->update([
            'status' => '1',
        ]);
        return response()->json([
                'msg'  => 'تم تفعيل المستخدم بنجاح',
            ], 200);
    } 
    else 
    {
        return response()->json([
                //'status' => false,
                'msg'  => ' تعذر  تفعيل هناك خطأ ما ',
            ], 500);
    }
   }

}
