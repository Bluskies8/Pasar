<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">

<div class="vh-100 vw-100 d-flex justify-content-center align-items-center">
    <div class="container" style="max-width: 900px; width: 90%;">
        <div class="row">
            <div class="col-7">
                <img class="w-100" src="{{asset('img/logo.jpeg')}}" style="object-fit: cover;">
            </div>
            <div class="col-5">
                <form class="h-100 px-5 mb-0 d-flex flex-column justify-content-center">
                    <h2 class="text-center"><strong>Rubah</strong> password</h2>
                    <div class="mb-3"><input type="email" class="form-control" name="email" placeholder="E-mail" disabled/><!-- get email --></div>
                    <div class="mb-3"><input id="old-pass" type="password" class="form-control" name="old-password" placeholder="Password Lama" /></div>
                    <div class="mb-3"><input id="new-pass" type="password" class="form-control" name="new-password" placeholder="Password Baru" /></div>
                    <div class="mb-3">
                        <button id="btn-change-pass" class="btn w-100" style="background-color: #38A34A; color: white;" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
