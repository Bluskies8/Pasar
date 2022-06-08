@extends('layouts.default')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">

    <header id="content-header" class="d-flex align-items-center justify-content-between" style="height: 50px;">
        <div class="dropdown h-100"><button class="btn dropdown-toggle h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button">All Item</button>
            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
        </div>
    </header>
    <hr class="my-0">
    <div class="table-responsive p-3" style="max-height: 81.8vh;overflow-y: auto;">
        <table class="table table-striped" id="table-transaksi">
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
                <tr>
                    <td class="cell-id">ID0001</td>
                    <td>24 Mei 2022</td>
                    <td>Wawan</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>Rp</p>
                            <p class="thousand-separator">73000</p>
                        </div>
                    </td>
                    <td class="position-relative" style="padding: 5px 4px;"><button class="btn btn-sm d-flex show-aksi position-absolute mx-auto" type="button" style="background: rgb(24, 144, 255);color: white;left: 0;right: 0;max-width: 35.5px;"><i class="fas fa-bars fa-l"></i></button></td>
                </tr>
                <tr>
                    <td class="cell-id">ID0002</td>
                    <td>24 Mei 2022</td>
                    <td>Bison</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>Rp</p>
                            <p class="thousand-separator">51000</p>
                        </div>
                    </td>
                    <td class="position-relative" style="padding: 5px 4px;"><button class="btn btn-sm d-flex show-aksi position-absolute mx-auto" type="button" style="background: rgb(24, 144, 255);color: white;left: 0;right: 0;max-width: 35.5px;"><i class="fas fa-bars fa-l"></i></button></td>
                </tr>
                <tr>
                    <td class="cell-id">ID0003</td>
                    <td>24 Mei 2022</td>
                    <td>Kevin</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>Rp</p>
                            <p class="thousand-separator">69000</p>
                        </div>
                    </td>
                    <td class="position-relative" style="padding: 5px 4px;"><button class="btn btn-sm d-flex show-aksi position-absolute mx-auto" type="button" style="background: rgb(24, 144, 255);color: white;left: 0;right: 0;max-width: 35.5px;"><i class="fas fa-bars fa-l"></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
    <ul class="list-unstyled py-2 px-1" id="list-aksi">
        <li id="item-detail" class="px-1">Tampilkan Nota</li>
    </ul>

    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{asset('js/table-transaksi.js')}}"></script>
    <script src="{{asset('js/table-barang.js')}}"></script>

@endsection
