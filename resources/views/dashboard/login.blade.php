@extends('dashboard.layouts.bootstrap')
@section('content')
    <!--  CSS Pop up untuk memasukkan NIP -->
    <style>
        .btn-primary {
            background: rgba(2, 127, 194);
        }

        .card-header {
            background: rgba(2, 127, 194);
        }
    </style>

    <section id="hero">
        <div class="container">
        </div>
    </section>
    <main id="main">
        <section id="contact" class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">

                    </div>
                    <div class="col-lg-6">
                        <div class="col-lg-12 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
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
                            <div class="card">
                                <div class="card-header text-light">
                                    <b>Halaman Login</b>
                                </div>
                                <div class="card-body">
                                    <form action="/proseslogin" method="POST" id="frmlogin">
                                        @csrf
                                        <div class="form-group php-email-form" role="form">
                                            <div class="row">
                                                <div class="col-md-12 form-group mt-3 mt-md-0">
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        placeholder="Masukkan Email" required>
                                                </div>
                                                <div class="col-md-12 form-group mt-3 mt-md-0">
                                                    <input type="password" class="form-control" name="password"
                                                        id="password" placeholder="Masukkan Password" required>
                                                </div>

                                            </div>
                                            <div class="text-center mt-2">
                                                <button class="btn btn-sm w-100" type="submit">Kirim
                                                </button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
            </div>
        </section>
    </main>
@endsection
