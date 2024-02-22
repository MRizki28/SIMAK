<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIMAK - LOGIN</title>
    @include('Layouts.styles')
</head>

<body style="background-color: #f5f5f5;">
    <div class="d-flex justify-content-center align-items-center h-100" style="min-height: 100vh">
        <div class="content-wrapper">
            <div class=" d-flex justify-content-center align-items-center" style="padding: 1.25rem 1.25rem; flex-grow: 1;">
                <form style="width: 20rem;">
                    <div class="card mb-0" style="border: -1px solid black !important;">
                        <div class="card-body">
                            <div class="text-center  ">
                                <img src="{{ asset('img/logo/SIMAK.png') }}" alt="login" width="140"
                                    height="100%">
                                <h5 class="mb-0 mt-1 font-weight-bold">Masuk ke akun Anda</h5>
                            </div>
                            <div>
                                <div class="form-group form-validation">
                                    <input type="text" class="form-control" placeholder="Email@gmail.com">
                                </div>
                                <div class="form-group form-validation">
                                    <input type="text" class="form-control" placeholder="Password">
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block p-2">Login</button>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <img src="{{ asset("img/logo/footerlogo.png") }}" width="100%">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12 text-center">
                                    <a href="https://api.whatsapp.com/send?phone=082290333669&text=Hallo%20saya%20butuh%20bantuan%20login!" target="_blank">
                                        <button type="button" class="btn btn-info btn-sm">Bantuan <i class="icon-help ml-2"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

@include('Layouts.scripts')

</html>
