@extends('layouts.default')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <header id="content-header" class="d-flex align-items-center justify-content-between" style="height: 50px;">

        <div class="dropdown h-100"><button class="btn dropdown-toggle h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="visibility: hidden;">All Item</button>
            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
        </div>

        <button class="btn btn-sm me-2" id="tambah-transaksi" type="button" style="">Tambah Stand Baru</button>
    </header>
    <div id="denah-pasar">
        {{-- <table class="table">
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
                    <td class="td-2" id="{{$standc[0]['no_stand']}}">{{$standc[0]['no_stand']}}<br><span class="nama-pt">{{$standc[0]['badan_usaha']}}</span><br><span class="nama-lapak">{{$standc[0]['seller_name']}}</span></td>
                </tr>
                <tr>
                    <td class="td-2" id = "{{$standc[1]['no_stand']}}">{{$standc[1]['no_stand']}}<br><span class="nama-pt">{{$standc[1]['badan_usaha']}}</span><br><span class="nama-lapak">{{$standc[1]['seller_name']}}</span></td>
                    <td class="td-2 py-4 px-5" colspan="31" rowspan="3"><div class="h-100 d-flex justify-content-center align-items-center" style="background-color: lightgreen"><h1>Lahan Parkir</h1></div></td>
                </tr>
                <tr>
                    <td class="td-2" id = "{{$standc[2]['no_stand']}}">{{$standc[2]['no_stand']}}<br><span class="nama-pt">{{$standc[2]['badan_usaha']}}</span><br><span class="nama-lapak">{{$standc[2]['seller_name']}}</span></td>
                </tr>
                <tr>
                    <td class="td-2" id = "{{$standc[3]['no_stand']}}">{{$standc[3]['no_stand']}}<br><span class="nama-pt">{{$standc[3]['badan_usaha']}}</span><br><span class="nama-lapak">{{$standc[3]['seller_name']}}</span></td>
                </tr>
                <tr>
                    <td class="td-2" id = "{{$standc[4]['no_stand']}}">{{$standc[4]['no_stand']}}<br><span class="nama-pt">{{$standc[4]['badan_usaha']}}</span><br><span class="nama-lapak">{{$standc[4]['seller_name']}}</span></td>
                    @foreach ($standa as $item)
                        <td id="{{$item->no_stand}}" rowspan="2"><div class="d-flex flex-column justify-content-between h-100">{{$item->no_stand}}<span class="nama-pt">{{$item->badan_usaha}}</span><span class="nama-lapak">{{$item->seller_name}}</span></div></td>
                    @endforeach
                    <td class="td-2" rowspan="2">Tangga<br>ke atas</td>
                    <td class="td-2" rowspan="2">Ponten</td>
                    <td class="td-2" rowspan="2">Sampah</td>
                </tr>
                <tr>
                    <td class="td-2" id = "{{$standc[5]['no_stand']}}">{{$standc[5]['no_stand']}}<br><span class="nama-pt">{{$standc[5]['badan_usaha']}}</span><br><span class="nama-lapak">{{$standc[5]['seller_name']}}</span></td>
                </tr>
            </tbody>
        </table> --}}
    </div>
    <ul class="list-unstyled py-2" id="list-aksi">
        <li id="item-detail" class="px-2">Lihat Detail</li>
        <li id="item-delete" class="px-2">Hapus Stand</li>
    </ul>
    <div id="modal-vendor" role="dialog" tabindex="-1" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Stand <span id="nama-stand"></span></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="position-relative mb-3">
                        <input id="input-noStand" name = "no_stand" type="text" class="w-100 ps-2" style="height: 32px;" disabled/>
                        <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Nomer Stand</p>
                    </div>
                    <div class="position-relative mb-3">
                        <input id="input-namaPT" name = "badan_usaha" type="text" class="w-100 ps-2" style="height: 32px;" />
                        <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Nama Lapak</p>
                    </div>
                    <div class="position-relative mb-3">
                        <input id="input-pemilik"  name = "seller_name" type="text" class="w-100 ps-2" style="height: 32px;" />
                        <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Nama Pemilik</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id = "btn-save" type="button" data-bs-dismiss="modal" style="background: #38A34A;color: white;">Save</button>
                </div>
            </div>
        </div>
    </div>

<script src="{{asset('js/vendor.js')}}"></script>
<script>
    $(document).ready(function() {
        console.log(window.location.protocol.substr(0,4));
        // $('#denah-pasar').load(window.location.origin  + "/" + window.location.pathname.split('/')[1] + '/vendorTable/');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: "get",
            url: window.location.origin  + "/" + window.location.pathname.split('/')[1] + '/vendorTable/',
            before: function(){

            },
            success: function(data) {
                console.log(data);
                // $('#denah-pasar').load(window.location.origin + "/" + window.location.pathname.split('/')[1] + '/vendorTable/');
                $('#denah-pasar').replaceWith(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
</script>
@endsection
