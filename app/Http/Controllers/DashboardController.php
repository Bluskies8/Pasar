<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\shif;
use Carbon\Carbon;
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
        $cekuser = User::where('email',$request->email)->first();
        $time = Carbon::now();
        $cekshif = shif::where('id',$cekuser->shif)->first();
        if($cekuser->role_id == 1 || $cekuser->role_id == 2){
            if(Auth::guard('checkLogin')->attempt($data)){
                return view('dashboard');
            }else{
                return redirect()->back()->with('pesan','email/password salah');
            }
        }
        if($time->format('H:i:s') < $cekshif->end && $time->format('H:i:s') > $cekshif->start) {
            if(Auth::guard('checkLogin')->attempt($data)){
                return view('dashboard');
            }else{
                return redirect()->back()->with('pesan','email/password salah');
            }
        }else{
            return redirect()->back()->with('pesan','bukan shif anda');
        }
    }
}
