<?php

namespace App\Http\Controllers;

use App\Models\buah;
use App\Models\dtrans;
use App\Models\htrans;
use App\Models\netto;
use App\Models\shif;
use App\Models\stand;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if($time > '06:00:00'){
            $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 06:00:00',7);
            $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 06:00:00',7)->addDays(1);
        }else{
            $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 06:00:00',7)->subDays(1);
            $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 06:00:00',7);
        }
        // dd($carbon.' - '.$start.' - '.$end);
        if(Auth::guard('checkLogin')->user()->role_id <3){
            $temp = htrans::withTrashed()->get();
        }else{
            $temp = htrans::whereBetween('created_at',[$start,$end])->get();
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

    public function detailspage()
    {

        $tmep = stand::select('seller_name')->groupBy('seller_name')->get();
        $buah = buah::get();
        foreach ($tmep as $key => $value) {
            $no_stand = stand::where('seller_name',$value->seller_name)->first();
            $stand[$key]['seller_name'] = $no_stand->seller_name;
            $stand[$key]['no_stand'] = $no_stand->no_stand;
            $stand[$key]['id'] = $no_stand->id;
        }
        return view('pages/stockDetail',[
            'stand'=>$stand,
            'data'=>['id'=>'','value'=>'1'],
            'role' => Auth::guard('checkLogin')->user()->role_id,
            'buah' => $buah,
        ]);
    }

    public function details($htrans)
    {
        // $data = dtrans::where('htrans_id',$htrans)->get();
        $data = htrans::with(['details','stand'])->where('id',$htrans)->first();
        $stand['id'] = $data->stand->id;
        $stand['seller_name'] = $data->stand->seller_name;
        // dd($stand);
        return view('pages/stockDetail',[
            'stand' => $stand,
            'data'=>$data,
            'role' => Auth::guard('checkLogin')->user()->role_id
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

        $time = Carbon::now();
        $user = Auth::guard('checkLogin')->user();
        $cekshif = shif::where('number',$user->shif)->first();
        $check = false;
        if($time < $cekshif->end && $time > $cekshif->start) {
            if(!$user->tambahan_start && !$user->tambahan_end)$check == true;
            if($time < $user->tambahan_end && $time > $user->tambahan_start)$check==true;
        }
        if($check){
            $c = false;
            $carbon = Carbon::now();
            $date = $carbon->format('dmY');
            $bruto = 0;
            $netto = 0;
            $total_jumlah = 0;
            $total_harga = 0;
            $count = htrans::where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->where('id','like','%'. $date. '%')->withTrashed()->count()+1;
            // return $count;
            $id = "HT".str_pad(Auth::guard('checkLogin')->user()->pasar_id,2,"0",STR_PAD_LEFT).$date.str_pad($count,3,"0",STR_PAD_LEFT);
            $checkstandid = stand::where('id',$request->stand_id)->first();
            $parkir = [0,3000,5000,1000,20000,50000];
            $kode = ['k','b','td','dt','sd','p','t'];
            foreach ($request->items as $key) {
                $checkbuah = buah::where('name',$key['nama'])->first();
                if(in_array($key['kode'], $kode) && in_array($key['parkir'], $parkir) && $checkstandid && $checkbuah){
                    $c = true;
                }else{
                    $c = false;
                }
            }
            if($c == true){
                $temp = htrans::create([
                    'id'=> $id,
                    'pasar_id' => Auth::guard('checkLogin')->user()->pasar_id,
                    'user_id' => Auth::guard('checkLogin')->user()->id,
                    'stand_id' => $request->stand_id,
                    'transportasi' => $request->transportasi,
                    'Total_jumlah' => 0,
                    'Total_harga' => 0
                ]);
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
                    $round = ceil($bruto);
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
                        'subtotal' => $subtotal
                    ]);
                }
                $data = htrans::where('id',$temp->id)->first();
                $data->total_jumlah = $total_jumlah;
                $data->total_harga = $total_harga;
                $data->save();
                return "Success";
            }else{
                return "ada data yang kosong atau salah";
            }
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
    public function update(Request $request, htrans $htrans)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\htrans  $htrans
     * @return \Illuminate\Http\Response
     */
    public function destroy(htrans $htrans)
    {
        dtrans::where('htrans_id',$htrans->id)->delete();
        $htrans->delete();
        return 'success';
    }
}
