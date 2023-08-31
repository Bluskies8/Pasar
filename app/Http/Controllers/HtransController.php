<?php

namespace App\Http\Controllers;

use App\Models\buah;
use App\Models\dtrans;
use App\Models\htrans;
use App\Models\log;
use App\Models\netto;
use App\Models\shif;
use App\Models\stand;
use App\Models\transportasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HtransController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function updateDate()
    {
        $now = Carbon::now();
        // $now = Carbon::createFromFormat('Y-m-d H:i:s','2022-07-23 23:00:00',7);
        $date = $now->format('Y-m-d');
        $cekshif = shif::all();
        // foreach ($cekshif as $key =>$value) {
        //     if($value->number == 1){
        //         $value->start = $date.' 04:00:00';
        //         $value->end = $date.' 12:00:00';
        //     }else if($value->number == 2){
        //         $value->start = $date.' 12:00:00';
        //         $value->end = $date.' 20:00:00';

        //     }else if($value->number == 3){
        //         $value->start = $date.' 20:00:00';
        //         $value->end = $now->addDays(1)->format('Y-m-d').' 04:00:00';
        //     }
        //     $value->save();
        // }
        $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 04:00:00',7);
        if($now>$start){
            foreach ($cekshif as $key) {
                $start = date("H:i:s",strtotime($key->start));
                $end = date("H:i:s",strtotime($key->end));
                $key->start = $date.' '.$start;
                if($key->number == 3){
                    $date = Carbon::now('Asia/Jakarta')->addDays(1)->format('Y-m-d');
                    $key->end = $date.' '.$end;
                }else{
                    $key->end = $date.' '.$end;
                }
                $key->save();
            }
        }
    }
    public function index()
    {
        $this->updateDate();
        $now = Carbon::now();
        $user = Auth::guard('checkLogin')->user();
        $cekshif = shif::where('number',$user->shif)->first();
        $check = false;
        if($user->role_id == 4){
            if($now < $cekshif->end && $now > $cekshif->start) {
                $check=true;
            }else{
                if($now < $user->tambahan_end && $now > $user->tambahan_start){
                    $check=true;
                }
            }
        }
        $carbon = Carbon::now();
        $date = $carbon->toDateString();
        $time = $carbon->toTimeString();
        if($time > '09:00:00'){
            $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7);
            $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7)->addDays(1);
        }else{
            $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7)->subDays(1);
            $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7);
        }
        if(Auth::guard('checkLogin')->user()->role_id <3){
            $temp = htrans::withTrashed()->where('pasar_id', Auth::guard('checkLogin')->user()->pasar_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->get();
        }else if(Auth::guard('checkLogin')->user()->role_id == 3){
            if($time > '09:00:00'){
                $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7)->subDays(1);
                $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7)->addDays(1);
            }else{
                $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7)->subDays(2);
                $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7);
            }
            $temp = htrans::whereBetween('created_at',[$start,$end])->where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->get();
        }else{
            $temp = htrans::whereBetween('created_at',[$start,$end])->where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->get();
        }
        $data = [];
        foreach ($temp as $id => $value) {
            $stand = stand::where('id',$value->stand_id)->first();
            $name = User::where('id',$value->user_id)->withTrashed()->first();
            // dd($name);
            $data[$id]['id_trans'] = $value->id;
            $data[$id]['nama'] = $stand->seller_name;
            $data[$id]['checker'] = $name->name;
            $data[$id]['tanggal'] = date('d-M-Y H:m:s',strtotime($value->created_at));
            $data[$id]['total'] = $value->total_harga;
            $data[$id]['deleted'] = $value->deleted_at;
        }
        return view('pages/stock',[
            'data'=>$data,
            'role'=> Auth::guard('checkLogin')->user()->role_id,
            'check' => $check
        ]);
    }

    public function indexTable(Request $request)
    {
        // dd(Auth::guard('checkLogin')->user()->role_id);
        if(Auth::guard('checkLogin')->user()->role_id > 2){
            $carbon = Carbon::now();
            $date = $carbon->toDateString();
            $time = $carbon->toTimeString();
            if($time > '09:00:00'){
                $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7);
                $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7)->addDays(1);
            }else{
                $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7)->subDays(1);
                $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7);
            }
            if(Auth::guard('checkLogin')->user()->role_id <3){
                $temp = htrans::withTrashed()->where('pasar_id', Auth::guard('checkLogin')->user()->pasar_id)->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->get();
            }else
            if(Auth::guard('checkLogin')->user()->role_id == 3){
                if($time > '09:00:00'){
                    $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7)->subDays(1);
                    $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7)->addDays(1);
                }else{
                    $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7)->subDays(2);
                    $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7);
                }
                $temp = htrans::whereBetween('created_at',[$start,$end])->where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->get();
            }else{
                $temp = htrans::whereBetween('created_at',[$start,$end])->where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->get();
            }
            $temp = htrans::with(['checker', 'stand'])->whereBetween('created_at',[$start,$end])->where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->get();

        }else{
            $temp = htrans::withTrashed()
                        ->with(['checker', 'stand'])
                        ->where('pasar_id', Auth::guard('checkLogin')->user()->pasar_id)
                        ->when($request->search != null, function($query) use ($request) {
                            return $query->where(function($query) use ($request) {
                                $query->where("id", "like", "%{$request->search}%")
                                      ->orWhereDay("created_at", $request->search)
                                      ->orWhereHas('checker', function ($q) use ($request) {
                                          return $q->where('name', 'like', "%" . $request->search . "%");
                                      })
                                      ->orWhereHas('stand', function ($q) use ($request) {
                                          return $q->where('seller_name', 'like', "%" . $request->search . "%");
                                      });;
                            });
                        })
                        ->where('created_at', "like", "{$request->year}-{$request->month}%")
                        // ->paginate(100);
                        ->get();
        }
        return view('components/tableStock', [
            'data' => $temp,
            'role' => Auth::guard('checkLogin')->user()->role_id,
        ]);
    }

    public function detailspage()
    {
        // dd(Auth::guard('checkLogin')->user()->pasar_id);
        $tmep = stand::select('seller_name')->where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->groupBy('seller_name')->get();
        $buah = buah::get();
        // dd($tmep);
        $stand = [];
        $trans = transportasi::orderBy('value')->get();
        foreach ($tmep as $key => $value) {
            $no_stand = stand::where('seller_name',$value->seller_name)->first();
            $stand[$key]['seller_name'] = $no_stand->seller_name;
            $stand[$key]['no_stand'] = $no_stand->no_stand;
            $stand[$key]['id'] = $no_stand->id;
        }
        return view('pages/stockDetail',[
            'stand'=> $stand,
            'data'=>['id'=>'','value'=>'1'],
            'role' => Auth::guard('checkLogin')->user()->role_id,
            'buah' => $buah,
            'trans' => $trans
        ]);
    }

    public function details($htrans)
    {
        // $data = dtrans::where('htrans_id',$htrans)->get();
        $data = htrans::with(['details','stand'])->where('id',$htrans)->first();
        $stand['id'] = $data->stand->id;
        $stand['seller_name'] = $data->stand->seller_name;
        $buah = buah::get();
        $trans = transportasi::orderBy('value')->get();
        // dd($stand);
        return view('pages/stockDetail',[
            'stand' => $stand,
            'data'=>$data,
            'buah' => $buah,
            'role' => Auth::guard('checkLogin')->user()->role_id,
            'trans' => $trans
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $time = Carbon::now();
        $user = Auth::guard('checkLogin')->user();
        $cekshif = shif::where('number',$user->shif)->first();
        $check = false;
        if($time < $cekshif->end && $time > $cekshif->start) {
            $check = true;
        }
        if(!$user->tambahan_start && !$user->tambahan_end){
            $check = true;
        }else if($time < $user->tambahan_end && $time > $user->tambahan_start){
            $check = true;
        }
        if($check){
            $c = false;
            $carbon = Carbon::now('Asia/Jakarta');
            $date = $carbon->format('dmY');
            $bruto = 0;
            $netto = 0;
            $total_jumlah = 0;
            $total_harga = 0;
            $count = htrans::where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->where('id','like','%'. $date. '%')->withTrashed()->count()+1;
            // return $count;
            $id = "HT".str_pad(Auth::guard('checkLogin')->user()->pasar_id,2,"0",STR_PAD_LEFT).$date.str_pad($count,3,"0",STR_PAD_LEFT);
            $checkstandid = stand::where('id',$request->stand_id)->first();
            // $parkir = [0,3000,5000,10000,20000,50000];
            $parkir = transportasi::get();
            // dd($parkir);
            $kode = ['k','b','td','dt','sd','p','t'];
            foreach ($request->items as $key) {
                $checkbuah = buah::where('name',$key['nama'])->first();
                if(in_array($key['kode'], $kode)){
                    $c = true;
                }else{
                    $c = false;
                    return "kode tidak sesuai";
                }
                // if(in_array($key['parkir'], $parkir)){
                //     $c = true;
                // }else{
                //     $c = false;
                //     return "parkir tidak sesuai";
                // }
                if($checkstandid){
                    $c = true;
                }else{
                    $c = false;
                    return "stand tidak sesuai";
                }
                if($checkbuah){
                    $c = true;
                }else{
                    $c = false;
                    return "buah tidak sesuai";
                }
            }
            if($c == true){
                $temp = htrans::create([
                    'id'=> $id,
                    'pasar_id' => Auth::guard('checkLogin')->user()->pasar_id,
                    'user_id' => Auth::guard('checkLogin')->user()->id,
                    'stand_id' => $request->stand_id,
                    'status_borongan' => $request->status_borongan,
                    'Total_jumlah' => 0,
                    'Total_harga' => 0
                ]);
                if(!$temp){
                    return "header transaksi gagal di buat";
                }
                foreach ($request->items as $key) {
                    switch ($key['kode']) {
                        case 'k':
                            $bruto = $key['jumlah']/5;
                            break;
                        case 'b':
                            $bruto = $key['jumlah']/3;
                            break;
                        case 'td':
                            $bruto = $key['jumlah']/1.5;
                            break;
                        case 'dt':
                            $bruto = $key['jumlah']*1.5;
                            break;
                        case 'sd':
                            $bruto = $key['jumlah']/2;
                            break;
                        case 'p':
                            $bruto = $key['jumlah']*1;
                            break;
                        case 't':
                            $bruto = $key['jumlah']/50;
                            break;
                    }
                    $round = round($bruto);
                    $netto = netto::first();
                    $subtotal = $netto->value*$round;
                    $total_harga += $subtotal+$key['parkir'];
                    $total_jumlah += $round;
                    dtrans::create([
                        'htrans_id' => $temp->id,
                        'kode' => $key['kode'],
                        'nama_barang' => $key['nama'],
                        'jumlah' => $key['jumlah'],
                        'bruto' => $bruto,
                        'round' => $round,
                        'netto' => $netto->value,
                        'parkir' => $key['parkir'],
                        'transportasi' => $key['transportasi'],
                        'subtotal' => $subtotal
                    ]);
                }
                $data = htrans::where('id',$temp->id)->first();
                $data->total_jumlah = $total_jumlah;
                $data->total_harga = $total_harga;
                $data->save();
                log::create([
                    'user_id' =>Auth::guard('checkLogin')->user()->id,
                    'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
                    'keterangan' => "Input transaksi dengan kode ".$data->id
                ]);
                return "Success";
            }else{
                return "ada data yang kosong atau salah";
            }
        }else{
            return "bukan shif anda";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\htrans  $htrans
     * @return \Illuminate\Http\Response
     */
    public function show(htrans $htrans)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\htrans  $htrans
     * @return \Illuminate\Http\Response
     */
    public function edit(htrans $htrans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\htrans  $htrans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,htrans $htrans)
    {
        // return $request->data;
        $bruto = 0;
        $netto = 0;
        $total_jumlah = 0;
        $total_harga = 0;
        foreach ($request->data as $key) {
            $dtrans = dtrans::where('id',$key['id'])->first();
            switch ($key['kode']) {
                case 'k':
                    $bruto = $key['jumlah']/5;
                    break;
                case 'b':
                    $bruto = $key['jumlah']/3;
                    break;
                case 'td':
                    $bruto = $key['jumlah']/1.5;
                    break;
                case 'dt':
                    $bruto = $key['jumlah']*1.5;
                    break;
                case 'sd':
                    $bruto = $key['jumlah']/2;
                    break;
                case 'p':
                    $bruto = $key['jumlah']*1;
                    break;
                case 't':
                    $bruto = $key['jumlah']/50;
                    break;
            }
            $round = round($bruto);
            $netto = netto::first();
            $subtotal = $netto->value*$round;
            $total_harga += $subtotal+$dtrans->parkir;
            $total_jumlah += $round;

            $dtrans->kode = $key['kode'];
            $dtrans->jumlah = $key['jumlah'];
            $dtrans->bruto = $bruto;
            $dtrans->round = $round;
            $dtrans->subtotal = $subtotal;
            $dtrans->save();
        }
        $htrans->total_jumlah = $total_jumlah;
        $htrans->total_harga = $total_harga;
        $htrans->save();
        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\htrans  $htrans
     * @return \Illuminate\Http\Response
     */
    public function destroy(htrans $htrans)
    {
        log::create([
            'user_id' =>Auth::guard('checkLogin')->user()->id,
            'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
            'keterangan' => "Menghapus transaksi dengan kode ".$htrans->id
        ]);
        dtrans::where('htrans_id',$htrans->id)->delete();
        $htrans->delete();
        return 'success';
    }
}
