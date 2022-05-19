<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>pasar</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <button><a href="totrans">trans</a></button>
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
    <div>
        <div id="side-nav" class="position-relative" style="width: 200px;height: calc(100vh - 50px);background: rgb(45,55,60);color: white;">
            <div id="nav-group-1" class="nav-group py-2">
                <div id="nav-item-dashboard" class="d-flex align-items-center ps-3 nav-item active"><i class="fas fa-tachometer-alt me-3"></i>
                    <p>Dashboard</p>
                </div>
                <div id="nav-item-items" class="d-flex align-items-center ps-3 nav-item"><i class="fas fa-shopping-basket me-3"></i>
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
        <div id="content"></div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/dashboard.js"></script>
</body>

</html>
