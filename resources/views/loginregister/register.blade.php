<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from brandio.io/envato/iofrm/html/register9.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 15 Oct 2023 16:30:13 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Hotel</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="css/iofrm-theme9.css">
</head>
<body>
    <div class="form-body">
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h3></h3>
                    <p></p>
                    <img src="{{ asset('assets/img/image 3.jpg') }}" style="border-radius: 15px;" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="website-logo-inside">
                            <a href="index.html">
                            </a>
                        </div>
                        <div class="page-links">
                            <a href="user">Masuk</a><a href="register" class="active">Daftar</a>
                        </div>
                        <form action="{{ route('authenticate') }}" method="POST">
                        @csrf
                            <input class="form-control" type="text" name="name" placeholder="Masukkan nama anda">
                            @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                 @endif
                            <input class="form-control" type="email" name="email" placeholder="Masukkan Alamat Email Anda" >
                            @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                 @endif
                            <input class="form-control" type="password" name="password" placeholder="Masukkan Kata Sandi" >
                            @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                 @endif
                            <input class="form-control" type="password" name="konfirmpassword" placeholder="Konfirmasi Password" >
                            @if ($errors->has('konfirmpassword'))
                                    <span class="text-danger">{{ $errors->first('konfirmpassword') }}</span>
                                 @endif
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Register</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>

<!-- Mirrored from brandio.io/envato/iofrm/html/register9.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 15 Oct 2023 16:30:13 GMT -->
</html>
