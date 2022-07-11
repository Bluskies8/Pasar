<?php

namespace App\Http\Controllers;

use App\Models\dtrans;
use App\Models\htrans;
use App\Models\invoice;
use App\Models\Retribusi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetribusiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carbon = Carbon::now();
        $date = $carbon->toDateString();
        $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 06:00:00',7)->subDays(1);
        $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 06:00:00',7);
        $total = htrans::whereBetween('created_at',[$start,$end])->sum('total_harga');
        $kuli = htrans::whereBetween('created_at',[$start,$end])->sum('total_jumlah')*1000;
        $htrans = htrans::with('details')->whereBetween('created_at',[$start,$end])->get();
        $listrik = invoice::whereBetween('created_at',[$start,$end])->sum('listrik');
        $parkir = 0;
        foreach ($htrans as $key2 ) {
            $dtrans = dtrans::where('htrans_id',$key2->id)->sum('parkir');
            $parkir+=$dtrans;
        }
        $total = $total-$parkir;
        return view('pages.retribusi',[
            'retribusi'=>$total,
            'kuli' => $kuli,
            'listrik' => $listrik,
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
        retribusi::create([
            'pasar_id' => Auth::guard('checkLogin')->user()->pasar_id,
            'retribusi' => $request->retribusi,
            'listrik' => $request->listrik,
            'kuli' => $request->kuli,
            'sampah' => $request->sampah,
            'ponten_siang' => $request->ponten_siang,
            'ponten_malam' => $request->ponten_malam,
            'parkir_siang' => $request->parkir_siang,
            'parkir_malam' => $request->parkir_malam,
            'motor_siang' => $request->motor_siang,
            'motor_malam' => $request->motor_malam,
        ]);
        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Retribusi  $retribusi
     * @return \Illuminate\Http\Response
     */
    public function show(Retribusi $retribusi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Retribusi  $retribusi
     * @return \Illuminate\Http\Response
     */
    public function edit(Retribusi $retribusi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Retribusi  $retribusi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retribusi $retribusi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Retribusi  $retribusi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retribusi $retribusi)
    {
        //
    }
}
