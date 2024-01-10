@extends('dashboard.dashlayouts.style')
<div class="section">
    <!-- Hero Slides-->
    <div class="owl-carousel-one owl-carousel mb-3">
        <!-- Single Hero Slide-->
        <div class="single-hero-slide bg-overlay"
            style="background-image: url('{{ asset('apk/assets/img/bg-img/maa.jpg') }}')">
            <div class="slide-content h-100 d-flex align-items-center text-center">
                <div class="container">
                    <h4 class="text-white mt-5" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">
                        Ta'aruf Jodohku v.2.0</h4>
                    <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">
                        Temukan pasangan sempurna anda diantara karyawan YPI Al Azhar melalui apllikasi ini.</p><a
                        class="btn btn-creative btn-warning" href="/taaruf" data-animation="fadeInUp" data-delay="800ms"
                        data-wow-duration="500ms">Lanjutkan</a>
                </div>
            </div>
        </div>
        <!-- Single Hero Slide-->
        <div class="single-hero-slide bg-overlay"
            style="background-image: url('{{ asset('apk/assets/img/bg-img/nikah.jpg') }}')">
            <div class="slide-content h-100 d-flex align-items-center text-center">
                <div class="container">
                    <h4 class="text-white mt-5" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">
                        Aula Buya Hamka</h4>
                    <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">
                        Masjid Agung Al Azhar menyediakan aula serba guna untuk acara yang anda niatkan.</p><a
                        class="btn btn-creative btn-warning" href="https://www.instagram.com/abhalazhar/?hl=id"
                        target="_blank" data-animation="fadeInUp" data-delay="800ms"
                        data-wow-duration="500ms">Lanjutkan</a>
                </div>
            </div>
        </div>
        <!-- Single Hero Slide-->
        <div class="single-hero-slide bg-overlay"
            style="background-image: url('{{ asset('apk/assets/img/bg-img/konsul.jpg') }}')">
            <div class="slide-content h-100 d-flex align-items-center text-center">
                <div class="container">
                    <h4 class="text-white mt-5" data-animation="fadeInUp" data-delay="100ms" data-wow-duration="1000ms">
                        Layanan Konsultasi</h4>
                    <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms" data-wow-duration="1000ms">
                        Konsultasikan semua permasalahan anda bersama ustadz di Masjid Agung Al Azhar.</p><a
                        class="btn btn-creative btn-warning" href="https://wa.link/w2hf7i" target="_blank"
                        data-animation="fadeInUp" data-delay="800ms" data-wow-duration="500ms">Lanjutkan</a>
                </div>
            </div>
        </div>
    </div>
    {{-- Area Unit dan Masjid --}}
    <div class="py-2">
        <div class="container direction-rtl mb-3">
            <div class="row g-4">
                <div class="col-4">
                    <div class="feature-card mx-auto text-center direction-rtl">
                        <div class="card shadow mx-auto">
                            <a class="mx-auto" href="https://www.al-azhar.or.id/" target="_blank">
                                <img src="{{ asset('apk/assets/img/demo-img/logoypi.png') }}" alt="">
                            </a>
                        </div>
                        <p>
                            <a href="https://www.al-azhar.or.id/" class="mb-0">YPI Al Azhar
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="feature-card mx-auto text-center direction-rtl">
                        <div class="card shadow mx-auto">
                            <a class="mx-auto" href="https://www.masjidagungalazhar.com/" target="_blank">
                                <img src="{{ asset('apk/assets/img/demo-img/logomaa.png') }}" alt="">
                            </a>
                        </div>
                        <p>
                            <a href="https://www.masjidagungalazhar.com/" class="mb-0">MAA
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="feature-card mx-auto text-center">
                        <div class="card shadow mx-auto">
                            <a class="mx-auto" href="https://alazharpeduli.or.id/" target="_blank">
                                <img src="{{ asset('apk/assets/img/demo-img/logolaz.png') }}" alt="">
                            </a>
                        </div>
                        <p>
                            <a href="https://alazharpeduli.or.id/" class="mb-0">LAZ Al Azhar
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="feature-card mx-auto text-center">
                        <div class="card shadow mx-auto">
                            <a class="mx-auto" href="https://wakafalazhar.com/" target="_blank">
                                <img src="{{ asset('apk/assets/img/demo-img/logowakaf.png') }}" alt="">
                            </a>
                        </div>
                        <p>
                            <a href="https://wakafalazhar.com/" class="mb-0">Wakaf Al Azhar
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="feature-card mx-auto text-center">
                        <div class="card shadow mx-auto">
                            <a class="mx-auto" href="https://donasi.online/masjid-agung-al-azhar/donasi"
                                target="_blank">
                                <img src="{{ asset('apk/assets/img/demo-img/donasi.png') }}" alt="">
                            </a>
                        </div>
                        <p>
                            <a href="https://donasi.online/masjid-agung-al-azhar/donasi" class="mb-0">Donasi MAA
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="feature-card mx-auto text-center">
                        <div class="card shadow mx-auto">
                            <a class="mx-auto" href="https://www.instagram.com/abhalazhar/?hl=id" target="_blank">
                                <img src="{{ asset('apk/assets/img/demo-img/abh.png') }}" alt="">
                            </a>
                        </div>
                        <p>
                            <a href="https://www.instagram.com/abhalazhar/?hl=id" class="mb-0">Aula Buya Hamka
                            </a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Area Berita --}}
    <div class="section bg-overlay mt-3">
        <div class="row">
            <div class="col-12">
                <h4 class="text-center align-content-center text-light">Berita & Artikel</h4>
            </div>
        </div>
    </div>
    <div class="py-2">
        <div class="container direction-rtl mb-3">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card feature-card mb-3 direction-rtl">
                        @if ($databerita->count() > 0)
                            <div class="card-body">
                                @php
                                    $d = $databerita->first();
                                    $path = Storage::url('uploads/berita/' . $d->foto);
                                @endphp
                                <img src="{{ $path }}">
                                <h3 class="mt-2">{{ $d->judul }} </h3>
                                <p class="text-dark mb-4">{{ $d->subjudul }}</p>
                                <a class="btn btn-info"
                                    href="/masterberita/berita/{{ $d->id }}">Selengkapnya</a>
                            </div>
                        @else
                            <div class="card-body">
                                <p>Tidak ada berita yang tersedia.</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    @foreach ($databerita as $index => $d)
                        @if ($index < 4)
                            <div class="card feature-card mb-1 direction-rtl">
                                <div class="card-body d-flex mx-auto">
                                    @php
                                        $path = Storage::url('uploads/berita/' . $d->foto);
                                    @endphp
                                    <img src="{{ $path }}" width="80" height="80"
                                        style="margin-right: 10px">
                                    <p>{{ $d->subjudul }} <a
                                            href="/masterberita/berita/{{ $d->id }}"><b>Selengkapnya</b></a>
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    {{-- Data hadits --}}
    <div class="page-content-wrapper" style="margin-top: 5px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-primary mb-3 shadow-sm bg-gradient direction-rtl">
                        <div class="card-body text-center">
                            <h2 class="text-white" style="text-align: left;">Hadits harian</h2>
                            <p class="text-white mb-4" style="text-align: justify;">"Rasulullah Shallallahualaihi
                                Wasallam bersabda: Semoga
                                Allah
                                merahmati seorang laki-laki yang bangun di malam hari lalu dia melaksanakan shalat
                                (malam), kemudian dia membangunkan istrinya, kalau istrinya enggan maka dia akan
                                memercikkan air pada wajahnya(HR Abu Dawud (no. 1308) dan Ibnu Majah (no. 1336),
                                dinyatakan shahih oleh syaikh al-Albani)."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="testimonial-slide owl-carousel testimonial-style3">
                        @foreach ($datayoutube as $dd)
                            <div class="single-testimonial-slide">
                                <div class="text-content mb-2">
                                    <a href="{{ $dd->link }}" target="_blank">
                                        @php
                                            $path = Storage::url('uploads/youtube/' . $dd->gambar);
                                        @endphp
                                        <img src="{{ $path }}" class="mb-2" alt="YouTube Live">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-3"></div>
    </div>

    {{-- Kontak Kami --}}
    <div class="section bg-overlay">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-1 mt-2 text-light text-center">Kontak Kami</h4>
                <div class="container direction-rtl">
                    <div class="card-body">
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
                        <div class="contact-form">
                            <form action="/daftartanya/storetanya" method="POST">
                                @csrf
                                <div class="form-group mb-2">
                                    <input class="form-control" type="email" placeholder="Masukkan email"
                                        name="email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <textarea class="form-control form-control-clicked" name="pertanyaan" cols="30" rows="10"
                                        placeholder="Tulis pertanyaan" required></textarea>
                                </div>
                                <button class="btn btn-info w-100" type="submit">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
                <h4 class="mb-1 text-light text-center">Lokasi</h4>
                <div class="container direction-rtl">
                    <div class="card-body">
                        <iframe
                            src="https://maps.google.com/maps?q=masjid%20agung%20al%20azhar&amp;t=k&amp;z=19&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                            frameborder="0" scrolling="no" style="width: 100%"></iframe>

                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Footer --}}
    <div class="section bg-overlay">
        <div class="row">
            <div class="col-12">
                <p class="text-light text-center mt-3"><small>Copyright 2024 | Direktorat Dakwah Sosial<br> | Created
                        by
                        DAL
                        Army</small></p>
            </div>
        </div>
    </div>
</div>
