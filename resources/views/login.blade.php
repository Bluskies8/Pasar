<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>pasar</title>
    <link rel="stylesheet" href="public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="public/assets/css/styles.css">
</head>

<body class="d-flex justify-content-center align-items-center" style="background: #f1f7fc;height: 90vh;">
    <section class="login-clean container">
        <form method="post" action='/login'>
            @csrf
            <h2 class="visually-hidden">Login Form</h2>
            <div class="illustration"><img class="w-100" src="assets/img/logo.svg"></div>
            <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Masukan E-mail"></div>
            <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Masukan Password"></div>
            @if (session('pesan'))
                <div style="color:red; font-weight:bold"> {{session('pesan')}}</div>
            @endif
            <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" style="background: var(--bs-info);">Log In</button></div><a class="forgot" href="#">Lupa e-mail atau password?</a>
        </form>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
