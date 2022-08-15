@extends('layouts.default')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .table-invoice-detail tfoot td {
            border-bottom: none;
            padding-top: 0!important;
            padding-bottom: 0!important;
        }
    </style>
    <header id="content-header" class="d-flex align-items-center justify-content-between" style="height: 50px;">
        <div class="dropdown h-100" disabled>
            <div class="dropdown-menu" >
                <a class="dropdown-item" href="#">First Item</a>
                <a class="dropdown-item" href="#">Second Item</a>
                <a class="dropdown-item" href="#">Third Item</a>
            </div>
        </div>
        <button class="btn btn-sm me-2" id="generate-invoice" type="button" style="background: #38A34A;color: white;">Buat Nota</button>
    </header>
    <hr class="my-0">
    <div class="position-relative" style="max-width: 250px;" id="container-tanggal">
        <input class="form-control d-flex justify-content-between" id="selected-date" name="date" type="date" style="height: 32px;" data-date="{{$date}}" data-date-format="DD/MM/YYYY" value="{{$date}}">
        <p class="position-absolute" style="font-size: 11px;top: -9px;left: 8px;background-color: white;">Tanggal</p>
    </div>
    <div class="table-responsive p-3 w-100">
        <table class="table table-striped" id="table-invoice">
            <thead>
                <tr class="text-center">
                    <th>ID Invoice</th>
                    <th>Lapak</th>
                    <th>Total Transaksi</th>
                    <th style="min-width: 45px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice as $item)
                    <tr id = "{{$item->stand->id}}">
                        <td class='cell-id text-center'>{{$item->id}} </td>
                        <td class='text-center'>{{$item->stand->seller_name}}</td>
                        <td>
                            <div class='d-flex justify-content-between px-5'>
                                <p class='ms-lg-5 ms-0'>Rp</p><p class='thousand-separator me-lg-5 me-0 data-total'>{{$item->dibayarkan}}</p>
                            </div>
                        </td>
                        <td class='position-relative' style='padding: 5px 4px;'>
                            <button class='btn btn-sm d-flex align-items-center show-aksi position-absolute h-75 mx-auto' type='button' style='background: #38A34A;color: white;left: 0;right: 0;max-width: 35.5px;'><i class='fas fa-bars fa-lg'></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <td colspan="2" class="text-end">Total</td>
                <td>
                    <div class="d-flex justify-content-between px-5">
                        <p class="ms-5">Rp</p>
                        <p class="thousand-separator me-5" id="data-total-sum">{{$total}}</p>
                    </div>
                </td>
                <td></td>
            </tfoot>
        </table>
    </div>
    <ul class="list-unstyled py-2 px-1" id="list-aksi">
        <li id="item-detail" class="px-1">Tampilkan Nota</li>
        <li id="item-update" class="px-1">Ubah Nota</li>
    </ul>

    <div class="modal fade" role="dialog" tabindex="-1" id="modal-invoice">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Nota</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" placeholder="harga tambahan">
                    <div class="d-flex align-items-center mb-3">
                        <p class="text-end" style="white-space: nowrap; width: 100px;">Nama Lapak :&nbsp;</p>
                        <span id="nama-lapak"></span>

                        <input id="pelapak" list="list-pelapak" class="form-select-sm">
                        <datalist id="list-pelapak">
                            @foreach ($stand as $item)
                                @if ($item['seller_name'] != "")
                                     <option id="{{$item['id']}}" value="{{$item['seller_name'] . ' - ' . $item['no_stand']}}">
                                @endif
                            @endforeach
                        </datalist>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <p class="text-end py-1" style="white-space: nowrap; width: 100px;">Biaya Listrik :&nbsp;</p>
                        <select id="select-listrik" name="listrik" class="form-select form-select-sm" style="width: 173px;">
                            <option value="0">0</option>
                            @foreach ($listrik as $item)
                                <option value="{{$item->value}}" class="thousand-separator">{{$item->value}}</option>
                            @endforeach
                        </select>
                        <p class="small text-danger error-msg-listrik"></p>
                    </div>
                    <hr>
                    <div class="mt-2 p-2" style="background: var(--bs-light);border: 1px solid var(--bs-gray) ;">
                        <p class="text-center">Netto: Rp&nbsp;<span class="thousand-separator">3000</span>,-</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 table-invoice-detail">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
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
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end w-75" colspan="7">Total</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-total" class="biaya thousand-separator">{{$total}}</span></div></td>
                                </tr>
                                <tr>
                                    <td class="text-end w-75" colspan="7">Parkir</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-parkir" class="biaya thousand-separator">{{$parkir}}</span></div></td>
                                </tr>
                                {{-- <tr>
                                    <td class="text-end w-75" colspan="7">Kuli</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-kuli" class="biaya thousand-separator">{{$kuli}}</span></div></td>
                                </tr> --}}
                                <tr>
                                    <td class="text-end w-75" colspan="7">Listrik</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-listrik" class="biaya thousand-separator">0</span></div></td>
                                    <!-- saya tidak tahu backend -->
                                </tr>
                                <tr>
                                    <td class="text-end w-75" colspan="7">Dibayarkan</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-dibayarkan" class="thousand-separator">{{$total+$parkir}}</span></div></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-save" type="button" style="background: #38A34A;color: white;">Save</button>
                </div>
            </div>
        </div>

    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{asset('js/table-invoice.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

@endsection
