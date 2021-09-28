<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminloginRequest;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index(){
        return view('admin.auth.login');
    }

    public function getlogin(adminloginRequest $request){

        $remember_me = $request->has('remember_me') ? true : false;

        if(auth()->guard('admin')->attempt(['email'=>$request->input("email"),'password'=>$request->input("password")])){
            return redirect() -> route('admin.dashboard');
        }
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);

    }

    public function logout(){
        Auth::guard('admin')->logout();
        return view('admin.auth.login');
    }

    public function profile(){
        return view('admin.auth.profile');
    }
}
