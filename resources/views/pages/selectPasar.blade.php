@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 my-2">
            <div class="card">
                <div class="card-body text-center p-5 d-flex flex-column justify-content-center align-items-center" style="height: 320px;"><i class="fas fa-lemon mb-3" style="font-size: 8rem;"></i>
                    <h1>Pasar Buah 36</h1>
                    <h4>Jl Tanjungsari no 36</h4>
                </div>
            </div>
        </div>
        <div class="col-6 my-2">
            <div class="card">
                <div class="card-body text-center p-5 d-flex flex-column justify-content-center align-items-center" style="height: 320px;"><i class="fas fa-lemon mb-3" style="font-size: 8rem;"></i>
                    <h1>Pasar Buah 47</h1>
                    <h4>Jl Tanjungsari no 47</h4>
                </div>
            </div>
        </div>
        <div class="col-6 my-2">
            <div class="card">
                <div class="card-body p-5 d-flex flex-column justify-content-center align-items-center" style="height: 320px;">
                    <button class="btn" type="button" id="show-add-pasar"><i class="far fa-plus-square" style="font-size: 8rem;"></i></button></div>
            </div>
        </div>
    </div>
    <div role="dialog" tabindex="-1" class="modal fade" id="add-pasar">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pasar baru</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-2">
                            <h5>Nama pasar<input type="text" class="form-control" /></h5>
                        </div>
                        <div class="mb-2">
                            <h5>Alamat pasar<input type="text" class="form-control" /></h5>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-primary" type="submit">Save</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/selectPasar.js')}}"></script>
@endsection
