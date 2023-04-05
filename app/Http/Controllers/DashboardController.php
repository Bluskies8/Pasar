<?php

namespace App\Http\Controllers;

use App\Models\dtrans;
use App\Models\htrans;
use App\Models\invoice;
use App\Models\listrik;
use App\Models\log;
use App\Models\netto;
use App\Models\pasar;
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
                if($cekuser->role_id>1){
                    return redirect(strtolower(Auth::guard('checkLogin')->user()->role->name).'/stock');
                }else{

                    // return view('pages.selectPasar');
                    return redirect('/'.strtolower(Auth::guard('checkLogin')->user()->role->name).'/switchPasar');
                }
            }else{
                return redirect()->back()->with('pesan','email/password salah');
            }
    }
    public function userPages()
    {
        if(Auth::guard('checkLogin')->user()->role_id<3){
            $data = User::with('role')->where('role_id','>',1)->where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->get();

        }else{
            $data = User::with('role')->where('role_id',4)->where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->get();
        }
        return view('pages.masterUser',[
            'data' => $data
        ]);
    }

    public function tambahPasar(Request $request)
    {
        try {
            $data = pasar::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat
            ]);
            return redirect(strtolower(Auth::guard('checkLogin')->user()->role->name));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function switchPages()
    {
        // $data = pasar::all();
        $data = user::find(Auth::guard('checkLogin')->user()->id);
        dd($data);
        return view('pages.selectPasar',[
            'data' => $data
        ]);
    }

    public function switchPasar($id)
    {
        $data = user::find(Auth::guard('checkLogin')->user()->id);
        $data->pasar_id = $id;
        $data->save();
        return redirect(strtolower(Auth::guard('checkLogin')->user()->role->name));
    }

    public function createUser(Request $request)
    {
        try {
            $user = User::create([
                'name'=> $request->nama,
                'pasar_id' => Auth::guard('checkLogin')->user()->pasar_id,
                'email' => $request->username,
                'password' => Hash::make($request->password),
                'role_id' => $request->role,
                'shif' => $request->shif,
            ]);
            log::create([
                'user_id' =>Auth::guard('checkLogin')->user()->id,
                'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
                'keterangan' => "tambah user ".$user->name
            ]);
            return "success";
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function updatepassword(Request $request)
    {
        // dd($request->all());
        $user = User::where('id',Auth::guard('checkLogin')->user()->id)->first();
        if(Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
            log::create([
                'user_id' =>Auth::guard('checkLogin')->user()->id,
                'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
                'keterangan' => "update password ".$user->name
            ]);
            Auth::guard('checkLogin')->logout();
            return redirect('login');
        }else{
            return redirect()->back()->with('error','Password Salah');
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
        $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 04:00:00',7);
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
        // $standa = stand::where('no_stand','like', 'a%')->orderBy('no_stand','desc')->where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->get();
        // $standb = stand::where('no_stand','like', 'b%')->orderBy('no_stand','desc')->where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->get();
        // $tempc = stand::where('no_stand','like', 'c%')->where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->get();
        // foreach ($tempc as $key => $value) {
        //     $standc[$key]['seller_name'] = $value->seller_name;
        //     $standc[$key]['no_stand'] = $value->no_stand;
        //     $standc[$key]['badan_usaha'] = $value->badan_usaha;
        // }
        // // dd($standc);
        return view('pages.vendor',[
            'role' => Auth::guard('checkLogin')->user()->role_id,
        ]);
    }

    public function vendorTable()
    {
        $temp = stand::where('pasar_id', Auth::guard('checkLogin')->user()->pasar_id)->get();
        return view('components/tableDenah', [
            'data' => $temp,
        ]);
    }

    public function vendorCreate(Request $request)
    {
        // return Auth::guard('checkLogin')->user()->pasar_id;
        try {
            $stand = stand::create([
                'badan_usaha' => ($request->badan_usaha)?$request->badan_usaha:"-",
                'seller_name' => $request->seller_name,
                'no_stand' => $request->no_stand,
                'Phone' => ($request->Phone)?$request->Phone:"-",
                'jenis_jualan' => ($request->Jenis_jualan)?$request->Jenis_jualan:"-",
                'pasar_id' => Auth::guard('checkLogin')->user()->pasar_id,
            ]);
            return $stand;
            log::create([
                'user_id' =>Auth::guard('checkLogin')->user()->id,
                'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
                'keterangan' => "Create Vendor ".$stand->id
            ]);
            return "success";
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function vendorUpdate(Request $request)
    {
        try {
            $stand = stand::where('id',$request->id)->first();
            $stand->badan_usaha = ($request->badan_usaha)?$request->badan_usaha:"-";
            $stand->seller_name = $request->seller_name;
            $stand->save();
            log::create([
                'user_id' =>Auth::guard('checkLogin')->user()->id,
                'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
                'keterangan' => "Update Vendor ".$stand->no_stand
            ]);
            return "success";
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function vendorDelete(Request $request)
    {
        $stand = stand::find($request->id);
        log::create([
            'user_id' =>Auth::guard('checkLogin')->user()->id,
            'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
            'keterangan' => "Menghapus Stand dengan NO.Stand ".$stand->no_stand
        ]);
        $stand->delete();
        return 'success';
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
