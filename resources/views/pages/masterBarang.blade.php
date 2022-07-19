@extends('layouts.default')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<header id="content-header" class="d-flex align-items-center justify-content-between" style="height: 50px;">
    <div class="dropdown h-100">
        <button class="btn dropdown-toggle h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="visibility: hidden;">All Item</button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">First Item</a>
            <a class="dropdown-item" href="#">Second Item</a>
            <a class="dropdown-item" href="#">Third Item</a>
        </div>
    </div>
    <button class="btn btn-sm me-2" id="add-user" type="button" style="background-color: #38A34A; color: white;">Tipe Baru</button>
</header>
<hr class="my-0">
<div class="table-responsive p-3">
    <table class="table" id="table-barang">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Tipe</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="text-center">
            <tr>
                <td>Cell 1</td>
                <td>Cell 2</td>
                <td class="position-relative" style="padding: 5px 4px;">
                    <button class="btn btn-sm d-flex align-items-center show-aksi position-absolute h-75 mx-auto" type="button" style="background: #38A34A;color: white;left: 0;right: 0;max-width: 35.5px;"><i class="fas fa-bars fa-lg"></i></button>
                </td>
            </tr>
            <tr>
                <td>Cell 3</td>
                <td>Cell 4</td>
                <td class="position-relative" style="padding: 5px 4px;">
                    <button class="btn btn-sm d-flex align-items-center show-aksi position-absolute h-75 mx-auto" type="button" style="background: #38A34A;color: white;left: 0;right: 0;max-width: 35.5px;"><i class="fas fa-bars fa-lg"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<ul class="list-unstyled py-2" id="list-aksi">
    <li id="item-update" class="px-1">Ubah Tipe</li>
    <li id="item-delete" class="px-1">Hapus Tipe</li>
</ul>

<div role="dialog" tabindex="-1" class="modal fade" id="modal-update">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah data user</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="position-relative mb-3"><input type="text" class="form-control" id="input-kode" disabled/>
                    <p class="position-absolute px-1" style="top: -12px;left: 10px;font-size: 14px;background-color: white;">Kode</p>
                    <p class="small text-danger error-msg"></p>
                </div>
                <div class="position-relative mb-3"><input type="text" class="form-control" id="input-nama" />
                    <p class="position-absolute px-1" style="top: -12px;left: 10px;font-size: 14px;background-color: white;">Nama Tipe</p>
                    <p class="small text-danger error-msg"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" id="btn-save" type="button" style="background-color: #38A34A; color: white;">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('js/masterBarang.js')}}"></script>
@endsection
