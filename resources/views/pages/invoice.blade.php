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
                    <tr>
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
                        <p class="ms-5">Rp{{$total}}</p>
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

                        <input id="pelapak" list="list-pelapak" class="form-select-sm">
                        <datalist id="list-pelapak">
                            <option class="list-option-pelapak" id="temp-0" value="testing">
                            @foreach ($stand as $item)
                                @if ($item['seller_name'] != "")
                                    <!-- <option id="{{$item['id']}}" value="{{$item['seller_name'] . ' - ' . $item['no_stand']}}"> -->
                                @endif
                            @endforeach
                        </datalist>
                    </div>
                    <hr>
                    <div class="mymodal-content">
                        <div class="mymodal-table">
                            <div class="mt-2 mb-3 p-2" style="background: var(--bs-light);border: 1px solid var(--bs-gray) ;">
                                <p class="text-center">Netto: Rp&nbsp;<span class="thousand-separator">3000</span>,-</p>
                            </div>

                            <!-- hide soalnya belum ada data -->
                            <div class="table-responsive">
                                <div class="d-flex justify-content-end">
                                    <i class="fa-solid fa-down-left-and-up-right-to-center hide-invoice-detail"></i>
                                    <i class="fa-solid fa-maximize show-invoice-detail" style="display: none"></i>
                                </div>
                                <table class="table mb-0 table-invoice-detail">
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
                                            <td class="text-end w-75" colspan="6">Total 1</td>
                                            <td><div class="d-flex justify-content-between">Rp <span id="biaya-total" class="biaya thousand-separator">{{$total}}</span></div></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="card card-tambahan mb-3">
                                <div class="card-body text-center">
                                    <h5 class="text-start">Tambahan</h5>
                                    <form class="w-100">
                                        <div class="d-flex justify-content-around" style="width: calc(100% - 48px)">
                                            <p>Nama Tambahan</p>
                                            <p>Nominal Tambahan</p>
                                        </div>
                                        <div id="list-tambahan" style="max-height: 200px;overflow-y: auto;">
                                            <div id="clone-tambahan" class="d-flex align-items-center mb-2">
                                                <input type="text" name="nama" class="form-control tambahan-nama" />
                                                <p class="mx-2">:</p>
                                                <input type="text" name="nominal" class="form-control me-3 tambahan-nominal" oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                                <button class="btn btn-primary py-1 px-2 delete-tambahan" type="button" style="background-color: #38A34A;">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="d-flex justify-content-center" style="width: calc(100% - 48px)">
                                        <i id="icon-add" class="fas fa-plus-circle me-1" style="color: #38A34A;font-size: 32px;"></i>
                                        <div id="icon-save" class="rounded-circle d-flex justify-content-center align-items-center ms-1" style="background-color: #38A34A; color: white; height: 32px; width:32px;">
                                            <i class="fa-regular fa-floppy-disk" style="font-size: 16px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive my-2">
                                <div class="d-flex justify-content-end">
                                    <i class="fa-solid fa-down-left-and-up-right-to-center hide-invoice-tambahan"></i>
                                    <i class="fa-solid fa-maximize show-invoice-tambahan" style="display: none"></i>
                                </div>
                                <table class="table mb-0 table-tambahan">
                                    <thead>
                                        <tr>
                                            <th class="w-75">Nama Tambahan</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-end w-75">Total 2</td>
                                            <td><div class="d-flex justify-content-between">Rp <span id="biaya-total-tambahan" class="biaya thousand-separator"></span></div></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="d-flex align-items-center">
                                <p class="text-end py-1" style="white-space: nowrap; width: 100px;">Biaya Listrik :&nbsp;</p>
                                <select id="select-listrik" name="listrik" class="form-select form-select-sm" style="width: 173px;">
                                    <option value="0">0</option>
                                    <option value="25000">25.000</option>
                                    <option value="40000">40.000</option>
                                    <option value="50000">50.000</option>
                                    <option value="75000">75.000</option>
                                </select>
                            </div>

                            <div class="table-responsive mb-2">
                                <table class="table mb-0 table-akhir">
                                    <thead>
                                        <tr>
                                            <th class="w-75">Nama</th>
                                            <th>Biaya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-end">Parkir</td>
                                            <td><div class="d-flex justify-content-between">Rp <span id="biaya-parkir" class="biaya thousand-separator">{{$parkir}}</span></div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-end">Kuli</td>
                                            <td><div class="d-flex justify-content-between">Rp <span id="biaya-kuli" class="biaya thousand-separator">{{$kuli}}</span></div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-end">Listrik</td>
                                            <td><div class="d-flex justify-content-between">Rp <span id="biaya-listrik" class="biaya thousand-separator"></span></div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-end">Dibayarkan</td>
                                            <td><div class="d-flex justify-content-between">Rp <span id="biaya-dibayarkan" class="thousand-separator">{{$total+$parkir+$kuli}}</span></div></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-loading p-5 d-flex justify-content-center d-none">
                            <i class="fas fa-circle-notch fa-spin fa-4x" style="color: rgb(33,37,41, 0.8);"></i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-save" type="button" style="background: #38A34A;color: white;" data-bs-dismiss="modal">Save</button>
                </div>
            </div>
        </div>

    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{asset('js/table-invoice.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

@endsection
