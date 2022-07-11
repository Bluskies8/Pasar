@extends('layouts.default')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">

<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="retribusi" content="{{ $retribusi }}">
<meta name="listrik" content="{{ $listrik }}">
<meta name="kuli" content="{{ $kuli }}">
<header id="content-header" class="d-flex align-items-center justify-content-between" style="height: 50px;">
    <div class="dropdown h-100"><button class="btn dropdown-toggle h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="visibility: hidden;">All Item</button>
        <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
    </div>
    <button class="btn btn-sm me-2" id="btn-retribusi" type="button" style="background: rgb(24, 144, 255);color: white;">Buat Retribusi</button>
</header>
<div class="container pb-5">
    <div class="card mb-4">
        <div class="card-body"><input class="mb-3" type="date">
            <div class="table-responsive">
                <table id="table-retribusi" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th>Kredit</th>
                            <th>Operasional</th>
                            <th>Prive</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Saldo awal</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Pembayaran listrik</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">0</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">7500000</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">7500000</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">Total</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-1" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Retribusi</th>
                            <th class="text-center">Listrik</th>
                            <th class="text-center">Kuli</th>
                            <th class="text-center">Sampah</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">9 Jul 2022</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-2" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Ponten Siang</th>
                            <th class="text-center">Ponten Malam</th>
                            <th class="text-center">Parkir Siang</th>
                            <th class="text-center">Parkir Malam</th>
                            <th class="text-center">Motor Siang</th>
                            <th class="text-center">Motor Malam</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">9 Jul 2022</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <p>Rp</p><span class="thousand-separator">25000000</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-retribusi">
        <div class="modal-dialog modal-lg modal-fullscreen-lg-down" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Laporan Omzet</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <form>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;" disabled="">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Retribusi</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;" disabled="">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Listrik</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;" disabled="">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Kuli</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Sampah</p>
                                        </div>
                                        <div class="position-relative"><input class="form-control" type="text" style="height: 32px;" disabled="">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Total</p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col col-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <form>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Poten Siang</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Poten Malam</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Parkir Siang</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Parkir Malam</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Motor Siang</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Motor Malam</p>
                                        </div>
                                        <div class="position-relative"><input class="form-control" type="text" style="height: 32px;" disabled="">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Total</p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col col-12">
                            <div class="card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <form class="w-100">
                                        <h5>Tambahan</h5>
                                        <div class="d-flex align-items-center mb-3"><input class="form-control tambahan-nama" type="text">
                                            <p class="mx-2">:</p><input class="form-control me-3 tambahan-nominal" type="text"><button class="btn btn-primary py-1 px-2" type="button" style="background-color: rgb(24, 144, 255);"><i class="far fa-trash-alt"></i></button>
                                        </div>
                                    </form><i class="fas fa-plus-circle" style="color: rgb(24, 144, 255);font-size: 24px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="button" style="background: rgb(24, 144, 255);color: var(--bs-white);">Simpan</button></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('js/retribusi.js')}}"></script>
@endsection
