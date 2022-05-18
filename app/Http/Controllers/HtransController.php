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
        $total = 0;
        $temp = htrans::create([
            'pasar_id' => Auth::user()->pasar_id,
            'user_id' => Auth::user()->id,
            'stand_id' => $request->stand_id,
            'total' => $request->total,
        ]);
        foreach ($request->items as $key ) {
            dtrans::create([
                'htrans_id' => $temp->id,
                'nama_barang' => $key->nama_barang,
                'tipe_berat' => $key->tipe_berat,
                'jumlah' => $key->jumlah,
                'harga' => $key->harga,
                'subtotal' => $key->subtotal
                // 'subtotal' => $key->jumlah * $key->harga
            ]);
            // $subtotal = $key->jumlah * $key->harga;
            // $total += $subtotal;
        }
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
        $htrans->delete();
        return 'success';
    }
}
