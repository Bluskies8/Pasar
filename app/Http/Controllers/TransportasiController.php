<?php

namespace App\Http\Controllers;

use App\Models\transportasi;
use Illuminate\Http\Request;

class TransportasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = transportasi::get();
        return view('pages.masterTransport',[
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
        transportasi::create([
            'value' => $request->value
        ]);
        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transportasi  $transportasi
     * @return \Illuminate\Http\Response
     */
    public function show(transportasi $transportasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transportasi  $transportasi
     * @return \Illuminate\Http\Response
     */
    public function edit(transportasi $transportasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transportasi  $transportasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transportasi $transportasi)
    {
        $data = transportasi::find($request->id);
        $data->value = $request->value;
        $data->save();
        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transportasi  $transportasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(transportasi $transportasi)
    {
        $transportasi->delete();
        return "success";
    }
}
