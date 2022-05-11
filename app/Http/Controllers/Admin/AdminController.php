<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function getlogin()
    {
        return view('Admin.auth.login');
    }
   public function login(Request $request)
   {
       if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {
           return redirect() -> route('home');
       }
       return redirect()->back()->with(['error' => 'the Credentials do not match records ']);
   }

}

