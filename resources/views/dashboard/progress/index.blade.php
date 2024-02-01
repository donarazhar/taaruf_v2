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
            <div class="card bg-light bg-gradient">
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
                                                style="height:60px">
                                            <span
                                                class="badge 
                                                @if ($dataAuth->status == 1) bg-success
                                                @elseif ($dataAuth->status == 0)
                                                    bg-primary
                                                @else
                                                    bg-secondary @endif">
                                                @if ($dataAuth->status == 1)
                                                    Sudah Cocok
                                                @elseif ($dataAuth->status == 0)
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
                                                style="height:60px">

                                            <span
                                                class="badge 
                                                @if ($dataProfile->status == 1) bg-success
                                                @elseif ($dataProfile->status == 0) bg-primary
                                                @else bg-secondary @endif">

                                                @if ($dataProfile->status == 1)
                                                    Merasa Cocok
                                                @elseif ($dataProfile->status == 0)
                                                    Maaf Tidak Cocok
                                                @else
                                                    On Progress
                                                @endif
                                            </span>

                                            <p style="color: black;">
                                                {{ isset($dataProfile) ? $dataProfile->nama : '' }}
                                            </p>
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
                                            href="{{ route('like', ['id' => isset($d->id) ? $d->id : 0]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-hand-thumbs-up-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z" />
                                            </svg>
                                            Cocok</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="card-body mx-1">
                                <div class="service-text">
                                    <div class="card position-relative shadow-sm">
                                        {{-- Tombol Dislike --}}
                                        <a class="btn btn-danger {{ $likedislikeStatus && $likedislikeStatus->status == 0 ? 'disabled btn-light' : '' }}"
                                            href="{{ route('dislike', ['id' => isset($d->id) ? $d->id : 0]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-heartbreak-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.931.586 7 3l1.5 4-2 3L8 15C22.534 5.396 13.757-2.21 8.931.586M7.358.77 5.5 3 7 7l-1.5 3 1.815 4.537C-6.533 4.96 2.685-2.467 7.358.77" />
                                            </svg> Tidak
                                            Cocok</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="card-body mx-1 mb-3">
                                <div class="service-text">
                                    <div class="card position-relative shadow-sm">
                                        {{-- Tombol Dislike --}}
                                        <a class="btn btn-success"
                                            href="{{ route('chat', ['id' => isset($d->id) ? $d->id : 0]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="currentColor" class="bi bi-chat-left-dots-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0m4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                                            </svg>
                                            Chat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fab-button animate bottom-right dropdown" style="margin-bottom: 70px">

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@extends('dashboard.dashlayouts.footer')
@extends('dashboard.dashlayouts.script')
@extends('dashboard.dashlayouts.header')
