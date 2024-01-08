@extends('dashboard.dashlayouts.berita')
<div class="page-content-wrapper">
    <div class="container">
        <div class="pt-3 d-block"></div>
        <div class="blog-details-post-thumbnail position-relative">
            {{-- <img class="w-100 rounded-lg" src="img/bg-img/24.jpg" alt=""> --}}
            @php
                $path = Storage::url('uploads/berita/' . $databerita->foto);
            @endphp
            <img class="w-100 rounded-lg" src="{{ $path }}">
        </div>
    </div>
    <div class="blog-description py-3">
        <div class="container"><a class="badge bg-primary mb-2 d-inline-block" href="#">Berita</a>
            <h3 class="mb-3">{{ $databerita->judul }}</h3>
            <div class="d-flex align-items-center mb-4"><a class="badge-avater" href="#"><img class="img-circle"
                        src="{{ asset('apk/assets/img/demo-img/logoypi.png') }}" alt=""></a><span
                    class="ms-2">Admin</span>
            </div>
            <p class="justify-align-center">{!! $databerita->isi !!}</p>
        </div>
    </div>

</div>
