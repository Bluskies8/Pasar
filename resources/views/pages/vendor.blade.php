@extends('layouts.default')
@section('content')

<div class="d-flex align-items-center h-100 px-5">
    <div class="table-responsive" id="denah-pasar">
        <table class="table">
            <tbody>
                <tr>
                    <td class="td-2">D1<br><span>Warung</span></td>
                    @foreach ($standb as $item)
                        <td id="{{$item->no_stand}}" rowspan="2"><div class="d-flex flex-column justify-content-between h-100">{{$item->no_stand}}<span class="nama-pt">{{$item->badan_usaha}}</span><span class="nama-lapak">{{$item->seller_name}}</span></div></td>
                    @endforeach
                    <td class="td-2" rowspan="2">D2<br><span>Warung</span></td>
                    <td class="td-2" rowspan="2">D3<br><span>Koperasi</span></td>
                    <td class="td-2" rowspan="2">Tangga<br>ke atas</td>
                    <td class="td-2" rowspan="2">Tandon</td>
                </tr>
                <tr>
                    <td class="td-2">{{$standc[0]['no_stand']}}<br><span class="nama-pt">{{$standc[0]['badan_usaha']}}</span><br><span class="nama-lapak">{{$standc[0]['seller_name']}}</span></td>
                </tr>
                <tr>
                    <td class="td-2">{{$standc[1]['no_stand']}}<br><span class="nama-pt">{{$standc[1]['badan_usaha']}}</span><br><span class="nama-lapak">{{$standc[1]['seller_name']}}</span></td>
                    <td class="td-2 py-4 px-5" colspan="31" rowspan="3"><div class="h-100 d-flex justify-content-center align-items-center" style="background-color: lightgreen"><h1>Lahan Parkir</h1></div></td>
                </tr>
                <tr>
                    <td class="td-2">{{$standc[2]['no_stand']}}<br><span class="nama-pt">{{$standc[2]['badan_usaha']}}</span><br><span class="nama-lapak">{{$standc[2]['seller_name']}}</span></td>
                </tr>
                <tr>
                    <td class="td-2">{{$standc[3]['no_stand']}}<br><span class="nama-pt">{{$standc[3]['badan_usaha']}}</span><br><span class="nama-lapak">{{$standc[3]['seller_name']}}</span></td>
                </tr>
                <tr>
                    <td class="td-2">{{$standc[4]['no_stand']}}<br><span class="nama-pt">{{$standc[4]['badan_usaha']}}</span><br><span class="nama-lapak">{{$standc[4]['seller_name']}}</span></td>
                    @foreach ($standa as $item)
                        <td id="{{$item->no_stand}}" rowspan="2"><div class="d-flex flex-column justify-content-between h-100">{{$item->no_stand}}<span class="nama-pt">{{$item->badan_usaha}}</span><span class="nama-lapak">{{$item->seller_name}}</span></div></td>
                    @endforeach
                    <td class="td-2" rowspan="2">Tangga<br>ke atas</td>
                    <td class="td-2" rowspan="2">Ponten</td>
                    <td class="td-2" rowspan="2">Sampah</td>
                </tr>
                <tr>
                    <td class="td-2">C4<br><span class="nama-pt"></span><br><span class="nama-lapak"></span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div id="modal-vendor" role="dialog" tabindex="-1" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Stand <span id="nama-stand"></span></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="position-relative mb-3">
                    <input id="input-namaPT" type="text" class="w-100 ps-2" style="height: 32px;" />
                    <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Nama Lapak</p>
                </div>
                <div class="position-relative mb-3">
                    <input id="input-pemilik" type="text" class="w-100 ps-2" style="height: 32px;" />
                    <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Nama Pemilik</p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal" style="background: rgb(24, 144, 255);color: white;">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/vendor.js')}}"></script>
@endsection
