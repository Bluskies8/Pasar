<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>pasar</title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>

<body>
    <div class="row p-2 m-0">
        <div class="col-12 col-lg-6 col-xxl-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p>ID Nota</p>
                        <div class="row">
                            <div class="col">
                                <p>Nama PT</p>
                                <p>Alamat</p>
                            </div>
                            <div class="col">
                                <p class="text-end">Tanggal</p>
                                <p class="text-end">Nama Lapak</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 p-2" style="background: var(--bs-light);border: 1px solid var(--bs-gray) ;">
                        <p class="text-center">Netto: Rp&nbsp;<span class="thousand-separator">3000</span>,-</p>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
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
                                    <tr>
                                        <td>k</td>
                                        <td>Import</td>
                                        <td class="text-end">113</td>
                                        <td class="text-end">23</td>
                                        <td class="text-end">23</td>
                                        <td>Rp 3000</td>
                                        <td>Rp 69000</td>
                                    </tr>
                                    <tr>
                                        <td>p</td>
                                        <td>Import</td>
                                        <td class="text-end">10</td>
                                        <td class="text-end">10</td>
                                        <td class="text-end">10</td>
                                        <td>Rp 3000</td>
                                        <td>Rp 3000</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-end" colspan="6">Total<br>Listrik<br>Dibayarkan</td>
                                        <td>Rp 72000<br>Rp 75000<br>RP 147000</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bs-init.js')}}"></script>
    <script src="{{asset('js/side-nav.js')}}"></script>
</body>

</html>
