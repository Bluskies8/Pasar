@extends('layouts.default')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
<div class="container position-relative mt-5">
    <div class="table-responsive">
        <table class="table" id="table-user">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cell 1</td>
                    <td>Cell 2</td>
                    <td>Cell 3</td>
                    <td class="position-relative d-flex justify-content-end">
                        <button class="btn btn-sm btn-danger d-flex show-aksi" type="button">
                            <i class="fas fa-bars fa-l"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <ul class="list-unstyled py-2" id="list-aksi">
        <li id="item-update" class="px-1">Ubah Data</li>
        <li id="item-delete" class="px-1">Hapus Data</li>
    </ul>

    <div role="dialog" tabindex="-1" class="modal fade" id="modal-update">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah data user</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="position-relative mb-3"><input type="text" class="form-control" id="input-nama"/>
                        <p class="position-absolute px-1" style="top: -12px;left: 10px;font-size: 14px;background-color: white;">Nama User</p>
                        <p class="small text-danger error-msg"></p>
                    </div>
                    <div class="position-relative mb-3"><input type="text" class="form-control" id="input-username"/>
                        <p class="position-absolute px-1" style="top: -12px;left: 10px;font-size: 14px;background-color: white;">Username</p>
                        <p class="small text-danger error-msg"></p>
                    </div>
                    <div class="position-relative mb-3"><input type="password" class="form-control" id="input-password"/>
                        <p class="position-absolute px-1" style="top: -12px;left: 10px;font-size: 14px;background-color: white;">Password</p>
                        <p class="small text-danger error-msg"></p>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Save</button></div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('js/masterUser.js')}}"></script>
@endsection
