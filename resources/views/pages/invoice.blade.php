@extends('layouts.default')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <header id="content-header" class="d-flex align-items-center justify-content-between" style="height: 50px;">
        <div class="dropdown h-100"><button class="btn dropdown-toggle h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button">All Item</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">First Item</a>
                <a class="dropdown-item" href="#">Second Item</a>
                <a class="dropdown-item" href="#">Third Item</a>
            </div>
        </div>
        <button class="btn btn-sm me-2" id="generate-invoice" type="button" style="background: rgb(24, 144, 255);color: white;">Buat Nota</button>
    </header>
    <hr class="my-0">
    <div class="position-relative" style="max-width: 250px;" id="container-tanggal">
        <input class="form-control d-flex justify-content-between" id="selected-date" name="date" type="date" style="height: 32px;" data-date="" data-date-format="DD/MM/YYYY" value="<?php echo date('Y-m-d'); ?>">
        <p class="position-absolute" style="font-size: 11px;top: -9px;left: 8px;background-color: white;">Tanggal</p>
    </div>
    <div class="position-absolute table-responsive p-3 w-100" style="max-height: 88.8vh;overflow-y: auto; top: 51px; z-index: 0;">
        <table class="table table-striped" id="table-invoice">
            <thead>
                <tr class="text-center">
                    <th>ID Invoice</th>
                    <th>Lapak</th>
                    <th>Total Transaksi</th>
                    <th style="width: 45px;"></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <td colspan="2" class="text-end">Total</td>
                <td>
                    <div class="d-flex justify-content-between px-5">
                        <p class="ms-5">Rp</p>
                        <p class="thousand-separator me-5" id="data-total-sum"></p>
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
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <p class="text-end py-1" style="width: 100px;">Biaya Listrik :&nbsp;</p>
                        <select id="select-listrik" name="listrik" class="form-select form-select-sm" style="width: 173px;">
                            <option value="0">0</option>
                            <option value="25000">25.000</option>
                            <option value="40000">40.000</option>
                            <option value="50000">50.000</option>
                            <option value="75000">75.000</option>
                        </select>
                    </div>
                    <hr>
                    <div class="mt-2 p-2" style="background: var(--bs-light);border: 1px solid var(--bs-gray) ;">
                        <p class="text-center">Netto: Rp&nbsp;<span class="thousand-separator">3000</span>,-</p>
                    </div>
                    <!-- hide soalnya belum ada data -->
                    <div class="table-responsive">
                        <table class="table mb-0 modal-invoice">
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
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end" colspan="6">Total</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-total" class="biaya thousand-separator">{{$total-$parkir}}</span></div></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="6">Parkir</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-parkir" class="biaya thousand-separator">{{$parkir}}</span></div></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="6">Kuli</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-kuli" class="biaya thousand-separator">{{$kuli}}</span></div></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="6">Listrik</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-listrik" class="biaya thousand-separator"></span></div></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="6">Dibayarkan</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-dibayarkan" class="thousand-separator">{{$total+$parkir+$kuli}}</span></div></td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

@endsection
