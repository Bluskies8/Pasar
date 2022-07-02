<?php

namespace App\Http\Controllers;

use App\Models\dtrans;
use App\Models\htrans;
use App\Models\netto;
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
    public function index()
    {
        // dd($carbon);
        // $temp = htrans::all();
        // $carbon = Carbon::createFromFormat('Y-m-d H:i:s','2022-06-12 07:15:00',7);
        $carbon = Carbon::now();
        $date = $carbon->toDateString();
        $time = $carbon->toTimeString();
        if($time > '07:00:00'){
            $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 07:00:00',7);
            $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 07:00:00',7)->addDays(1);
        }else{
            $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 07:00:00',7)->subDays(1);
            $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 07:00:00',7);
        }
        // dd($carbon.' - '.$start.' - '.$end);
        if(Auth::guard('checkLogin')->user()->role_id <3){
            $temp = htrans::all();
        }else{
            $temp = htrans::whereBetween('created_at',[$start,$end])->get();
        }
        // dd($temp);
        $data = [];
        foreach ($temp as $id => $value) {
            $stand = stand::where('id',$value->stand_id)->first();
            $data[$id]['id_trans'] = $value->id;
            $data[$id]['nama'] = $stand->seller_name;
            $data[$id]['checker'] = User::where('id',$value->user_id)->first()->name;
            $data[$id]['tanggal'] = date('d-M-Y H:m:s',strtotime($value->created_at));
            $data[$id]['total'] = $value->total_harga;
        }
        // dd($data);
        return view('pages/stock',[
            'data'=>$data,
            'role'=> Auth::guard('checkLogin')->user()->role_id
        ]);
    }

    public function detailspage()
    {
        $tmep = stand::select('seller_name')->groupBy('seller_name')->get();
        foreach ($tmep as $key => $value) {
            $no_stand = stand::where('seller_name',$value->seller_name)->first();
            $stand[$key]['seller_name'] = $no_stand->seller_name;
            $stand[$key]['no_stand'] = $no_stand->no_stand;
            $stand[$key]['id'] = $no_stand->id;
        }
        return view('pages/stockDetail',[
            'stand'=>$stand,
            'data'=>['id'=>'','value'=>'1'],
            'role' => Auth::guard('checkLogin')->user()->role_id
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
        // return ['msg'=>"masuk"];
        // return json_decode($request->nama,true);
        // dd($request->all());

        // return response()->json(['$data'=>$request->all()]);
        $carbon = Carbon::now();
        $date = $carbon->format('dmY');
        $bruto = 0;
        $netto = 0;
        $total_jumlah = 0;
        $total_harga = 0;
        $count = htrans::where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->count()+1;
        $id = "HT".str_pad(Auth::guard('checkLogin')->user()->pasar_id,2,"0",STR_PAD_LEFT).$date.str_pad($count,3,"0",STR_PAD_LEFT);
        // return $request->stand_id;
        // $id = "HT01".str_pad($count,2,'0',STR_PAD_LEFT);
        try {
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
                // return $key['kode'];
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
                // dd($key);
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
        }catch (\Throwable $th) {
            return $th;
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
