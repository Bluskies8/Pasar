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
        $total_jumlah = 0;
        $total_harga = 0;
        $temp = htrans::create([
            // 'pasar_id' => 1,
            // 'user_id' => 1,
            'pasar_id' => Auth::guard('checkLogin')->user()->pasar_id,
            'user_id' => Auth::guard('checkLogin')->user()->id,
            'stand_id' => $request->stand_id,
            'Total_jumlah' => 0,
            'Total_harga' => 0
        ]);
        foreach ($request->items as $key => $value) {
            // dd($value);
            dtrans::create([
                'htrans_id' => $temp->id,
                'nama_barang' => $value['nama_barang'],
                'tipe_berat' => $value['tipe_berat'],
                'jumlah' => $value['jumlah'],
                'harga' => $value['harga'],
                'subtotal' => $value['subtotal']
                // 'subtotal' => $key->jumlah * $key->harga
            ]);
            $total_jumlah+=$value['jumlah'];
            // $subtotal = $key->jumlah * $key->harga;
            // $total += $subtotal;
        }
        $data = htrans::where('id',$temp->id)->first();
        $data->total_harga = $total_harga;
        $data->total_jumlah = $total_jumlah;
        $data->save();
        return $temp;
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
        $htrans->delete();
        return 'success';
    }
}
