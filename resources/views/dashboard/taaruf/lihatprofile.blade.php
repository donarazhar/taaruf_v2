@extends('dashboard.dashlayouts.topbartaaruf')

<!-- Login Wrapper Area-->
<div class="login-wrapper d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5">
                <div class="text-center px-4">
                    {{-- Foto profile --}}
                    <div class="mx-auto d-block">
                        @php
                            $path = !empty($karyawan->foto) ? Storage::url('uploads/karyawan/img/' . $karyawan->foto) : '';
                            $defaultAvatar = $karyawan->jenkel === 'pria' ? 'avatar.jpg' : 'avatarwanita.jpg';
                        @endphp
                        <img src="{{ !empty($path) ? url($path) : asset('assets/img/' . $defaultAvatar) }}" alt="avatar"
                            class="mx-auto mb-1 d-block {{ $karyawan->jenkel === 'pria' ? '' : 'img-fluid' }}"
                            style="height:240px">
                    </div>
                    {{-- Akhir Foto Profile --}}
                    <h3>{{ $karyawan->nama }}</h3>Tempat, Tgl Lahir : <span> {{ $karyawan->tempatlahir }},
                        {{ date('d/m/Y'), strtotime($karyawan->tgllahir) }}</span>
                </div>
                <div class="rating-card-two mt-4">
                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <div class="rating"><a href="#"><i class="fa fa-star-half-o"></i></a></div><span>Biodata
                            Lengkap</span>
                    </div>

                    <div class="login-meta-data text-center" style="line-height: 0.3rem;">
                        <p>Alamat : {{ $karyawan->alamat }}</p>
                        <p>Hobi : {{ $karyawan->hobi }}</p>
                        <p>Motto : {{ $karyawan->motto }}</p>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                        <div class="rating"><a href="#"><i class="fa fa-star-half-o"></i></a><a href="#"><i
                                    class="fa fa-star-half-o"></i></a></div><span>Kriteria
                            Pasangan</span>
                    </div>
                    <div class="login-meta-data text-center" style="line-height: 0.3rem;">
                        <p>Kriteria Suku : {{ $karyawan->kriteriasuku }}</p>
                        <p>Rentang Berat : {{ $karyawan->kriteriaberat }}</p>
                        <p>Rentang Tinggi : {{ $karyawan->kriteriatinggi }}</p>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>


















    @extends('dashboard.dashlayouts.footer')
    @extends('dashboard.dashlayouts.script')
    @extends('dashboard.dashlayouts.header')
