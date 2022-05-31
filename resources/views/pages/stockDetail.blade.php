@extends('layouts.default')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">

    <header id="content-header" class="d-flex align-items-center justify-content-between px-2" style="height: 50px;">
        <p>ID Transaksi :&nbsp;<span id="id-transaksi">ID0001</span></p>
        <p class="d-flex align-items-center" style="white-space: nowrap; width: 200px;">Nama Lapak :&nbsp;
            <span id="nama-pelapak"></span>
            <input list="list-pelapak" class="form-select-sm">
            <datalist id="list-pelapak">
                <option value="Adam">
                <option value="Agus">
                <option value="Ben">
                <option value="Donny">
            </datalist>
        </p>
        <button class="btn btn-sm" id="tambah-barang" type="button" style="background: rgb(24, 144, 255);color: var(--bs-white);">Tambah Barang</button>
    </header>
    <hr class="my-0">
    <div class="table-responsive p-3 pb-0" style="max-height: 81.8vh;overflow-y: auto;">
        <table class="table table-striped mb-0" id="table-barang">
            <thead>
                <tr class="text-center">
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Netto</th>
                    <th>Parkir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">K</td>
                    <td>Pisang</td>
                    <td class="text-center">113</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>Rp</p>
                            <p class="thousand-separator data-netto">3000</p>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>Rp</p>
                            <p class="thousand-separator">3000</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">P</td>
                    <td>Salak</td>
                    <td class="text-center">5</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>Rp</p>
                            <p class="thousand-separator data-netto">3000</p>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>Rp</p>
                            <p class="thousand-separator">3000</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">B</td>
                    <td>Durian</td>
                    <td class="text-center">10</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>Rp</p>
                            <p class="thousand-separator data-netto">30000</p>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>Rp</p>
                            <p class="thousand-separator">3000</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-barang">
        <div class="modal-dialog modal-xl modal-fullscreen-lg-down" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang Baru</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow-y: auto;max-height: 702px;">
                    <div id="modal-row" class="row">
                        <div id="form-template" class="col-12 col-md-6 col-lg-4 mb-3" style="/*display: none;*/">
                            <div class="card">
                                <div class="card-body">
                                    <form>
                                        <div class="d-flex align-items-center mb-3">
                                            <p class="me-2">Kode</p>
                                            <select class="form-select form-select-sm">
                                                <option value="K">Kecil</option>
                                                <option value="B">Besar</option>
                                                <option value="TD">Tiga per Dua</option>
                                                <option value="DT">Dua per Tiga</option>
                                                <option value="SD">Satu per Dua</option>
                                                <option value="P">Peti</option>
                                                <option value="T">Tonase</option>
                                            </select>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Nama Barang</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Jumlah</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;" oninput="this.value = this.value.replace(/[^0-9.]/g, &#39;&#39;).replace(/(\..*?)\..*/g, &#39;$1&#39;).replace(/^0[^.]/, &#39;0&#39;);">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Netto</p>
                                        </div>
                                    </form>
                                    <div class="d-flex align-items-center mb-3">
                                        <p class="me-2">Parkir</p>
                                        <select class="form-select-sm form-select">
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
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button><button class="btn" id="new-form" type="button" style="background: var(--bs-teal);color: white;">Tambah Form Baru</button><button class="btn" id="save-barang" type="button" style="background: rgb(24, 144, 255);color: white;">Simpan</button></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{asset('js/table-barang.js')}}"></script>
@endsection
