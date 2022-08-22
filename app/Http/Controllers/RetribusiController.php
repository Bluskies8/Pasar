<?php

namespace App\Http\Controllers;

use App\Models\dtrans;
use App\Models\htrans;
use App\Models\invoice;
use App\Models\log;
use App\Models\Retribusi;
use App\Models\retribusitambahan;
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
    public function index(Request $request)
    {
        $retribusi = retribusi::with('tambahan')->whereDate('created_at', $request->date)->first();
        $total = 0;
        if($retribusi){
            $total = $retribusi->retribusi-$retribusi->kuli-$retribusi->sampah+$retribusi->ponten_siang+$retribusi->ponten_malam+$retribusi->parkir_siang+$retribusi->parkir_malam+$retribusi->motor_siang+$retribusi->motor_malam;
            foreach ($retribusi->tambahan as $key) {
                $total -= $key->value;
            }
        }
        $all = retribusi::get();
        return view('pages.retribusi',[
            'date' => $request->date,
            'data' => $retribusi,
            'total' => $total,
            'all' => $all
        ]);
    }
    public function getRetri(Request $request)
    {
        // $carbon = Carbon::now();
        // $date = $carbon->toDateString();
        $date = Carbon::createFromFormat('Y-m-d',$request->date)->format('dmY');
        $listrik = invoice::where('id','like','%' . $date.'%')->sum('listrik');
        $total = invoice::where('id','like','%' . $date.'%')->sum('dibayarkan');
        $kuli = invoice::where('id','like','%' . $date.'%')->sum('kuli');
        return [
            'retribusi'=>$total,
            'kuli' => $kuli,
            'listrik' => $listrik,
            'total' => $total-$kuli
        ];
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
        $retri = retribusi::create([
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
        if($request->tambahan){
            foreach ($request->tambahan as $key) {
                $t = retribusitambahan::create([
                    'retribusi_id' => $retri->id,
                    'type' => $key['tipe'],
                    'name' => $key['nama'],
                    'value' => $key['nominal']
                ]);
            }
        }
        log::create([
            'user_id' =>Auth::guard('checkLogin')->user()->id,
            'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
            'keterangan' => "Input retribusi dengan kode ".$retri->id
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
