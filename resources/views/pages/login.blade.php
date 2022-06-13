<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>Pasar</title>
<link rel="stylesheet" href="{{asset('css/Login-Form-Clean.css')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

<style>
    body {
        background: #f1f7fc;
        height: 90vh;
        display: flex!important;
        align-items: center!important;
    }
</style>

<section class="login-clean container">
    <form method="post" action='/clogin'>
        @csrf
        <h2 class="visually-hidden">Login Form</h2>
        <div class="illustration"><img class="w-100" src="{{asset('img/logo.svg')}}"></div>
        <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Masukan E-mail"></div>
        <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Masukan Password"></div>
        @if (session('pesan'))
            <div style="color:red; font-weight:bold; text-align: center;"> {{session('pesan')}}</div>
        @endif
        <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" style="background: var(--bs-info);">Log In</button></div><a class="forgot" href="#">Lupa e-mail atau password?</a>
    </form>
</section>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bs-init.js')}}"></script>

<script>
    $(document).ready(function() {
        setCookie("nav_active", "dashboard", 1);

        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires="+d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
    });
</script>
