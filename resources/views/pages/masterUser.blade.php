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
                <th>Shif</th>
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
                <td>{{$item->shif}}</td>
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
                <div class="position-relative mb-3">
                    <select class="form-control" name="select-shif" id="input-shif-id">
                        <option value="" style="display: none"></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <p class="position-absolute px-1" style="top: -12px;left: 10px;font-size: 14px;background-color: white;">Shif</p>
                    <p class="small text-danger error-msg"></p>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-control position-relative d-flex flex-column" id="container-shif-masuk" style="width: 200px;height: 34px;">
                        <p class="d-flex justify-content-around" style="padding: 0 14px;"><span id="jam-masuk">00</span> : <span id="menit-masuk">00</span></p>
                        <div class="position-absolute d-none d-flex w-100 dropdown-shif" id="dropdown-shif-masuk" style="top: 32px;left: 0px;height: 100px;cursor: default;">
                            <div class="form-control px-0" id="dropdown-jam-masuk" style="overflow-y: auto;">
                                <p class="text-center">00</p>
                                <p class="text-center">01</p>
                                <p class="text-center">02</p>
                                <p class="text-center">03</p>
                                <p class="text-center">04</p>
                                <p class="text-center">05</p>
                                <p class="text-center">06</p>
                                <p class="text-center">07</p>
                                <p class="text-center">08</p>
                                <p class="text-center">09</p>
                                <p class="text-center">10</p>
                                <p class="text-center">11</p>
                                <p class="text-center">12</p>
                                <p class="text-center">13</p>
                                <p class="text-center">14</p>
                                <p class="text-center">15</p>
                                <p class="text-center">16</p>
                                <p class="text-center">17</p>
                                <p class="text-center">18</p>
                                <p class="text-center">19</p>
                                <p class="text-center">20</p>
                                <p class="text-center">21</p>
                                <p class="text-center">22</p>
                                <p class="text-center">23</p>
                            </div>
                            <div class="form-control px-0" id="dropdown-menit-masuk" style="overflow-y: auto;">
                                <p class="text-center">00</p>
                                <p class="text-center">01</p>
                                <p class="text-center">02</p>
                                <p class="text-center">03</p>
                                <p class="text-center">04</p>
                                <p class="text-center">05</p>
                                <p class="text-center">06</p>
                                <p class="text-center">07</p>
                                <p class="text-center">08</p>
                                <p class="text-center">09</p>
                                <p class="text-center">10</p>
                                <p class="text-center">11</p>
                                <p class="text-center">12</p>
                                <p class="text-center">13</p>
                                <p class="text-center">14</p>
                                <p class="text-center">15</p>
                                <p class="text-center">16</p>
                                <p class="text-center">17</p>
                                <p class="text-center">18</p>
                                <p class="text-center">19</p>
                                <p class="text-center">20</p>
                                <p class="text-center">21</p>
                                <p class="text-center">22</p>
                                <p class="text-center">23</p>
                                <p class="text-center">24</p>
                                <p class="text-center">25</p>
                                <p class="text-center">26</p>
                                <p class="text-center">27</p>
                                <p class="text-center">28</p>
                                <p class="text-center">29</p>
                                <p class="text-center">30</p>
                                <p class="text-center">31</p>
                                <p class="text-center">32</p>
                                <p class="text-center">33</p>
                                <p class="text-center">34</p>
                                <p class="text-center">35</p>
                                <p class="text-center">36</p>
                                <p class="text-center">37</p>
                                <p class="text-center">38</p>
                                <p class="text-center">39</p>
                                <p class="text-center">40</p>
                                <p class="text-center">41</p>
                                <p class="text-center">42</p>
                                <p class="text-center">43</p>
                                <p class="text-center">44</p>
                                <p class="text-center">45</p>
                                <p class="text-center">46</p>
                                <p class="text-center">47</p>
                                <p class="text-center">48</p>
                                <p class="text-center">49</p>
                                <p class="text-center">50</p>
                                <p class="text-center">51</p>
                                <p class="text-center">52</p>
                                <p class="text-center">53</p>
                                <p class="text-center">54</p>
                                <p class="text-center">55</p>
                                <p class="text-center">56</p>
                                <p class="text-center">57</p>
                                <p class="text-center">58</p>
                                <p class="text-center">59</p>
                            </div>
                            <button class="btn btn-success btn-sm position-absolute w-100" type="button" style="left: 0px;top: 100px;">Tutup</button>
                        </div>
                        <input type="hidden" id="input-shif-masuk"/>
                        <p class="position-absolute px-1" style="top: -12px;left: 10px;font-size: 14px;background-color: white;">Shift Mulai</p>
                        <p class="small text-danger error-msg-masuk" id="error-msg-masuk"></p>
                    </div>
                    <div class="form-control position-relative d-flex flex-column" id="container-shif-keluar" style="width: 200px;height: 34px;">
                        <p class="d-flex justify-content-around" style="padding: 0 14px;"><span id="jam-keluar">00</span> : <span id="menit-keluar">00</span></p>
                        <div class="position-absolute d-none d-flex w-100 dropdown-shif" id="dropdown-shif-keluar" style="top: 32px;left: 0px;height: 100px;cursor: default;">
                            <div class="form-control px-0" id="dropdown-jam-keluar" style="overflow-y: auto;">
                                <p class="text-center">00</p>
                                <p class="text-center">01</p>
                                <p class="text-center">02</p>
                                <p class="text-center">03</p>
                                <p class="text-center">04</p>
                                <p class="text-center">05</p>
                                <p class="text-center">06</p>
                                <p class="text-center">07</p>
                                <p class="text-center">08</p>
                                <p class="text-center">09</p>
                                <p class="text-center">10</p>
                                <p class="text-center">11</p>
                                <p class="text-center">12</p>
                                <p class="text-center">13</p>
                                <p class="text-center">14</p>
                                <p class="text-center">15</p>
                                <p class="text-center">16</p>
                                <p class="text-center">17</p>
                                <p class="text-center">18</p>
                                <p class="text-center">19</p>
                                <p class="text-center">20</p>
                                <p class="text-center">21</p>
                                <p class="text-center">22</p>
                                <p class="text-center">23</p>
                            </div>
                            <div class="form-control px-0" id="dropdown-menit-keluar" style="overflow-y: auto;">
                                <p class="text-center">00</p>
                                <p class="text-center">01</p>
                                <p class="text-center">02</p>
                                <p class="text-center">03</p>
                                <p class="text-center">04</p>
                                <p class="text-center">05</p>
                                <p class="text-center">06</p>
                                <p class="text-center">07</p>
                                <p class="text-center">08</p>
                                <p class="text-center">09</p>
                                <p class="text-center">10</p>
                                <p class="text-center">11</p>
                                <p class="text-center">12</p>
                                <p class="text-center">13</p>
                                <p class="text-center">14</p>
                                <p class="text-center">15</p>
                                <p class="text-center">16</p>
                                <p class="text-center">17</p>
                                <p class="text-center">18</p>
                                <p class="text-center">19</p>
                                <p class="text-center">20</p>
                                <p class="text-center">21</p>
                                <p class="text-center">22</p>
                                <p class="text-center">23</p>
                                <p class="text-center">24</p>
                                <p class="text-center">25</p>
                                <p class="text-center">26</p>
                                <p class="text-center">27</p>
                                <p class="text-center">28</p>
                                <p class="text-center">29</p>
                                <p class="text-center">30</p>
                                <p class="text-center">31</p>
                                <p class="text-center">32</p>
                                <p class="text-center">33</p>
                                <p class="text-center">34</p>
                                <p class="text-center">35</p>
                                <p class="text-center">36</p>
                                <p class="text-center">37</p>
                                <p class="text-center">38</p>
                                <p class="text-center">39</p>
                                <p class="text-center">40</p>
                                <p class="text-center">41</p>
                                <p class="text-center">42</p>
                                <p class="text-center">43</p>
                                <p class="text-center">44</p>
                                <p class="text-center">45</p>
                                <p class="text-center">46</p>
                                <p class="text-center">47</p>
                                <p class="text-center">48</p>
                                <p class="text-center">49</p>
                                <p class="text-center">50</p>
                                <p class="text-center">51</p>
                                <p class="text-center">52</p>
                                <p class="text-center">53</p>
                                <p class="text-center">54</p>
                                <p class="text-center">55</p>
                                <p class="text-center">56</p>
                                <p class="text-center">57</p>
                                <p class="text-center">58</p>
                                <p class="text-center">59</p>
                            </div>
                            <button class="btn btn-success btn-sm position-absolute w-100" type="button" style="left: 0px;top: 100px;">Tutup</button>
                        </div>
                        <input type="hidden" id="input-shif-keluar"/>
                        <p class="position-absolute px-1" style="top: -12px;left: 10px;font-size: 14px;background-color: white;">Shift Selesai</p>
                        <p class="small text-danger error-msg-keluar" id="error-msg-keluar"></p>
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
