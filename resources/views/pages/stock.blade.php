@extends('layouts.default')

@section('content')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css"> --}}
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
    @if(session('error'))
        <div class="alert alert-success" role="alert" id="check-confirm">
            <div class="d-flex justify-content-between">
                <span class="alert-confirm"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </div>
        </div>
    @endif

    <hr class="my-0">
    <div class="d-flex justify-content-between">
        <div class="position-relative mt-3 ms-3" style="max-width: 250px;" id="container-tanggal">
            @if ($role <= 3)
                <input class="form-control d-flex justify-content-between" name="month" type="month" data-date="{{ date('M-Y'); }}" style="height: 32px; width: 200px;" value="{{ date('Y-m'); }}">
                <p class="position-absolute" style="font-size: 11px;top: -9px;left: 8px;background-color: white;">Tanggal</p>
            @endif
                <input type="hidden" id="selected-date" name="month" data-date="{{ date('M-Y'); }}" value="{{ date('Y-m'); }}">
        </div>
        <div class="d-flex mt-3 me-3">
            <input class="form-control" type="search" name="search" id="input-search" style="height: 32px;" placeholder="Search">
            <button id="btn-search" type="button" class="btn btn-primary btn-sm ms-2">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </div>
    <div id="table-stock"></div>
    <ul class="list-unstyled py-2" id="list-aksi">
        <li id="item-detail" class="px-2">Lihat Detail</li>
        @if ($role <= 3)
            <li id="item-delete" class="px-2">Hapus Transaksi</li>
        @endif
    </ul>

    {{-- <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script> --}}
    <script src="{{ asset('js/stock.js') }}"></script>
@endsection

