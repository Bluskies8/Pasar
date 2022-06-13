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
                        <div class="d-flex justify-content-between px-5">
                            <p class="ms-5">Rp</p>
                            <p class="thousand-separator me-5 data-total">{{$item->total}}</p>
                        </div>
                    </td>
                    <td class="position-relative" style="padding: 5px 4px;">
                        <button class="btn btn-sm d-flex align-items-center show-aksi position-absolute h-75 mx-auto" type="button" style="background: rgb(24, 144, 255);color: white;left: 0;right: 0;max-width: 35.5px;">
                            <i class="fas fa-bars fa-lg"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <td colspan="3" class="text-end">Total</td>
                <td>
                    <div class="d-flex justify-content-between px-5">
                        <p class="ms-5">Rp</p>
                        <p class="thousand-separator me-5" id="data-total-sum"></p>
                    </div>
                </td>
            </tfoot>
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
                    <div class="d-flex align-items-center mb-3">
                        <p class="text-end" style="white-space: nowrap; width: 100px;">Nama Lapak :&nbsp;</p>
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
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <p class="text-end py-1" style="width: 100px;">Biaya Listrik :&nbsp;</p>
                        <select id="select-listrik" name="listrik" class="form-select form-select-sm" style="width: 173px;">
                            <option value="0">0</option>
                            <option value="24000">24.000</option>
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
                                <tr>
                                    <td>k</td>
                                    <td>Import</td>
                                    <td>113</td>
                                    <td>23</td>
                                    <td class="data-round">23</td>
                                    <td><div class="d-flex justify-content-between">Rp <span class="thousand-separator">3000</span></div></td>
                                    <td><div class="d-flex justify-content-between">Rp <span class="thousand-separator">69000</span></div></td>
                                </tr>
                                <tr>
                                    <td>p</td>
                                    <td>Import</td>
                                    <td>10</td>
                                    <td>10</td>
                                    <td class="data-round">10</td>
                                    <td><div class="d-flex justify-content-between">Rp <span class="thousand-separator">3000</span></div></td>
                                    <td><div class="d-flex justify-content-between">Rp <span class="thousand-separator">3000</span></div></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end" colspan="6">Total</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-total" class="thousand-separator">72000</span></div></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="6">Kuli</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-kuli" class="thousand-separator">33000</span></div></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="6">Listrik</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-listrik" class="thousand-separator">0</span></div></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="6">Dibayarkan</td>
                                    <td><div class="d-flex justify-content-between">Rp <span id="biaya-dibayarkan" class="thousand-separator">129000</span></div></td>
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
