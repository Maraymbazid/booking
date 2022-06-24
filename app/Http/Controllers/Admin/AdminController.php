<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

}
