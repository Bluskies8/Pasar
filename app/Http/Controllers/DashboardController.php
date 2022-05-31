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
        $this->updateDate();
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $cekuser = User::where('email',$request->email)->first();
        $time = Carbon::now();
        if(!$cekuser) return redirect()->back()->with('pesan','email/password salah');
        // $time = Carbon::createFromFormat('Y-m-d H:i:s','2022-05-30 22:15:00',7);
        $cekshif = shif::where('number',$cekuser->shif)->first();
        if($cekuser->role_id<3){
            if(Auth::guard('checkLogin')->attempt($data)){
                return redirect('/');
            }else{
                return redirect()->back()->with('pesan','email/password salah');
            }
        }
        if($time < $cekshif->end && $time > $cekshif->start) {
            if(Auth::guard('checkLogin')->attempt($data)){
                return redirect('/');
            }else{
                return redirect()->back()->with('pesan','email/password salah');
            }
        }else{
            return redirect()->back()->with('pesan','bukan shif anda');
        }
    }
    function updateDate()
    {
        $date = Carbon::now()->format('Y-m-d');
        $cekshif = shif::all();
        foreach ($cekshif as $key) {
            $start = date("H:i:s",strtotime($key->start));
            $end = date("H:i:s",strtotime($key->end));
            $key->start = $date.' '.$start;
            if($key->number == 3){
                $date = Carbon::now()->addDays(1)->format('Y-m-d');
                $key->end = $date.' '.$end;
            }else{
                $key->end = $date.' '.$end;
            }
            $key->save();
        }
    }
}
