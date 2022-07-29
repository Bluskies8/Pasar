<?php

namespace App\Http\Controllers;

use App\Models\buah;
use App\Models\log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = buah::get();
        return view('pages.masterBarang',[
            'buah' => $data
        ]);
    }
    public function cari()
    {
        $data = buah::get();
        return $data;
        // if($data){
        //     return 'success';
        // }else{
        //     return "decline";
        // }
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
        buah::create(['name'=>$request->nama]);
        log::create([
            'user_id' =>Auth::guard('checkLogin')->user()->id,
            'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
            'keterangan' => "Tambah Nama Buah ".$request->nama
        ]);
        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\buah  $buah
     * @return \Illuminate\Http\Response
     */
    public function show(buah $buah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\buah  $buah
     * @return \Illuminate\Http\Response
     */
    public function edit(buah $buah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\buah  $buah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, buah $buah)
    {
        log::create([
            'user_id' =>Auth::guard('checkLogin')->user()->id,
            'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
            'keterangan' => "Ubah nama buah dari ".$buah->name." menjadi ".$request->nama
        ]);
        $buah->name = $request->nama;
        $buah->save();
        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\buah  $buah
     * @return \Illuminate\Http\Response
     */
    public function destroy(buah $buah)
    {
        log::create([
            'user_id' =>Auth::guard('checkLogin')->user()->id,
            'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
            'keterangan' => "Menghapus buah ".$buah->name
        ]);
        $buah->delete();
        return "success";
    }
}
