@extends('layouts.default')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <header id="content-header" class="d-flex align-items-center justify-content-between" style="height: 50px;">
        <div class="dropdown h-100"><button class="btn dropdown-toggle h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="visibility: hidden;">All Item</button>
            <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
        </div>
        @if ($role==4 && $check)
        <a href="/{{strtolower(auth()->guard('checkLogin')->user()->role->name)}}/details">
            <button class="btn btn-sm me-2" id="tambah-transaksi" type="button" style="">Transaksi Baru</button>
        </a>
        @endif
    </header>
    <hr class="my-0">
    <div class="table-responsive p-3" style="max-height: 81.8vh;overflow-y: auto;">
        <table class="table table-hover" id="table-transaksi">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Lapak</th>
                    <th>Checker</th>
                    <th>Tanggal</th>
                    <th>Total Transaksi</th>
                    <th>Deleted_at</th>
                    <th style="min-width: 45px;"></th>
                </tr>
            </thead>
            <tbody>
                @isset($data)
                @foreach ($data as $item)
                @if ($item['deleted']!=null)
                    <tr class = "disabled">
                @else
                    <tr>
                @endif
                    <td class="cell-id text-center">{{$item['id_trans']}}</td>
                    <td class="text-center">{{$item['nama']}}</td>
                    <td class="text-center">{{$item['checker']}}</td>
                    <td class="text-center">{{$item['tanggal']}}</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>Rp</p>
                            <p class="thousand-separator">{{$item['total']}}</p>
                        </div>
                    </td>
                    <td class="text-center">{{$item['deleted']}}</td>
                    <td class="position-relative" style="padding: 5px 4px;">
                        <button class="btn btn-sm d-flex align-items-center show-aksi position-absolute h-75 mx-auto" type="button" style="background: #38A34A;color: white;left: 0;right: 0;max-width: 35.5px;"><i class="fas fa-bars fa-lg"></i></button>
                    </td>
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
    </div>
    <ul class="list-unstyled py-2 px-1" id="list-aksi">
        <li id="item-detail" class="px-1">Lihat Detail</li>
        @if ($role <= 3)
            <li id="item-delete" class="px-1">Hapus Transaksi</li>
        @endif
    </ul>

    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{asset('js/table-transaksi.js')}}"></script>
    <script src="{{asset('js/table-barang.js')}}"></script>
@endsection

