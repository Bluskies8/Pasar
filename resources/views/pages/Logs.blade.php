@extends('layouts.default')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    {{-- <header id="content-header" class="d-flex align-items-center justify-content-between" style="height: 50px;">
        <div class="dropdown h-100"><button class="btn dropdown-toggle h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button">All Item</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">First Item</a>
                <a class="dropdown-item" href="#">Second Item</a>
                <a class="dropdown-item" href="#">Third Item</a>
            </div>
        </div>
        <button class="btn btn-sm me-2" id="generate-invoice" type="button" style="background: #38A34A;color: white;">Buat Nota</button>
    </header> --}}
    <hr class="my-0">
    {{-- <div class="position-relative" style="max-width: 250px;" id="container-tanggal">
        <input class="form-control d-flex justify-content-between" id="selected-date" name="date" type="date" style="height: 32px;" data-date="{{$date}}" data-date-format="DD/MM/YYYY" value="{{$date}}">
        <p class="position-absolute" style="font-size: 11px;top: -9px;left: 8px;background-color: white;">Tanggal</p>
    </div> --}}
    <div class="table-responsive p-3 w-100">
        <table class="table table-striped" id="table-log">
            <thead>
                <tr class="text-center">
                    <th>user</th>
                    <th>keterangan</th>
                    <th>created_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td class='cell-id text-center'>{{$item->user->name}} </td>
                        <td class='text-center'>{{$item->keterangan}}</td>
                        <td class='text-center'>{{$item->created_at}}</td>

                    </tr>
                @endforeach
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{asset('js/log.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

@endsection
