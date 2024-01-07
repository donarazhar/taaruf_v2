<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags-->
    <!-- Title-->
    <title>AC-Mobile UI Neumorphism</title>
    <!-- Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('apk/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('apk/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('apk/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('apk/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('apk/assets/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('apk/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('apk/assets/css/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('apk/assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('apk/assets/css/apexcharts.css') }}">
    <!-- Core Stylesheet-->
    <link rel="stylesheet" href="{{ asset('apk/style.css') }}">
    <!-- Web App Manifest-->
    <link rel="manifest" href="manifest.json">
</head>

<body>
    <!-- Preloader-->
    <div class="preloader d-flex align-items-center justify-content-center" id="preloader">
        <div class="spinner-grow text-primary" role="status">
            <div class="sr-only">Loading...</div>
        </div>
    </div>
    <!-- Internet Connection Status-->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Login Wrapper Area-->
    <div class="login-wrapper d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5">
                    <div class="text-center px-4"><img class="login-intro-img" src="../apk/assets/img/bg-img/36.png"
                            alt="">
                    </div>
                    <!-- Register Form-->
                    <div class="register-form mt-4 px-4">
                        {{-- Pesan error --}}
                        @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::get('warning'))
                            <div class="alert alert-warning">
                                {{ Session::get('warning') }}
                            </div>
                        @endif
                        <h6 class="mb-3 text-center">Panel Admin Ta'aruf APP</h6>
                        <form action="/prosesloginadmin" method="POST" id="frmlogin">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="text" name="email" id="email"
                                    placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" id="password"
                                    placeholder="Password" required>
                            </div>
                            <button class="btn btn-primary w-100" type="submit">Masuk</button>
                        </form>
                    </div>
                    <!-- Login Meta-->
                    <div class="login-meta-data text-center mt-3">
                        <p class="mb-0">Anda belum punya akun? <a class="stretched-link"
                                href="page-register.html">Daftar Sekarang</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- All JavaScript Files-->
    <script src="{{ asset('apk/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('apk/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('apk/assets/js/default/internet-status.js') }}"></script>
    <script src="{{ asset('apk/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('apk/assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('apk/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('apk/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('apk/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('apk/assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('apk/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('apk/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('apk/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('apk/assets/js/default/dark-mode-switch.js') }}"></script>
    <script src="{{ asset('apk/assets/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('apk/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('apk/assets/js/default/active.js') }}"></script>
    <script src="{{ asset('apk/assets/js/default/clipboard.js') }}"></script>
    <!-- PWA-->
    <script src="{{ asset('apk/assets/js/pwa.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
</body>

</html>
