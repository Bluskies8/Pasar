<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>pasar</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <header class="w-100 d-flex" style="height: 50px;background: #dfe7f1;">
        <div class="h-100 p-1 d-flex align-items-center justify-content-center" style="min-width: 200px;max-width: 200px;border-right: 1px solid lightgrey;">
            <p style="color: rgb(24, 144, 255);font-size: 30px;font-weight: bold;">LOGO</p>
        </div>
        <div class="w-100 d-flex justify-content-between">
            <div class="d-flex align-items-center"><i class="fas fa-plus-circle fa-xl ms-3 me-2" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-placement="bottom" id="quick-create" title="Quick Create"></i><i class="fas fa-clock fa-xl ms-2 me-3" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-placement="bottom" id="recent-activity" title="Recent Activity"></i>
                <div id="searchbar" class="d-flex">
                    <div class="dropdown"><button class="btn dropdown-toggle d-flex align-items-center" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="height: 34px;box-shadow: none;"><i class="fas fa-search" style="font-size: 16px;"></i></button>
                        <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                    </div><input type="text" style="outline: none;border: none;width: 225px;" placeholder="Search">
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="me-3 position-relative"><i class="fas fa-bell fa-xl" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-placement="bottom" title="Notifications"></i>
                    <p class="position-absolute rounded-circle d-flex align-items-center justify-content-center notification-nudge">0</p>
                </div>
                <div class="me-3 position-relative"><i class="fas fa-folder-open fa-xl"></i>
                    <p class="position-absolute rounded-circle d-flex align-items-center justify-content-center notification-nudge">0</p>
                </div><i class="fas fa-cog fa-xl me-3"></i><i class="fas fa-question-circle fa-xl me-3"></i><img class="rounded-circle me-4" style="width: 40px;height: 40px;" src="assets/img/logo.svg">
            </div>
        </div>
    </header>
    <div class="d-flex">
        <div id="side-nav" class="position-relative" style="width: 200px;height: calc(100vh - 50px);background: rgb(45,55,60);color: white;">
            <div id="nav-group-1" class="nav-group py-2">
                <div id="nav-item-dashboard" class="d-flex align-items-center ps-3 nav-item"><i class="fas fa-tachometer-alt me-3"></i>
                    <p>Dashboard</p>
                </div>
                <div id="nav-item-items" class="d-flex align-items-center ps-3 nav-item active"><i class="fas fa-shopping-basket me-3"></i>
                    <p>Items</p>
                </div>
            </div>
            <div id="nav-group-2" class="nav-group py-2">
                <div id="nav-item-customer" class="d-flex align-items-center ps-3 nav-item"><i class="fas fa-user me-3"></i>
                    <p>Customer</p>
                </div>
                <div id="nav-item-retainer_invoices" class="d-flex align-items-center ps-3 nav-item"><i class="fas fa-file-invoice-dollar me-3"></i>
                    <p>Retainer Invoices</p>
                </div>
                <div id="nav-item-sales_orders" class="d-flex align-items-center ps-3 nav-item"><i class="fas fa-shopping-cart me-3"></i>
                    <p>Sales Orders</p>
                </div>
                <div id="nav-item-packages" class="d-flex align-items-center ps-3 nav-item"><i class="fas fa-box me-3"></i>
                    <p>Packages</p>
                </div>
                <div id="nav-item-invoices" class="d-flex align-items-center ps-3 nav-item"><i class="fas fa-file-invoice me-3"></i>
                    <p>Invoices</p>
                </div>
                <div id="nav-item-payment_received" class="d-flex align-items-center ps-3 nav-item"><i class="fas fa-dollar-sign me-3"></i>
                    <p>Payment Received</p>
                </div>
                <div id="nav-item-return" class="d-flex align-items-center ps-3 nav-item"><i class="fas fa-retweet me-3"></i>
                    <p>Return</p>
                </div>
            </div><button class="btn position-absolute d-flex align-items-center justify-content-center p-1" id="minimize-nav" type="button" style="bottom: 0px;color: white;background-color: rgb(34,43,47);border-radius: 0px;box-shadow: none;width: 200px;"><i class="fas fa-chevron-left" id="minimize-icon"></i></button>
        </div>
        <div id="content" class="position-relative" style="width: calc(100% - 200px);">
            <header id="content-header" class="d-flex align-items-center justify-content-between" style="height: 50px;">
                <div class="dropdown h-100"><button class="btn dropdown-toggle h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button">All Item</button>
                    <div class="dropdown-menu"><a class="dropdown-item" href="#">First Item</a><a class="dropdown-item" href="#">Second Item</a><a class="dropdown-item" href="#">Third Item</a></div>
                </div><button class="btn btn-sm me-2" id="tambah-barang" type="button" style="background: rgb(24, 144, 255);color: var(--bs-white);">Tambah Barang</button>
            </header>
            <hr class="my-0">
            <div class="table-responsive p-3" id="table-barang" style="max-height: 81.8vh;overflow-y: auto;">
                <table class="table table-striped" id="table-item">
                    <thead>
                        <tr>
                            <th style="width: 13px;"><input type="checkbox"></th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Barang A</td>
                            <td>Kg</td>
                            <td>2</td>
                            <td>50000</td>
                            <td>100000</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>Barang B</td>
                            <td>Buah</td>
                            <td>4</td>
                            <td>25000</td>
                            <td>100000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="m-3 position-absolute" style="bottom: 0px;"><button class="btn btn-sm me-3 float-start" id="ubah-barang" type="button" style="background: var(--bs-teal);color: white;">Ubah</button><button class="btn btn-sm me-3 float-start" id="hapus-barang" type="button" style="background: var(--bs-danger);color: white;">Hapus</button>
                <p class="float-start my-1">0 Item(s) selected</p>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="modal-barang">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang Baru</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow-y: auto;max-height: 702px;">
                    <div id="modal-row" class="row">
                        <div id="form-template" class="col-12 col-lg-6 col-xl-4 mb-3" style="display: none;">
                            <div class="card">
                                <div class="card-body">
                                    <form>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Nama Barang</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Satuan</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;" oninput="this.value = this.value.replace(/[^0-9.]/g, &#39;&#39;).replace(/(\..*?)\..*/g, &#39;$1&#39;).replace(/^0[^.]/, &#39;0&#39;);">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Jumlah</p>
                                        </div>
                                        <div class="position-relative"><input class="form-control" type="text" style="height: 32px;" oninput="this.value = this.value.replace(/[^0-9.]/g, &#39;&#39;).replace(/(\..*?)\..*/g, &#39;$1&#39;).replace(/^0[^.]/, &#39;0&#39;);">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Harga Satuan</p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <form>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Nama Barang</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Satuan</p>
                                        </div>
                                        <div class="position-relative mb-3"><input class="form-control" type="text" style="height: 32px;" oninput="this.value = this.value.replace(/[^0-9.]/g, &#39;&#39;).replace(/(\..*?)\..*/g, &#39;$1&#39;).replace(/^0[^.]/, &#39;0&#39;);">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Jumlah</p>
                                        </div>
                                        <div class="position-relative"><input class="form-control" type="text" style="height: 32px;" oninput="this.value = this.value.replace(/[^0-9.]/g, &#39;&#39;).replace(/(\..*?)\..*/g, &#39;$1&#39;).replace(/^0[^.]/, &#39;0&#39;);">
                                            <p class="position-absolute" style="font-size: 10px;top: -8px;left: 8px;background-color: white;">Harga Satuan</p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button><button class="btn" id="new-form" type="button" style="background: var(--bs-teal);color: white;">Tambah Form Baru</button><button class="btn" id="save-barang" type="button" style="background: rgb(24, 144, 255);color: white;">Simpan</button></div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/side-nav.js"></script>
    <script src="assets/js/table-item.js"></script>
</body>

</html>
