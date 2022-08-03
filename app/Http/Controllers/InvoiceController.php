<?php

namespace App\Http\Controllers;

use App\Models\dtrans;
use App\Models\htrans;
use App\Models\invoice;
use App\Models\log;
use App\Models\netto;
use App\Models\pasar;
use App\Models\stand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
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
    public function invoice(Request $request)
    {
        $date = Carbon::createFromFormat('d-m-Y',$request->date)->format('dmY');
        $carbon = Carbon::createFromFormat('d-m-Y',$request->date)->format('Y-m-d');
        // $date = $carbon->toDateString();
        // $time = $carbon->toTimeString();
        // if($time > '07:00:00'){
            // $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 07:00:00',7);
            // $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 07:00:00',7)->addDays(1);
        // }else{
            $start = Carbon::createFromFormat('Y-m-d H:i:s',$carbon.' 07:00:00',7)->subDays(1);
            $end = Carbon::createFromFormat('Y-m-d H:i:s',$carbon.' 07:00:00',7);
        // }
        // $data = invoice::with('stand')->whereBetween('created_at',[$start,$end])->get();

        $data = invoice::with('stand')->where('id','like','%' . $date.'%')->get();
        $temp = stand::select('seller_name')->groupBy('seller_name')->get();
        foreach ($temp as $key => $value) {
            $no_stand = stand::where('seller_name',$value->seller_name)->first();
            $stand[$key]['seller_name'] = $no_stand->seller_name;
            $stand[$key]['no_stand'] = $no_stand->no_stand;
            $stand[$key]['id'] = $no_stand->id;
            $total = invoice::with('stand')->where('id','like','%' . $date.'%')->sum('dibayarkan');
            $kuli = htrans::where('stand_id',$no_stand->id)->whereBetween('created_at',[$start,$end])->sum('total_jumlah') * 1000;
            $htrans = htrans::where('stand_id',$no_stand->id)->get();
            $parkir = 0;
            foreach ($htrans as $key2 ) {
                $dtrans = dtrans::where('htrans_id',$key2->id)->sum('parkir');
                $parkir+=$dtrans;
            }
        }
        // dd($total);
        return view('pages/invoice',[
            'date'=> $carbon,
            'invoice'=> $data,
            'htrans' => $htrans,
            'stand' => $stand,
            'total' =>$total,
            'parkir' =>$parkir,
            'kuli' => $kuli,
            'data' => [
                'value' => 1
            ]
        ]);
    }
    public function generate()
    {

        $carbon = Carbon::now();
        $temp = stand::select('seller_name')->groupBy('seller_name')->get();
        foreach ($temp as $key => $value) {
            $no_stand = stand::where('seller_name',$value->seller_name)->first();
            $stand[$key]['seller_name'] = $no_stand->seller_name;
            $stand[$key]['no_stand'] = $no_stand->no_stand;
            $stand[$key]['id'] = $no_stand->id;
        }
        $dateid = $carbon->format('dmY');
        $date = $carbon->toDateString();
        $time = $carbon->toTimeString();
        $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 06:00:00',7)->subDays(1);
        $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 06:00:00',7);
        $checkinvoice = invoice::where('id','like', '%'.$dateid.'%')->count();
        // return $checkinvoice;
        if($checkinvoice > 0){
            return redirect()->back()->with(['pesan'=>'invoice sudah terbuat']);
        }
        foreach ($stand as $key) {
            if($key['seller_name']!=""){
                $total = 0;
                $temp = htrans::with('details')->whereBetween('created_at',[$start,$end])->where('stand_id',$key['id'])->get();
                foreach ($temp as $detail) {
                    foreach ($detail->details as $key2 ) {
                        // $subtotal = dtrans::where('htrans_id',$key2->id)->sum('subtotal');
                        $total += $key2->subtotal;
                    }
                }
                $jumlah = htrans::whereBetween('created_at',[$start,$end])->where('stand_id',$key['id'])->sum('total_jumlah');
                $htrans = htrans::with('details')->whereBetween('created_at',[$start,$end])->where('stand_id',$key['id'])->get();
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
                invoice::create([
                    'id' => $id,
                    'pasar_id' => Auth::guard('checkLogin')->user()->pasar_id,
                    'stand_id' => $key['id'],
                    'netto' => netto::first()->value,
                    'listrik' => 0,
                    'kuli' => $jumlah*1000,
                    'parkir' => $parkir,
                    'total' => $total,
                    'dibayarkan' => $total+($jumlah*1000)+$parkir,
                ]);
            }
        }
        log::create([
            'user_id' =>Auth::guard('checkLogin')->user()->id,
            'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
            'keterangan' => "Generate invoice"
        ]);
        return "success";
    }
    public function transactionDetails(Request $request)
    {
        $date = substr($request->id,5,8);
        $day = substr($date,0,2);
        $month = substr($date,2,2);
        $year = substr($date,4,4);
        $date = $year .'-' . $month .'-' . $day;
        $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 06:00:00',7)->subDay(1);
        $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 06:00:00',7);
        $temp = invoice::where('id',$request->id)->first();
        $lapak = $temp->stand_id;
        $htrans = htrans::with('details')->where('stand_id',$lapak)->whereBetween('created_at',[$start,$end])->get();
        // $htrans = htrans::with('details')->where('stand_id',$lapak)->get();
        $pasar = pasar::where('id',Auth::guard('checkLogin')->user()->pasar_id)->first();
        $stand = stand::where('id', $lapak)->first();
        return response()->json([
            'trans' => $htrans,
            'invoice' => $temp,
            'pasar' => $pasar,
            'stand' => $stand
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
        $start = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 06:00:00',7)->subDay(1);
        $end = Carbon::createFromFormat('Y-m-d H:i:s',$date.' 06:00:00',7);
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
        // return [
        //     'id' =>$invoice->stand_id,
        //     'total' =>$total,
        //     'parkir' =>$parkir,
        //     'jumlah' =>$invoice->kuli,
        //     'total' => $total+$invoice->kuli+$parkir
        // ];
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
        $invoice = invoice::where('id',$request->id)->first();
        $invoice->listrik = $request->listrik;
        $invoice->dibayarkan = $invoice->total+$request->listrik+$invoice->kuli+$invoice->parkir;
        $invoice->save();
        log::create([
            'user_id' =>Auth::guard('checkLogin')->user()->id,
            'pasar_id' =>Auth::guard('checkLogin')->user()->pasar_id,
            'keterangan' => "Update invoice dengan kode invoice ".$invoice->id
        ]);
        return "success update";
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
