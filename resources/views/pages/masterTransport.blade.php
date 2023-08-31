@extends('layouts.default')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container">
    <div class="card mt-5">
        <div class="card-body">
            <div id="content-header" class="d-flex align-items-center justify-content-between">
                <h2>Tranportasi</h2>
                <button class="btn btn-sm me-2" id="add-transport" type="button" style="background-color: #38A34A; color: white;">Transport Baru</button>
            </div>
            <hr>
            <div class="table-responsive p-3">
                <table class="table" id="table-transport">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Biaya</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($data as $item)
                        <tr id="{{$item->id}}">
                            <td>{{$item->nama}}</td>
                            <td>{{number_format($item->value, 0, ',', '.')}}</td>
                            <td class="text-end" style="padding: 5px 4px;">
                                <button class="btn btn-sm show-aksi" type="button" style="background: #38A34A;color: white;"><i class="fas fa-bars fa-lg"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <ul class="list-unstyled py-2" id="list-aksi">
                <li id="item-update" class="px-1">Ubah Data</li>
                <li id="item-delete" class="px-1">Hapus Data</li>
            </ul>

            <div role="dialog" tabindex="-1" class="modal fade" id="modal-update">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="position-relative mb-3">
                                <input type="text" class="form-control" id="input-nama" />
                                <p class="position-absolute px-1" style="top: -12px;left: 10px;font-size: 14px;background-color: white;">Nama Transport</p>
                                <p class="small text-danger error-msg" id="error-nama"></p>
                            </div>
                            <div class="position-relative mb-3">
                                <input type="text" class="form-control" id="input-harga" oninput="this.value = this.value.replace(/[^0-9.]/g, &#39;&#39;).replace(/(\..*?)\..*/g, &#39;$1&#39;).replace(/^0[^.]/, &#39;0&#39;);"/>
                                <p class="position-absolute px-1" style="top: -12px;left: 10px;font-size: 14px;background-color: white;">Harga Transport</p>
                                <p class="small text-danger error-msg" id="error-harga"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" id="btn-save" type="button" style="background-color: #38A34A; color: white;">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('js/masterTransport.js')}}"></script>
@endsection
