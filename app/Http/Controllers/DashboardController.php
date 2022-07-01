<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\shif;
use App\Models\stand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function login(Request $request)
    {
        // $this->updateDate();
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $cekuser = User::where('email',$request->email)->first();
        if(!$cekuser) return redirect()->back()->with('pesan','email/password salah');
        // $time = Carbon::now();
        // $time = Carbon::createFromFormat('Y-m-d H:i:s','2022-05-30 22:15:00',7);
        // $cekshif = shif::where('number',$cekuser->shif)->first();
        // if($cekuser->role_id<4){
            if(Auth::guard('checkLogin')->attempt($data)){
                if($cekuser->role_id>2){
                    return redirect('/stock');
                }else{
                    return redirect('/');
                }
            }else{
                return redirect()->back()->with('pesan','email/password salah');
            }
        // }
        // if($time < $cekshif->end && $time > $cekshif->start) {
        //     if(Auth::guard('checkLogin')->attempt($data)){
        //         return redirect('/');
        //     }else{
        //         return redirect()->back()->with('pesan','email/password salah');
        //     }
        // }else{
        //     return redirect()->back()->with('pesan','bukan shif anda');
        // }
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
    public function logout()
    {
        Auth::guard('checkLogin')->logout();
        return redirect('login');
    }
    public function vendor()
    {
        $standa = stand::where('no_stand','like', 'a%')->orderBy('no_stand','desc')->get();
        $standb = stand::where('no_stand','like', 'b%')->orderBy('no_stand','desc')->get();
        $tempc = stand::where('no_stand','like', 'c%')->get();
        foreach ($tempc as $key => $value) {
            $standc[$key]['seller_name'] = $value->seller_name;
            $standc[$key]['no_stand'] = $value->no_stand;
            $standc[$key]['badan_usaha'] = $value->badan_usaha;
        }
        // dd($standc);
        return view('pages.vendor',[
            'standa' => $standa,
            'standb' => $standb,
            'standc' => $standc
        ]);
    }
    public function vendorUpdate(Request $request)
    {
        $badan = $request->badan_usaha;
        $nama = $request->seller_name;
        if($badan == null){
            $badan = "";
        }
        if($nama == null){
            $nama = "";
        }

        try {
            $stand = stand::where('no_stand',$request->id)->first();
            $stand->badan_usaha = $badan;
            $stand->seller_name = $nama;
            $stand->save();
            return "success";
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
