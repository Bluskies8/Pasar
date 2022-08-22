@extends('layouts.default')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">

<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- <meta name="retribusi" content="{{ $retribusi }}">
<meta name="listrik" content="{{ $listrik }}">
<meta name="kuli" content="{{ $kuli }}"> --}}

<div style="max-height: calc(100vh - 50px); overflow-y: auto;">
    <div class="px-2 px-lg-5 pb-4">
        <div class="d-flex justify-content-end my-3">
            <button class="btn" id="btn-retribusi" type="button" style="background: #38A34A;color: white;">Buat Retribusi</button>
        </div>
        <div class="card mb-4">
            <div class="card-body">

                <div class="position-relative" style="max-width: 250px;" id="container-tanggal">
                <input class="form-control d-flex justify-content-between" id="selected-date" name="date" type="date" style="height: 32px;" data-date="{{$date}}" data-date-format="DD/MM/YYYY" value="{{$date}}">
                {{-- <input class="mb-3" type="date"> --}}
                <p class="position-absolute" style="font-size: 11px;top: -9px;left: 8px;background-color: white;">Tanggal</p>
                </div>
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
                            @isset($data)
                            <tr>
                                <td>1</td>
                                <td>Retribusi</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$data->retribusi-$data->listrik}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Listrik</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$data->listrik}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>kuli</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$data->kuli}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Sampah</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$data->sampah}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Ponten Siang</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$data->ponten_siang}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Ponten Malam</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$data->ponten_malam}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Parkir Siang</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$data->parkir_siang}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Parkir Malam</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$data->parkir_malam}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Motor Siang</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$data->motor_siang}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Motor Malam</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$data->motor_malam}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                            </tr>
                            @foreach ($data->tambahan as $item)
                            <tr>
                                <td>{{$loop->index+11}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                                @if($item->type == "operasional")
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <p>Rp</p><span class="thousand-separator">{{$item->value}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <p>Rp</p><span class="thousand-separator">0</span>
                                        </div>
                                    </td>
                                @else
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$item->value}}</span>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">Total</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$total}}</span>
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
                            @foreach ($all as $item)
                            <tr>
                                <td class="text-center">{{$item->created_at->format('d M Y')}}</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$item->retribusi-$item->listrik}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$item->listrik}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$item->kuli}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$item->sampah}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$item->retribusi-$item->kuli-$item->sampah+$item->listrik}}</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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
                            @foreach ($all as $item)
                            <tr>
                                <td class="text-center">{{$item->created_at->format('d M Y')}}</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$item->ponten_siang}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$item->ponten_malam}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$item->parkir_siang}}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$item->parkir_malam}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$item->motor_siang}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$item->motor_malam}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <p>Rp</p><span class="thousand-separator">{{$item->ponten_siang+$item->ponten_malam+$item->parkir_siang+$item->parkir_malam+$item->motor_siang+$item->motor_malam}}</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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
                                            <div class="position-relative mb-3"><input class="form-control" type="text" id = "retribusi" style="height: 32px;" disabled="">
                                                <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Retribusi</p>
                                            </div>
                                            <div class="position-relative mb-3"><input class="form-control" type="text" id = "listrik" style="height: 32px;" disabled="">
                                                <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Listrik</p>
                                            </div>
                                            <div class="position-relative mb-3"><input class="form-control" type="text" id = "kuli" style="height: 32px;" disabled="">
                                                <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Kuli</p>
                                            </div>
                                            <div class="position-relative mb-3"><input class="form-control" type="text" id = "sampah" style="height: 32px;" oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Sampah</p>
                                            </div>
                                            <div class="position-relative"><input class="form-control" type="text" id = "total_retribusi" style="height: 32px;" disabled="">
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
                                            <div class="position-relative mb-3"><input class="form-control" type="text" id = "ponten_siang" style="height: 32px;" oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Poten Siang</p>
                                            </div>
                                            <div class="position-relative mb-3"><input class="form-control" type="text" id = "ponten_malam" style="height: 32px;" oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Poten Malam</p>
                                            </div>
                                            <div class="position-relative mb-3"><input class="form-control" type="text" id = "parkir_siang" style="height: 32px;" oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Parkir Siang</p>
                                            </div>
                                            <div class="position-relative mb-3"><input class="form-control" type="text" id = "parkir_malam" style="height: 32px;" oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Parkir Malam</p>
                                            </div>
                                            <div class="position-relative mb-3"><input class="form-control" type="text" id = "motor_siang" style="height: 32px;" oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Motor Siang</p>
                                            </div>
                                            <div class="position-relative mb-3"><input class="form-control" type="text" id = "motor_malam" style="height: 32px;" oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Motor Malam</p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="text-start">Tambahan</h5>
                                        <form class="w-100">
                                            <div id="list-tambahan" style="max-height: 200px;overflow-y: auto;">
                                                <div id="clone-tambahan" class="d-flex align-items-center mb-3">
                                                    <input type="text" name = "nama" class="form-control tambahan-nama" />
                                                    <p class="mx-2">:</p>
                                                    <input type="text" name = "nominal" class="form-control me-3 tambahan-nominal" oninput="this.value=this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                                    <select name="tipe" class="form-select form-select-sm">
                                                        <option value="operasional">Operasional</option>
                                                        <option value="prive">Prive</option>
                                                    </select>
                                                    <button class="btn btn-primary py-1 px-2 delete-tambahan" type="button" style="background-color: rgb(24, 144, 255);">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <i id="icon-add" class="fas fa-plus-circle" style="color: rgb(24, 144, 255);font-size: 24px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id = "btn-save" type="button" style="background: rgb(24, 144, 255);color: var(--bs-white);">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('js/retribusi.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
@endsection
