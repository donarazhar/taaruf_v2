@extends('dashboard.dashlayouts.topbarprogress')
{{-- Footer --}}
<div class="section bg-info">
    <div class="row">
        <div class="col-12">
            <p class="text-dark text-center mt-3">
                Copyright 2024 | Direktorat Dakwah Sosial
            </p>

        </div>
    </div>
    <div class="page-content-wrapper py-3">
        <div class="container">
            <!-- Service Card-->
            <div class="card bg-primary bg-gradient">
                <div class="row text-center">
                    <div class="col-md-12 col-sm-12">
                        <div class="card-body mx-5 mt-2">
                            <div class="service-text">
                                <div class="card position-relative shadow-sm">
                                    @foreach ($dataprogress as $d)
                                        @php
                                            // Data berdasarkan email_auth
                                            $dataAuth = DB::table('karyawan')
                                                ->leftJoin('progress', 'karyawan.email', '=', 'progress.email_auth')
                                                ->where('progress.email_auth', $d->email_auth)
                                                ->select('karyawan.nama', 'karyawan.jenkel', 'karyawan.foto')
                                                ->first();

                                            $pathAuth = isset($dataAuth) && !empty($dataAuth->foto) ? Storage::url('uploads/karyawan/img/' . $dataAuth->foto) : '';
                                            $defaultAvatarAuth = isset($dataAuth) && $dataAuth->jenkel === 'pria' ? 'avatar.jpg' : 'avatarwanita.jpg';

                                        @endphp

                                        {{-- Data berdasarkan email_auth --}}
                                        <div>
                                            <img class="my-2"
                                                src="{{ !empty($pathAuth) ? url($pathAuth) : asset('assets/img/' . $defaultAvatarAuth) }}"
                                                alt="avatar_auth"
                                                class="imaged w64 {{ isset($dataAuth) && $dataAuth->jenkel === 'pria' ? '' : 'img-fluid' }}"
                                                style="height:60px">
                                            <p style="color: black;">{{ isset($dataAuth) ? $dataAuth->nama : '' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="card-body mx-5">
                            <div class="service-text">
                                <div class="card position-relative shadow-sm">
                                    @foreach ($dataprogress as $d)
                                        @php
                                            // Data berdasarkan email_profile
                                            $dataProfile = DB::table('karyawan')
                                                ->leftJoin('progress', 'karyawan.email', '=', 'progress.email_profile')
                                                ->where('progress.email_profile', $d->email_profile)
                                                ->select('karyawan.nama', 'karyawan.jenkel', 'karyawan.foto')
                                                ->first();

                                            $pathProfile = isset($dataProfile) && !empty($dataProfile->foto) ? Storage::url('uploads/karyawan/img/' . $dataProfile->foto) : '';
                                            $defaultAvatarProfile = isset($dataProfile) && $dataProfile->jenkel === 'pria' ? 'avatar.jpg' : 'avatarwanita.jpg';
                                        @endphp

                                        {{-- Data berdasarkan email_profile --}}
                                        <div>
                                            <img class="my-2"
                                                src="{{ !empty($pathProfile) ? url($pathProfile) : asset('assets/img/' . $defaultAvatarProfile) }}"
                                                alt="avatar_profile"
                                                class="imaged w64 {{ isset($dataProfile) && $dataProfile->jenkel === 'pria' ? '' : 'img-fluid' }}"
                                                style="height:60px">
                                            <p style="color: black;">
                                                {{ isset($dataProfile) ? $dataProfile->nama : '' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="card-body mx-1">
                            <div class="service-text">
                                <div class="card position-relative shadow-sm">
                                    <a class="btn btn-success" href="">Cocok</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="card-body mx-1 mb-3">
                            <div class="service-text">
                                <div class="card position-relative shadow-sm">
                                    <a class="btn btn-danger" href="">Tidak Cocok</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@extends('dashboard.dashlayouts.footer')
@extends('dashboard.dashlayouts.script')
@extends('dashboard.dashlayouts.header')
