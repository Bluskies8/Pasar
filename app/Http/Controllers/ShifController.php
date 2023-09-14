<?php

namespace App\Http\Controllers;

use App\Models\shif;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = shif::get();
        foreach ($data as $key) {
            if($key->deleted_at == null){
                $key->status = "Active";
            }else{
                $key->status = "Inactive";
            }
        }
        return view('pages.masterShift',[
            'data' => $data
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
        $cek = shif::where('number',$request->value)->first();
        if($cek){
            return "shif sudah ada";
        }else{
            $shif = new shif();
            $now = Carbon::now();
            $date = $now->format('Y-m-d');
            $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' '.$request->waktu_masuk.':00',7);
            $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' '.$request->waktu_keluar.':00',7);
            $result = $end->gt($start);
            if($result == true){
                $shif->pasar_id = Auth::guard('checkLogin')->user()->pasar_id;
                $shif->number = $request->value;
                $shif->start = $start;
                $shif->end = $end;
                $shif->save();
                return "success";
            }else{
                $shif->pasar_id = Auth::guard('checkLogin')->user()->pasar_id;
                $date = Carbon::createFromFormat('Y-m-d H:i:s',$shif->end,7)->addDays(1)->format('Y-m-d');
                $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' '.$request->waktu_keluar.':00',7);
                $shif->number = $request->value;
                $shif->start = $start;
                $shif->end = $end;
                $shif->save();
                return "success";
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\shif  $shif
     * @return \Illuminate\Http\Response
     */
    public function show(shif $shif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\shif  $shif
     * @return \Illuminate\Http\Response
     */
    public function edit(shif $shif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shif  $shif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, shif $shif)
    {
        // return $request->all();
        $now = Carbon::now();
        $date = $now->format('Y-m-d');
        $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' '.$request->waktu_masuk.':00',7);
        $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' '.$request->waktu_keluar.':00',7);
        $result = $end->gt($start);
        if($result == true){
            $shif->number = $request->value;
            $shif->start = $start;
            $shif->end = $end;
            $shif->save();
            return "success";
        }else{
            $date = Carbon::createFromFormat('Y-m-d H:i:s',$shif->end,7)->addDays(1)->format('Y-m-d');
            $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' '.$request->waktu_keluar.':00',7);
            $shif->number = $request->value;
            $shif->start = $start;
            $shif->end = $end;
            $shif->save();
            return "success";
        }
        // return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shif  $shif
     * @return \Illuminate\Http\Response
     */
    public function destroy(shif $shif)
    {
        $shif->delete();
    }
}
