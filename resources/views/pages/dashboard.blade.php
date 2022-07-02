@extends('layouts.default')

@section('content')

<div class="h-100">
    <ul role="tablist" class="nav nav-tabs px-3" style="height: 50px;">
        <li role="presentation" class="nav-item mx-3" style="height: initial"><a role="tab" data-bs-toggle="tab" class="nav-link active px-0" href="#tab-1">Dasboard</a></li>
        <li role="presentation" class="nav-item mx-3" style="height: initial"><a role="tab" data-bs-toggle="tab" class="nav-link px-0" href="#tab-2">Logs</a></li>
    </ul>
    <div class="tab-content" style="height: calc(100vh - 100px); overflow-y: auto;">
        <div role="tabpanel" class="tab-pane active py-5 px-4" id="tab-1">
            <div class="card">
                <div class="card-body pb-0">
                    <h2 class="card-title" style="color: rgb(24, 144, 255);">Laporan Biaya Kuli</h2>
                    {{-- <hr/> --}}
                    <div id="laporan-biaya-kuli" class="row">
                        @foreach ($kuli as $item)
                        <div class="col-xl-3 col-md-6 col-12 mb-4 d-flex justify-content-center align-items-center">
                            <div class="d-flex flex-column justify-content-center p-3 text-center" style="height: 200px;width: 200px;border-radius: 50%;display: inline-block;">
                                <p style="font-weight: 600;" class="nth-bulan">{{$item['bulan']}}</p>
                                <h2>Rp <span class="thousand-separator">{{$item['jumlah']}}</span></h2>
                            </div>
                        </div>
                        @endforeach
                        {{-- <div class="col-xl-3 col-md-6 col-12 mb-4 d-flex justify-content-center align-items-center">
                            <div class="d-flex flex-column justify-content-center p-3 text-center" style="height: 200px;width: 200px;border-radius: 50%;display: inline-block;background-color: rgba(153, 102, 255, 0.2); border: 1px solid rgba(153, 102, 255, 1);">
                                <p style="font-size: 32px;font-weight: 600;">Mei</p>
                                <h2>Rp <span class="thousand-separator">800.000</span></h2>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12 mb-4 d-flex justify-content-center align-items-center">
                            <div class="d-flex flex-column justify-content-center p-3 text-center" style="height: 200px;width: 200px;border-radius: 50%;display: inline-block;background-color: rgba(75, 192, 192, 0.2); border: 1px solid rgba(75, 192, 192, 1);">
                                <p style="font-size: 32px;font-weight: 600;">April</p>
                                <h2>Rp <span class="thousand-separator">800.000</span></h2>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12 mb-4 d-flex justify-content-center align-items-center">
                            <div class="d-flex flex-column justify-content-center p-3 text-center" style="height: 200px;width: 200px;border-radius: 50%;display: inline-block;background-color: rgba(255, 206, 86, 0.2); border: 1px solid rgba(255, 206, 86, 1);">
                                <p style="font-size: 32px;font-weight: 600;">Maret</p>
                                <h2>Rp <span class="thousand-separator">800.000</span></h2>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row mt-4 mx-0">
                <div id="laporan-barang-masuk" class="col-xl-6 col-12">
                    <canvas id="chart-barang-masuk" style="width: 100%; max-height: 300px;"></canvas>
                </div>
                <div id="laporan-pendapatan-kotor" class="col-xl-6 col-12">
                    <canvas id="chart-pendapatan-kotor" style="width: 100%; max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="tab-2">
            <p>Content for tab 2.</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
<script src="{{asset('js/dashboard.js')}}"></script>
@endsection
