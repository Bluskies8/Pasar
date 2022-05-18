<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::guard('checkLogin')->attempt($data)){
            return view('dashboard');
        }else{
            return redirect()->back()->with('pesan','email/password salah');
        }
    }
}
