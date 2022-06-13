<div id="side-nav" class="position-relative" style="width: 200px;height: calc(100vh - 50px);background: rgb(45,55,60);color: white;">
    <div id="nav-group-1" class="nav-group py-2">

        @if (auth()->guard('checkLogin')->user()->role_id == 2)
        <a href="/" id="nav-item-dashboard" class="d-flex align-items-center ps-3 nav-item">
            <i class="fas fa-tachometer-alt me-3"></i>
            <p>Dashboard</p>
        </a>
        @endif
        <a href="/stock" id="nav-item-items" class="d-flex align-items-center ps-3 nav-item">
            <i class="fas fa-shopping-basket me-3"></i>
            <p>Items</p>
        </a>
        <a href="/invoice" id="nav-item-invoice" class="d-flex align-items-center ps-3 nav-item">
            <i class="fas fa-file-invoice me-3"></i>
            <p>Invoice</p>
        </a>
        @if (auth()->guard('checkLogin')->user()->role_id == 2)
        <a href="/vendor" id="nav-item-denah" class="d-flex align-items-center ps-3 nav-item">
            <i class="fas fa-user me-3"></i>
            <p>Denah</p>
        </a>
        @endif
    </div>
    {{-- <div id="nav-group-2" class="nav-group py-2">
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
        <div id="nav-item-payment_received" class="d-flex align-items-center ps-3 nav-item"><i class="fas fa-dollar-sign me-3"></i>
            <p>Payment Received</p>
        </div>
        <div id="nav-item-return" class="d-flex align-items-center ps-3 nav-item"><i class="fas fa-retweet me-3"></i>
            <p>Return</p>
        </div>
    </div> --}}
    <button class="btn position-absolute d-flex align-items-center justify-content-center p-1" id="minimize-nav" type="button" style="bottom: 0px;color: white;background-color: rgb(34,43,47);border-radius: 0px;box-shadow: none;width: 200px;">
        <i class="fas fa-chevron-left" id="minimize-icon"></i>
    </button>
</div>

<script src="{{asset('js/side-nav.js')}}"></script>
