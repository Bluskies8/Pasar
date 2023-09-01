@extends('layouts.default')

@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Pilih Pasar</h2>
                <button class="btn btn-primary" type="button" id="btn-add-pasar"><i class="far fa-plus"></i>&nbsp;Pasar baru</button>
            </div>
            <hr>
            <div class="row">
                @foreach ($data as $item)
                    <div class="col-12 col-md-6 col-xl-4 select-pasar" id="select-pasar">
                        <div class="card" id="{{$item->id}}">
                            <div class="card-body text-center d-flex flex-column justify-content-center align-items-center"><i class="fas fa-lemon mb-3" style="font-size: 8rem;"></i>
                                <h1 class="nama-pasar">{{$item->nama}}</h1>
                                <h4 class="alamat-pasar">{{$item->alamat}}</h4>
                                <hr class="w-100">
                                <div class="w-100 row">
                                    <div class="col-6">
                                        <button class="w-100 btn btn-secondary btn-update-pasar" type="button"><i class="fa-solid fa-gear"></i></button>
                                    </div>
                                    <div class="col-6">
                                        <button class="w-100 btn btn-success btn-select-pasar" type="button">Pilih</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div role="dialog" tabindex="-1" class="modal fade" id="modal-pasar">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-pasar" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-2">
                            <h5>Nama pasar</h5>
                            <input id="input-nama-pasar" type="text" name ="nama" class="form-control" />
                        </div>
                        <div class="mb-2">
                            <h5>Alamat pasar</h5>
                            <input id="input-alamat-pasar" type="text" name="alamat" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn-delete-pasar" class="btn btn-danger" type="button">Hapus</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/selectPasar.js')}}"></script>
@endsection
