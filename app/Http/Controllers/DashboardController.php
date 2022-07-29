<?php

namespace App\Http\Controllers;

use App\Models\dtrans;
use App\Models\htrans;
use App\Models\invoice;
use App\Models\log;
use App\Models\netto;
use App\Models\User;
use App\Models\shif;
use App\Models\stand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        if(!$cekuser) return redirect()->back()->with('pesan','email/password salah');
        // $time = Carbon::now();
        // $time = Carbon::createFromFormat('Y-m-d H:i:s','2022-05-30 22:15:00',7);
        // $cekshif = shif::where('number',$cekuser->shif)->first();
        // if($cekuser->role_id<4){
            if(Auth::guard('checkLogin')->attempt($data)){
                log::create([
                    'user_id' =>$cekuser->id,
                    'pasar_id' =>$cekuser->pasar_id,
                    'keterangan' => "login"
                ]);
                if($cekuser->role_id>2){
                    return redirect(strtolower(Auth::guard('checkLogin')->user()->role->name).'/stock');
                }else{
                    return redirect('/'.strtolower(Auth::guard('checkLogin')->user()->role->name));
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
    public function userPages()
    {
        if(Auth::guard('checkLogin')->user()->role_id<3){
            $data = User::with('role')->where('role_id','>',1)->get();

        }else{
            $data = User::with('role')->where('role_id',4)->get();
        }
        return view('pages.masterUser',[
            'data' => $data
        ]);
    }
    public function createUser(Request $request)
    {
        try {
            User::create([
                'name'=> $request->nama,
                'pasar_id' => Auth::guard('checkLogin')->user()->pasar_id,
                'email' => $request->username,
                'password' => Hash::make($request->password),
                'role_id' => $request->role,
                'shif' => $request->shif,
            ]);
            return "success";
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function updateUser(Request $request, User $user)
    {
        log::create([
            'user_id' =>Auth::guard('checkLogin')->user()->id,
            'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
            'keterangan' => "update user ".$user->name
        ]);
        if($request->username)$user->email = $request->username;
        if($request->password)$user->password = Hash::make($request->password);
        if($request->nama)$user->name = $request->nama;
        if($request->role)$user->role_id = $request->role;
        if($request->shif)$user->shif = $request->shif;
        if($request->tambahan_start){
            $user->tambahan_start = $request->tambahan_start;
        }else{
           $user->tambahan_start = null;
        }
        if($request->tambahan_end){
            $user->tambahan_end = $request->tambahan_end;
        }else{
            $user->tambahan_end = null;
        }
        $user->save();
        return "success";
    }
    public function deleteUser(User $user)
    {
        log::create([
            'user_id' =>Auth::guard('checkLogin')->user()->id,
            'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
            'keterangan' => "delete user ".$user->nama
        ]);
        $user->delete();
        return 'success';
    }
    public function reset()
    {
        // $data = htrans::where('user_id',2)->get();
        // foreach ($data as $key) {
        //     $key->delete();
        // }
        htrans::query()->truncate();
        dtrans::query()->truncate();
        return redirect('/');
    }
    function updateDate()
    {
        $now = Carbon::now();
        // $now = Carbon::createFromFormat('Y-m-d H:i:s','2022-07-24 09:00:00',7);
        $date = $now->format('Y-m-d');
        $cekshif = shif::all();
        $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 08:00:00',7);
        if($now>$start){
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
    public function logout()
    {
        log::create([
            'user_id' =>Auth::guard('checkLogin')->user()->id,
            'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
            'keterangan' => "User ".Auth::guard('checkLogin')->user()->id." logout"
        ]);
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
            log::create([
                'user_id' =>Auth::guard('checkLogin')->user()->id,
                'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
                'keterangan' => "Update Vendor ".$stand->id
            ]);
            return "success";
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function dashboard()
    {
        $now = Carbon::now();
        $netto = netto::first();
        $dataKuli = [];
        $barang = [];
        $pendapatan = [];
        for ($i=3; $i >= 0; $i--) {
            $start = Carbon::createFromFormat('Y-m-d H:i:s',$now->startOfMonth()->toDateString().' 00:00:00',7)->subMonth($i);
            $end = Carbon::createFromFormat('Y-m-d H:i:s',$now->endOfMonth()->toDateString().' 23:59:59',7)->subMonth($i);
            $countKuli = htrans::whereBetween('created_at',[$start,$end])->sum('total_jumlah');
            $dataKuli[$i] = [
                'bulan'=>$start->format('F'),
                'jumlah'=>$countKuli*$netto->value,
            ];
        }

        //data barang masuk
        for ($i=1; $i < 13; $i++) {
            $date = new carbon($now->format('Y').'-'.str_pad($i,2,"0",STR_PAD_LEFT).'-'.'01');
            $start = Carbon::createFromFormat('Y-m-d H:i:s',$date->startOfMonth()->toDateString().' 00:00:00',7);
            $end = Carbon::createFromFormat('Y-m-d H:i:s',$date->endOfMonth()->toDateString().' 23:59:59',7);
            $temp = htrans::whereBetween('created_at',[$start,$end])->sum('total_jumlah');

            $barang[$i-1] = $temp;
        }
        $databarang = join(',',$barang);

        //data pendapatan kotor
        for ($i=1; $i < 13; $i++) {
            $date = new carbon($now->format('Y').'-'.str_pad($i,2,"0",STR_PAD_LEFT).'-'.'01');
            $start = Carbon::createFromFormat('Y-m-d H:i:s',$date->startOfMonth()->toDateString().' 00:00:00',7);
            $end = Carbon::createFromFormat('Y-m-d H:i:s',$date->endOfMonth()->toDateString().' 23:59:59',7);
            $temp = invoice::whereBetween('created_at',[$start,$end])->sum('dibayarkan');

            $pendapatan[$i-1] = $temp;
        }
        $datapendapatan = join(',',$pendapatan);
        return view('pages.dashboard',[
            'kuli' => $dataKuli,
            'barangmasuk' => $databarang,
            'pendapatan' => $datapendapatan
        ]);
    }
    public function logs()
    {
        $data = log::with('user.role')->get();
        return view('pages.Logs',[
            'data' => $data
        ]);
    }
}
