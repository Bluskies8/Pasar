<link rel="stylesheet" href="{{asset('css/Login-Form-Clean.css')}}">

<section class="login-clean container">
    <form method="post" action='/login'>
        @csrf
        <h2 class="visually-hidden">Login Form</h2>
        <div class="illustration"><img class="w-100" src="{{asset('img/logo.svg')}}"></div>
        <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Masukan E-mail"></div>
        <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Masukan Password"></div>
        @if (session('pesan'))
            <div style="color:red; font-weight:bold"> {{session('pesan')}}</div>
        @endif
        <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" style="background: var(--bs-info);">Log In</button></div><a class="forgot" href="#">Lupa e-mail atau password?</a>
    </form>
</section>

