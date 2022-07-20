<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>pasar</title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">

    <style>
        tfoot tr td {
            border-style:none;
            padding: 0px 8px!important;
        }

        tbody td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="m-2" style="width: 752px;">
        <div class="card">
            <div class="card-body">
                <p>{{$invoice->id}}</p>
                <div class="row">
                    <div class="col">
                        @if($stand->badan_usaha)
                            <p>{{$stand->badan_usaha}}</p>
                        @else
                            <br>
                        @endif
                        <p>{{$pasar->alamat}}</p>
                    </div>
                    <div class="col">
                        <p class="text-end">{{$invoice->created_at->format('d-M-Y')}}</p>
                        <p class="text-end">{{$invoice->stand->seller_name}}</p>
                    </div>
                </div>

                <div class="mt-2 p-2" style="background: var(--bs-light);border: 1px solid var(--bs-gray);">
                    <p class="text-center">Netto: Rp&nbsp;<span class="thousand-separator">{{$invoice->netto}}</span>,-</p>
                    <div class="table-responsive">
                        <table class="table mb-0" id="table-detail-invoice">
                            <thead>
                                <tr>
                                    <th>Checker</th>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Bruto</th>
                                    <th>Round</th>
                                    <th>Parkir</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trans as $item)
                                    @foreach ($item->details as $detail)
                                    <tr>
                                        <td>Checker</td>
                                        <td>{{$detail->kode}}</td>
                                        <td>{{$detail->nama_barang}}</td>
                                        <td>{{$detail->jumlah}}</td>
                                        <td>{{$detail->bruto}}</td>
                                        <td>{{$detail->round}}</td>
                                        <td><div class="d-flex justify-content-between">Rp <span class="thousand-separator">{{$detail->parkir}}</span></div></td>
                                        <td><div class="d-flex justify-content-between">Rp <span class="thousand-separator">{{$detail->subtotal}}</span></div></td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end" colspan="7">Total</td>
                                    <td><div class="d-flex justify-content-between">Rp <span class="thousand-separator">{{$total-$parkir}}</span></div></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="7">Parkir</td>
                                    <td><div class="d-flex justify-content-between">Rp <span class="thousand-separator">{{$parkir}}</span></div></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="7">Kuli</td>
                                    <td><div class="d-flex justify-content-between">Rp <span class="thousand-separator">{{$kuli}}</span></div></td>
                                </tr>

                                <!-- loop tambahan -->
                                <tr>
                                    <td class="text-end" colspan="7">Listrik</td>
                                    <td><div class="d-flex justify-content-between">Rp <span class="thousand-separator">{{$invoice->listrik}}</span></div></td>
                                </tr>

                                <tr>
                                    <td class="text-end" colspan="7">Dibayarkan</td>
                                    <td><div class="d-flex justify-content-between">Rp <span class="thousand-separator">{{$invoice->total + $invoice->kuli + $invoice->listrik + $parkir}}</span></div></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bs-init.js')}}"></script>
    <script src="{{asset('js/invoice.js')}}"></script>
</body>

</html>
