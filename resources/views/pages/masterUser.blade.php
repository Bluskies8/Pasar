@extends('layouts.default')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container position-relative mt-5">
    <h2 class="text-danger d-flex align-items-center justify-content-between mb-3">Master User<button class="btn btn-danger" id="add-user" type="button">User Baru</button></h2>
    <div class="table-responsive">
        <table class="table" id="table-user">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr id ="{{$item->id}}">
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td></td>
                    <td>{{$item->role->name}}</td>
                    <td class="position-relative d-flex justify-content-end">
                        <button class="btn btn-sm btn-danger d-flex show-aksi" type="button">
                            <i class="fas fa-bars fa-l"></i>
                        </button>
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
                    <div class="form-control d-flex justify-content-between">
                        <!-- kalau data nama bidang dirubah, harap mengubah data paten dibawah ini dengan mengambil data bidang dari database -->
                        <div class="form-check"><input type="radio" class="form-check-input input-radio" id="role-2" name="role" value="2"/><label class="form-check-label" for="role-2">Admin</label></div>
                        <div class="form-check"><input type="radio" class="form-check-input input-radio" id="role-3" name="role" value="3"/><label class="form-check-label" for="role-3">Kapten</label></div>
                        <div class="form-check"><input type="radio" class="form-check-input input-radio" id="role-4" name="role" value="4"/><label class="form-check-label" for="role-4">Checker</label></div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" id="btn-save" type="button">Save</button></div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="{{asset('js/masterUser.js')}}"></script>
@endsection
