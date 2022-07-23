@extends('layouts.default')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

<header id="content-header" class="d-flex align-items-center justify-content-between" style="height: 50px;">
    <div class="dropdown h-100">
        <button class="btn dropdown-toggle h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="visibility: hidden;">All Item</button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">First Item</a>
            <a class="dropdown-item" href="#">Second Item</a>
            <a class="dropdown-item" href="#">Third Item</a>
        </div>
    </div>
    @if (Auth::guard('checkLogin')->user()->role_id<3)
    <button class="btn btn-sm me-2" id="add-user" type="button" style="background-color: #38A34A; color: white;">User Baru</button>
    @endif
</header>
<hr class="my-0">
<div class="table-responsive p-3">
    <table class="table" id="table-user">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th>Tambahan Shif</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($data as $item)
            <tr id ="{{$item->id}}">
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td></td>
                <td>{{$item->role->name}}</td>
                <td>{{$item->tambahan_start}} - {{$item->tambahan_end}}</td>
                <td class="position-relative d-flex justify-content-end">
                    <button class="btn btn-sm d-flex show-aksi" type="button" style="background-color: #38A34A; color: white;">
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
                <div class="position-relative mb-1"><input type="password" class="form-control" id="input-password"/>
                    <p class="position-absolute px-1" style="top: -12px;left: 10px;font-size: 14px;background-color: white;">Password</p>
                    <p class="small text-danger error-msg"></p>
                </div>
                <p class="px-1" style="font-size: 14px;background-color: white; margin-left: 10px;">Role</p>
                <div class="form-control d-flex justify-content-between mb-3">
                    <!-- kalau data nama bidang dirubah, harap mengubah data paten dibawah ini dengan mengambil data bidang dari database -->
                    <div class="form-check"><input type="radio" class="form-check-input input-radio" id="role-2" name="role" value="2"/><label class="form-check-label" for="role-2">Admin</label></div>
                    <div class="form-check"><input type="radio" class="form-check-input input-radio" id="role-3" name="role" value="3"/><label class="form-check-label" for="role-3">Kapten</label></div>
                    <div class="form-check"><input type="radio" class="form-check-input input-radio" id="role-4" name="role" value="4"/><label class="form-check-label" for="role-4">Checker</label></div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="position-relative"><input type="datetime-local" class="form-control" id="input-shif-masuk" style="width: 200px;" />
                        <p class="position-absolute px-1" style="top: -12px;left: 10px;font-size: 14px;background-color: white;">Shift Mulai</p>
                        <p class="small text-danger error-msg-masuk" id = "error-msg-masuk"></p>
                    </div>
                    <div class="position-relative"><input type="datetime-local" class="form-control" id="input-shif-keluar" style="width: 200px;" />
                        <p class="position-absolute px-1" style="top: -12px;left: 10px;font-size: 14px;background-color: white;">Shift Selesai</p>
                        <p class="small text-danger error-msg-keluar" id = "error-msg-keluar"></p>
                    </div>
                    <button id="btn-reset-clock" class="btn btn-sm" type="button" style="background-color: #38A34A; width: 34px;">
                        <i class="fas fa-trash fa-l" style="color: white"></i>
                    </button>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" id="btn-save" type="button">Save</button></div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="{{asset('js/masterUser.js')}}"></script>
@endsection
