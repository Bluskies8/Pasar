<?php

namespace App\Http\Controllers;

use App\Models\dtrans;
use App\Models\htrans;
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
        //
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
        $bruto = 0;
        $netto = 0;
        $total_jumlah = 0;
        $total_harga = 0;
        $count = htrans::where('pasar_id',1)->count()+1;
        // $id = "HT".str_pad(Auth::guard('checkLogin')->user()->pasar_id,2,"0");

        $id = "HT01".str_pad($count,2,'0',STR_PAD_LEFT);
        // return $temp;
        $temp = htrans::create([
            'id'=> $id,
            'pasar_id' => 1,
            'user_id' => 1,
            // 'pasar_id' => Auth::guard('checkLogin')->user()->pasar_id,
            // 'user_id' => Auth::guard('checkLogin')->user()->id,
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
            $round = round($bruto);
            // dd($key);
            $subtotal = $key['netto']*$round;
            // return $temp->nama_baran;
            dtrans::create([
                'htrans_id' => $temp->id,
                'kode' => $key['kode'],
                'nama_barang' => $key['nama'],
                'jumlah' => $key['jumlah'],
                'bruto' => $bruto,
                'round' => $round,
                'netto' => $key['netto'],
                'parkir' => $key['parkir'],
                'subtotal' => $subtotal
            ]);
            $total_jumlah+=$round;
            $total_harga+=$subtotal+$key['parkir'];
        }
        $data = htrans::where('id',$temp->id)->first();
        $data->total_harga = $total_harga;
        $data->total_jumlah = $total_jumlah;
        $data->save();
        $data = htrans::where('id',$temp->id)->first();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\htrans  $htrans
     * @return \Illuminate\Http\Response
     */
    public function show(htrans $htrans)
    {
        //
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
