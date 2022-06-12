@extends('layouts.default')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">

    <header id="content-header" class="d-flex align-items-center justify-content-between" style="height: 50px;">
        <div class="dropdown h-100"><button class="btn dropdown-toggle h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button">All Item</button>
            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
        </div>
        <button class="btn btn-sm me-2" id="generate-invoice" type="button" style="background: rgb(24, 144, 255);color: white;">Generate Invoice</button>
    </header>
    <hr class="my-0">
    <div class="table-responsive p-3" style="max-height: 81.8vh;overflow-y: auto;">
        <table class="table table-striped" id="table-invoice">
            <thead>
                <tr class="text-center">
                    <th>ID Invoice</th>
                    <th>Tanggal</th>
                    <th>Lapak</th>
                    <th>Total Transaksi</th>
                    <th style="width: 45px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice as $item)
                <tr>
                    <td class="cell-id text-center">{{$item->id}}</td>
                    <td class="text-center">{{$item->created_at->format('d-M-Y')}}</td>
                    <td class="text-center">{{$item->stand->seller_name}}</td>
                    <td>
                        <div class="d-flex justify-content-around">
                            <p>Rp</p>
                            <p class="thousand-separator">{{$item->total}}</p>
                        </div>
                    </td>
                    <td class="position-relative" style="padding: 5px 4px;">
                        <button class="btn btn-sm d-flex align-items-center show-aksi position-absolute h-75 mx-auto" type="button" style="background: rgb(24, 144, 255);color: white;left: 0;right: 0;max-width: 35.5px;"><i class="fas fa-bars fa-lg"></i></button>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <ul class="list-unstyled py-2 px-1" id="list-aksi">
        <li id="item-detail" class="px-1">Tampilkan Nota</li>
    </ul>

    <div class="modal fade" role="dialog" tabindex="-1" id="modal-invoice">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Generate Invoice</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" placeholder="harga tambahan">
                    <p class="d-flex align-items-center mb-3" style="white-space: nowrap;">Nama Lapak :&nbsp;
                        @if ($data['value'])
                            <span id="nama-pelapak"></span>
                            <input id="pelapak" list="list-pelapak" class="form-select-sm">
                            <datalist id="list-pelapak">
                                @foreach ($stand as $item)
                                    @if ($item['seller_name'] != "")
                                        <option id = "{{$item['id']}}" value="{{$item['seller_name'] . ' - ' . $item['no_stand']}}">
                                    @endif
                                @endforeach
                            </datalist>
                        @else
                            <span id="nama-pelapak">{{$stand['seller_name']}}</span>
                        @endif
                    </p>
                    <div class="mb-3 d-flex" placeholder="Tipe Tambahan">
                        <div>
                            <p class="text-end py-1">Biaya Tambahan :&nbsp;</p>
                        </div>
                        <div id="list-tambahan" class="d-flex flex-column">
                            <div id="clone-biaya" class="d-none align-items-center mb-2">
                                <input type="text" class="tipe-tambahan me-2" placeholder="tipe tambahan">
                                <input type="text" class="biaya-tambahan me-2" placeholder="harga tambahan">
                                <button class="btn btn-sm add-tambahan me-2" type="button" style="background: rgb(24, 144, 255);color: white;"><i class="fas fa-plus-circle"></i></button>
                                <button class="btn btn-danger btn-sm delete-tambahan" type="button" style="display: none;"><i class="fas fa-times-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-2 p-2" style="background: var(--bs-light);border: 1px solid var(--bs-gray) ;">
                        <p class="text-center">Netto: Rp&nbsp;<span class="thousand-separator">3000</span>,-</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Bruto</th>
                                    <th>Round</th>
                                    <th>Parkir</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>k</td>
                                    <td>Import</td>
                                    <td class="text-end">113</td>
                                    <td class="text-end">23</td>
                                    <td class="text-end">23</td>
                                    <td>Rp 3000</td>
                                    <td>Rp 69000</td>
                                </tr>
                                <tr>
                                    <td>p</td>
                                    <td>Import</td>
                                    <td class="text-end">10</td>
                                    <td class="text-end">10</td>
                                    <td class="text-end">10</td>
                                    <td>Rp 3000</td>
                                    <td>Rp 3000</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end" colspan="6">Total</td>
                                    <td>Rp 72000<br></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-save" type="button" style="background: rgb(24, 144, 255);color: white;" data-bs-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{asset('js/table-invoice.js')}}"></script>

@endsection
