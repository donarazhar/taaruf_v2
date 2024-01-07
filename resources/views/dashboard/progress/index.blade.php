@extends('dashboard.dashlayouts.topbarprogress')
{{-- Footer --}}
<div class="section bg-info">
    <div class="row">
        <div class="col-12">
            <p class="text-dark text-center mt-3">
                &nbsp;
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
                            {{-- Pesan error --}}
                            @if (Session::get('success'))
                                <div class="alert alert-light">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            @if (Session::get('warning'))
                                <div class="alert alert-warning">
                                    {{ Session::get('warning') }}
                                </div>
                            @endif
                            <div class="service-text">
                                <div class="card position-relative shadow-sm">
                                    @foreach ($dataprogress as $d)
                                        @php
                                            // Data berdasarkan email_auth
                                            $dataAuth = DB::table('karyawan')
                                                ->leftJoin('progress', 'karyawan.email', '=', 'progress.email_auth')
                                                ->leftJoin('likedislike', 'progress.email_auth', '=', 'likedislike.emailact')
                                                ->where('progress.email_auth', $d->email_auth)
                                                ->select('likedislike.status', 'karyawan.nama', 'karyawan.nip', 'karyawan.jenkel', 'karyawan.foto')
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
                                                style="height:60px"> <span
                                                class="badge 
                                                @if ($dataAuth->status === 1) bg-success
                                                @elseif ($dataAuth->status === 0)
                                                    bg-primary
                                                @else
                                                    bg-secondary @endif">
                                                @if ($dataAuth->status === 1)
                                                    Sudah Cocok
                                                @elseif ($dataAuth->status === 0)
                                                    Maaf Tidak Cocok
                                                @else
                                                    On Progress
                                                @endif
                                            </span>

                                            <p style="color: black;">{{ isset($dataAuth) ? $dataAuth->nama : '' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Data pasangan --}}
                    <div class="col-md-12 col-sm-12">
                        <div class="card-body mx-5">
                            <div class="service-text">
                                <div class="card position-relative shadow-sm">
                                    @foreach ($dataprogress as $d)
                                        @php
                                            // Data berdasarkan email_profile
                                            $dataProfile = DB::table('karyawan')
                                                ->leftJoin('progress', 'karyawan.email', '=', 'progress.email_profile')
                                                ->leftJoin('likedislike', 'progress.email_profile', '=', 'likedislike.emailact')
                                                ->where('progress.email_profile', $d->email_profile)
                                                ->select('likedislike.status', 'karyawan.nama', 'karyawan.nip', 'karyawan.jenkel', 'karyawan.foto', 'progress.id as progress_id')
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
                                                style="height:60px"> <span
                                                class="badge 
                                                @if ($dataProfile->status === 1) bg-success
                                                @elseif ($dataProfile->status === 0)
                                                    bg-primary
                                                @else
                                                    bg-secondary @endif">
                                                @if ($dataProfile->status === 1)
                                                    Merasa Cocok
                                                @elseif ($dataProfile->status === 0)
                                                    Maaf Tidak Cocok
                                                @else
                                                    On Progress
                                                @endif
                                            </span>

                                            <p style="color: black;">
                                                {{ isset($dataProfile) ? $dataProfile->nama : '' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Data tombol --}}
                    @foreach ($dataprogress as $d)
                        @php
                            // Mengambil data status dari tabel likedislike
                            $likedislikeStatus = $likedislike
                                ->where('id_progress', $d->id)
                                ->where('emailact', Auth::guard('karyawan')->user()->email)
                                ->first();
                        @endphp
                        <div class="col-md-12 col-sm-12">
                            <div class="card-body mx-1">
                                <div class="service-text">
                                    <div class="card position-relative shadow-sm">
                                        {{-- Tombol Like --}}
                                        <a class="btn btn-success {{ $likedislikeStatus && $likedislikeStatus->status == 1 ? 'disabled btn-light' : '' }}"
                                            href="{{ route('like', ['id' => isset($d->id) ? $d->id : 0]) }}">Cocok</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="card-body mx-1 mb-3">
                                <div class="service-text">
                                    <div class="card position-relative shadow-sm">
                                        {{-- Tombol Dislike --}}
                                        <a class="btn btn-danger {{ $likedislikeStatus && $likedislikeStatus->status == 0 ? 'disabled btn-light' : '' }}"
                                            href="{{ route('dislike', ['id' => isset($d->id) ? $d->id : 0]) }}">Tidak
                                            Cocok</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fab-button animate bottom-right dropdown" style="margin-bottom: 70px">
                            <a href="{{ route('chat', ['id' => isset($d->id) ? $d->id : 0]) }}"
                                class="fab bg-light text-dark" data-toggle="dropdown"> Chat
                                <ion-icon name="add-outline" role="img" class="md hydrated"
                                    aria-label="add outline"></ion-icon>
                            </a>
                        </div>
                        <button class="btn btn-submit" type="submit"><svg xmlns="http://www.w3.org/2000/svg"
                                width="18" height="18" fill="currentColor" class="bi bi-cursor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103zM2.25 8.184l3.897 1.67a.5.5 0 0 1 .262.263l1.67 3.897L12.743 3.52 2.25 8.184z">
                                </path>
                            </svg>
                        </button>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@extends('dashboard.dashlayouts.footer')
@extends('dashboard.dashlayouts.script')
@extends('dashboard.dashlayouts.header')
