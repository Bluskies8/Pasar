@extends('layouts.default')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">

    <header id="content-header" class="row mx-0" style="padding: 6px 0;">
        @if ($data['id'])
        <div class="col-12 col-lg-4 d-flex align-items-center">
            <a href="/stock"><button class="btn" style="background-color: rgb(24, 144, 255);color: var(--bs-white); text-decoration: none;">Back</button></a>
            <div class="d-flex flex-xl-row flex-lg-column flex-row align-items-center align-items-lg-start align-items-xl-center ms-3">
                <p style="white-space: nowrap">ID Transaksi :&nbsp;</p>
                <span id="id-transaksi">{{$data->id}}</span>
            </div>
        </div>
        @endif

        @if ($data['value'])
        <p class="col-12 col-md-6 col-lg-4 d-flex align-items-center justify-content-lg-start justify-content-md-center justify-content-start mt-3 mt-lg-0 order-lg-1 order-2" style="white-space: nowrap;">Nama Lapak :&nbsp;
            <span id="nama-pelapak"></span>
            <input id="pelapak" list="list-pelapak" class="form-select-sm">
            <datalist id="list-pelapak">
                @foreach ($stand as $item)
                    @if ($item['seller_name'] != "")
                        <option id = "{{$item['id']}}" value="{{$item['seller_name'] . ' - ' . $item['no_stand']}}">
                    @endif
                @endforeach
            </datalist>
        </p>
        @else
        <p class="col-md-6 col-lg-4 d-flex align-items-center justify-content-md-center justify-content-start  mt-3 mt-lg-0" style="white-space: nowrap;">Nama Lapak :&nbsp;
            <span id="nama-pelapak">{{$stand['seller_name']}}</span>
        </p>
        @endif

        @if ($data['id'])
        <div class="col-12 col-md-6 col-lg-4 d-flex align-items-center justify-content-md-center justify-content-start justify-content-lg-end mt-3 mt-lg-0">
            <p>Netto : Rp&nbsp;</p>
            <p class="thousand-separator data-netto">3000</p>
        </div>
        @else
        <div class="col-12 col-md-6 col-lg-4 d-flex align-items-center justify-content-md-center justify-content-start mt-md-3 mt-2 mt-lg-0 order-lg-2 order-3">
            <p>Netto : Rp&nbsp;</p>
            <p class="thousand-separator data-netto">3000</p>
        </div>
        @endif

        @if ($role == 4 && $data['id'] == null)
        <div class="col-12 col-lg-4 d-flex justify-content-end order-lg-3 order-1">
            <button class="btn btn-sm" id="tambah-barang" type="button" style="background-color: rgb(24, 144, 255);color: var(--bs-white);">Tambah Barang</button>
        </div>
        @endif

    </header>
    <hr class="my-0">
    <div class="table-responsive p-3 pb-0" style="max-height: 81.8vh;overflow-y: auto;">
        <table class="table table-hover mb-0" id="table-barang">
            <thead>
                <tr class="text-center">
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    @if ($role == 2)
                        <th>Bruto</th>
                        <th>Round</th>
                    @endif
                    <th>Parkir</th>
                    @if ($role == 2)
                        <th>Subtotal</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr id="tr-template" style="display: none">
                    <td class="text-center data-kode"></td>
                    <td class="data-nama"></td>
                    <td class="text-center data-jumlah"></td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>Rp</p>
                            <p class="thousand-separator data-parkir"></p>
                        </div>
                    </td>
                </tr>

                @isset($data->details)
                @foreach ($data->details as $item)
                    <tr>
                        <td class="text-center">{{$item->kode}}</td>
                        <td>{{$item->nama_barang}}</td>
                        <td class="text-center">{{$item->jumlah}}</td>
                        @if ($role == 2)
                            <td class="text-center">{{$item->bruto}}</td>
                            <td class="text-center">{{$item->round}}</td>
                        @endif
                        <td>
                            <div class="d-flex justify-content-between">
                                <p>Rp</p>
                                <p class="thousand-separator">{{$item->parkir}}</p>
                            </div>
                        </td>
                        @if ($role == 2)
                            <td>
                                <div class="d-flex justify-content-between">
                                    <p>Rp</p>
                                    <p class="thousand-separator">{{$item->subtotal}}</p>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
                @endisset

                @if ($role == 2)
                    <tfoot>
                        <tr>
                            <td class="text-end" colspan="6">Total</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-between">
                                    <p>Rp</p>
                                    <p class="thousand-separator">{{$data->total_harga}}</p> <!-- data total transaksi -->
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                @endif
            </tbody>
        </table>
    </div>
    @if ($data['id'] == null)
        <button class="btn btn-primary position-fixed m-2" id="save-detail" type="button" style="bottom: 0px;right: 0px;background: #38A34A;color: white;">Simpan Transaksi</button>
    @endif
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-barang">
        <div class="modal-dialog modal-xl modal-fullscreen-lg-down" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang Baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-0" style="overflow-y: auto;max-height: 702px;">
                    <div id="modal-row" class="row">
                        <div id="form-template" class="col-12 col-md-6 col-lg-4 mb-3" style="display: none;">
                            <div class="card">
                                <div class="card-body position-relative" style="padding-top: 20px;">
                                    <button type="button" class="btn-close btn-remove-form position-absolute" style="top: -2px; right: -2px; box-shadow: none;" aria-label="Close"></button>
                                    <div class="d-flex align-items-center mb-3">
                                        <p class="me-2">Kode</p>
                                        <select name="kode" class="form-select form-select-sm">
                                            <option value="k">Kecil</option>
                                            <option value="b">Besar</option>
                                            <option value="td">Tiga per Dua</option>
                                            <option value="dt">Dua per Tiga</option>
                                            <option value="sd">Satu per Dua</option>
                                            <option value="p">Peti</option>
                                            <option value="t">Tonase</option>
                                        </select>
                                    </div>
                                    <div class="position-relative mb-3">
                                        <!-- <input class="form-control" name="nama" type="text" style="height: 32px;"> -->

                                        @isset($buah)
                                        <input name="nama" id="nama-buah" list="list-buah" class="form-select-sm w-100">
                                        <datalist id="list-buah">
                                            @foreach ($buah as $item)
                                            <option id="{{$item->id}}" value = "{{$item->name}}"></option>
                                            @endforeach
                                        </datalist>

                                        @endisset
                                        {{-- <select name="nama" id="tipe-barang" class="form-control pt-1" style="height: 32px;">
                                            <!-- add data tipe dari db ke sini -->
                                            @foreach ($buah as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select> --}}
                                        <p class="position-absolute" style="font-size: 11px;top: -9px;left: 8px;background-color: white;">Nama Barang</p>
                                        <p class="small text-danger error-msg">asd</p>
                                    </div>
                                    <div class="position-relative mb-3">
                                        <input class="form-control" name="jumlah" type="text" style="height: 32px;" oninput="this.value = this.value.replace(/[^0-9.]/g, &#39;&#39;).replace(/(\..*?)\..*/g, &#39;$1&#39;).replace(/^0[^.]/, &#39;0&#39;);">
                                        <p class="position-absolute" style="font-size: 11px;top: -9px;left: 8px;background-color: white;">Jumlah</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="me-2">Parkir</p>
                                        <select name="parkir" class="form-select-sm form-select">
                                            <option value="0" selected>0</option>
                                            <option value="3000">3.000</option>
                                            <option value="5000">5.000</option>
                                            <option value="10000">10.000</option>
                                            <option value="20000">20.000</option>
                                            <option value="50000">50.000</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn" id="new-form" type="button" style="background: var(--bs-teal);color: white;">Tambah Form Baru</button>
                    <button class="btn" id="save-barang" type="button" data-bs-dismiss="modal" style="background: #38A34A;color: white;">Simpan Barang</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{asset('js/table-barang.js')}}"></script>
@endsection
