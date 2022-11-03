<?php

namespace App\Http\Controllers;

use App\Models\dtrans;
use App\Models\htrans;
use App\Models\invoice;
use App\Models\listrik;
use App\Models\log;
use App\Models\netto;
use App\Models\pasar;
use App\Models\stand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        return view('pages.invoice');
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
    public function invoice(Request $request)
    {
        $date = Carbon::createFromFormat('d-m-Y',$request->date)->format('dmY');
        $carbon = Carbon::createFromFormat('d-m-Y',$request->date)->format('Y-m-d');
        // $start = Carbon::createFromFormat('Y-m-d H:i:s',$carbon.' 09:00:00',7)->subDays(1);
        // $end = Carbon::createFromFormat('Y-m-d H:i:s',$carbon.' 09:00:00',7);

        $data = invoice::with('stand')->where('id','like','%' . $date.'%')->get();
        $temp = stand::select('seller_name')->groupBy('seller_name')->get();
        foreach ($temp as $key => $value) {
            $no_stand = stand::where('seller_name',$value->seller_name)->first();
            $stand[$key]['seller_name'] = $no_stand->seller_name;
            $stand[$key]['no_stand'] = $no_stand->no_stand;
            $stand[$key]['id'] = $no_stand->id;
            $total = invoice::with('stand')->where('id','like','%' . $date.'%')->sum('dibayarkan');
            // $kuli = htrans::where('stand_id',$no_stand->id)->whereBetween('created_at',[$start,$end])->sum('total_jumlah') * 1000;
            // $htrans = htrans::where('stand_id',$no_stand->id)->get();
            // $parkir = 0;
            // foreach ($htrans as $key2 ) {
            //     $dtrans = dtrans::where('htrans_id',$key2->id)->sum('parkir');
            //     $parkir+=$dtrans;
            // }
        }
        $listrik = listrik::orderBy('value')->get();
        $all = [
            'date'=> $carbon,
            'invoice'=> $data,
            'stand' => $stand,
            'total' =>$total,
            'listrik' => $listrik,
        ];
        return view('pages.invoice',[
            'date'=> $carbon,
            'invoice'=> $data,
            'stand' => $stand,
            'total' =>$total,
            'listrik' => $listrik,
        ]);
    }
    public function generate($idlapak, Request $request)
    {
        $carbon = Carbon::now();
        $dateid = $carbon->format('dmY');
        $date = $carbon->toDateString();
        $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7)->subDays(1);
        $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7);
        $checkinvoice = invoice::where('id','like', '%'.$dateid.'%')->where('stand_id',$idlapak)->where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->count();
        if($checkinvoice > 0){
            return redirect()->back()->with(['pesan'=>'invoice sudah terbuat']);
        }
        // foreach ($stand as $key) {
            // if($key['seller_name']!=""){
                $total = 0;
                $temp = htrans::with('details')->whereBetween('created_at',[$start,$end])->where('stand_id',$idlapak)->get();
                foreach ($temp as $detail) {
                    foreach ($detail->details as $key2 ) {
                        $total += $key2->subtotal;
                    }
                }
                $jumlah = htrans::whereBetween('created_at',[$start,$end])->where('stand_id',$idlapak)->sum('total_jumlah');
                $htrans = htrans::with('details')->whereBetween('created_at',[$start,$end])->where('stand_id',$idlapak)->get();
                $parkir = 0;
                foreach ($htrans as $key2 ) {
                    $dtrans = dtrans::where('htrans_id',$key2->id)->sum('parkir');
                    $parkir+=$dtrans;
                }
                $count = invoice::where('pasar_id',Auth::guard('checkLogin')->user()->pasar_id)->count()+1;
                $id = "INV".str_pad(Auth::guard('checkLogin')->user()->pasar_id,2,"0",STR_PAD_LEFT).$dateid.str_pad($count,3,"0",STR_PAD_LEFT);
                // return [
                //     'id' =>$key['id'],
                //     'total' =>$total,
                //     'parkir' =>$parkir,
                //     'jumlah' =>$jumlah,
                //     'total' => $total+($jumlah*1000)+$parkir
                // ];
                $invo = invoice::create([
                    'id' => $id,
                    'pasar_id' => Auth::guard('checkLogin')->user()->pasar_id,
                    'stand_id' => $idlapak,
                    'netto' => netto::first()->value,
                    'listrik' => $request->listrik,
                    'kuli' => $jumlah*1000,
                    'parkir' => $parkir,
                    'total' => $total,
                    'dibayarkan' => $total+$parkir+$request->listrik,
                ]);
            // }
        // }
        log::create([
            'user_id' =>Auth::guard('checkLogin')->user()->id,
            'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
            'keterangan' => "Generate invoice ".$invo->id
        ]);
        return "success";
    }
    public function transactionDetails(Request $request)
    {
        // $date = substr($request->id,5,8);
        // return $request->all();
        if($request->invoice){
            $listrik = invoice::where('id',$request->invoice)->first()->listrik;
        }else{
            $listrik = 0;
        }
        $carbon = Carbon::now();
        $date = $carbon->toDateString();
        $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7)->subDay(1);
        $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7);
        // return $date;
        $lapak = $request->stand_id;
        $htrans = htrans::with('details')->where('stand_id',$lapak)->whereBetween('created_at',[$start,$end])->get();
        // $htrans = htrans::with('details')->where('stand_id',$lapak)->get();
        $pasar = pasar::where('id',Auth::guard('checkLogin')->user()->pasar_id)->first();
        $stand = stand::where('id', $lapak)->first();
        $total = 0;
        $parkir = 0;
        $temp = htrans::with('details')->whereBetween('created_at',[$start,$end])->where('stand_id',$request->stand_id)->get();
        foreach ($temp as $detail) {
            foreach ($detail->details as $key2 ) {
                $total += $key2->subtotal;
                $parkir+=$key2->parkir;
            }
        }
        $kuli = htrans::where('stand_id',$request->stand_id)->whereBetween('created_at',[$start,$end])->sum('total_jumlah') * 1000;
        return response()->json([
            'trans' => $htrans,
            'pasar' => $pasar,
            'stand' => $stand,
            'total' =>$total,
            'parkir' => $parkir,
            'kuli' => $kuli,
            'dibayarkan' => $total+$parkir,
            'listrik' => $listrik,
        ]);
    }
    public function invoicedetails($id)
    {
        // $data = invoice::with('stand')->whereBetween('created_at',[$request->start,$request->end])->get();
        $date = substr($id,5,8);
        $day = substr($date,0,2);
        $month = substr($date,2,2);
        $year = substr($date,4,4);
        $date = $year .'-' . $month .'-' . $day;
        $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7)->subDay(1);
        $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 09:00:00',7);
        $invoice = invoice::with(['stand'])->where('id',$id)->first();
        $trans = htrans::with('details')->where('stand_id',$invoice->stand_id)->whereBetween('created_at',[$start,$end])->get();
        // $total = htrans::where('stand_id',$invoice->stand_id)->whereBetween('created_at',[$start,$end])->sum('total_harga');
        $total = 0;
        $parkir = 0;
        $temp = htrans::with('details')->whereBetween('created_at',[$start,$end])->where('stand_id',$invoice->stand_id)->get();
        foreach ($temp as $detail) {
            foreach ($detail->details as $key2 ) {
                $total += $key2->subtotal+$key2->parkir;
                $parkir+=$key2->parkir;
            }
        }
        $kuli = htrans::where('stand_id',$invoice->stand_id)->whereBetween('created_at',[$start,$end])->sum('total_jumlah') * 1000;

        $pasar = pasar::where('id',Auth::guard('checkLogin')->user()->pasar_id)->first();
        $stand = stand::where('id', $invoice->stand_id)->first();
        return view('pages.invoiceDetail',[
            'invoice' => $invoice,
            'trans' => $trans,
            'total' =>$total,
            'parkir' => $parkir,
            'pasar' => $pasar,
            'kuli' => $kuli,
            'stand' => $stand
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $check = listrik::where('value',$request->listrik)->first();
        if($check){
            $invoice = invoice::where('id',$request->id)->first();
            $invoice->listrik = $request->listrik;
            $invoice->dibayarkan = $invoice->total+$request->listrik+$invoice->parkir;
            $invoice->save();
            log::create([
                'user_id' =>Auth::guard('checkLogin')->user()->id,
                'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
                'keterangan' => "Update invoice dengan kode invoice ".$invoice->id
            ]);
            return "success update";
        }else{
            return "err listrik";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoice $invoice)
    {
        //
    }
}
