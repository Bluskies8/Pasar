<?php

namespace App\Http\Controllers;

use App\Models\listrik;
use Illuminate\Http\Request;

class ListrikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = listrik::orderBy('value')->get();
        return view('pages.masterListrik',[
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
        listrik::create(['value'=> $request->value]);
        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\listrik  $listrik
     * @return \Illuminate\Http\Response
     */
    public function show(listrik $listrik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\listrik  $listrik
     * @return \Illuminate\Http\Response
     */
    public function edit(listrik $listrik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\listrik  $listrik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, listrik $listrik)
    {
        $listrik->value = $request->value;
        $listrik->save();
        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\listrik  $listrik
     * @return \Illuminate\Http\Response
     */
    public function destroy(listrik $listrik)
    {
        $listrik->delete();
        return "success";
    }
}
