@extends('dashboard.dashlayouts.topbarchat')

<div class="page-content-wrapper py-3 chat-wrapper">
    <div class="container">
        <div class="chat-content-wrap">
            <!-- Single Chat Item-->
            @foreach ($datachat as $d)
                <div class="single-chat-item">
                    <!-- User Avatar-->
                    <div class="user-avatar mt-1">
                        <span class="name-first-letter">
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

                        </span>
                        <img class="my-2"
                            src="{{ !empty($pathAuth) ? url($pathAuth) : asset('assets/img/' . $defaultAvatarAuth) }}"
                            class="user-avatar {{ isset($dataAuth) && $dataAuth->jenkel === 'pria' ? '' : 'img-fluid' }}">

                    </div>
                    <!-- User Message-->
                    <div class="user-message">
                        <div class="message-content">
                            <div class="single-message">
                                <p>{{ $dataAuth->nama }}</p>
                            </div>
                            <!-- Options-->
                            <div class="dropstart">
                                <button class="btn btn-options dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="bi bi-reply"></i>Reply</a></li>
                                    <li><a href="#"><i class="bi bi-forward"></i>Forward</a></li>
                                    <li><a href="#"><i class="bi bi-trash"></i>Remove</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Time and Status-->
                        <div class="message-time-status">
                            <div class="sent-time">11:39 AM</div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($datachat as $d)
                <!-- Single Chat Item-->
                <div class="single-chat-item outgoing">
                    <!-- User Avatar-->
                    <div class="user-avatar mt-1">
                        <!-- If the user avatar isn't available, will visible the first letter of the username.-->
                        <span class="name-first-letter">
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
                        </span>
                        <img class="my-2"
                            src="{{ !empty($pathProfile) ? url($pathProfile) : asset('assets/img/' . $defaultAvatarProfile) }}"
                            class="user-avatar {{ isset($dataProfile) && $dataProfile->jenkel === 'pria' ? '' : 'img-fluid' }}">
                    </div>
                    <!-- User Message-->
                    <div class="user-message">
                        <div class="message-content">
                            <div class="single-message">
                                <p>{{ $dataProfile->nama }}</p>
                            </div>
                            <!-- Options-->
                            <div class="dropstart">
                                <button class="btn btn-options dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="bi bi-reply"></i>Reply</a></li>
                                    <li><a href="#"><i class="bi bi-forward"></i>Forward</a></li>
                                    <li><a href="#"><i class="bi bi-trash"></i>Remove</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Time and Status-->
                        <div class="message-time-status">
                            <div class="sent-time">11:46 AM</div>
                            <div class="sent-status seen"><i class="fa fa-check" aria-hidden="true"></i></div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

<div class="chat-footer">
    <div class="container h-100">
        <div class="chat-footer-content h-100 d-flex align-items-center">
            <form action="#">
                <!-- Message-->
                <input class="form-control form-control-clicked" type="text" placeholder="Type here...">
                <!-- Emoji-->
                <button class="btn btn-emoji mx-2" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                        <path
                            d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z">
                        </path>
                    </svg>
                </button>
                <!-- Add File-->
                <div class="dropup me-2">
                    <button class="btn btn-add-file dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                            </path>
                        </svg>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="bi bi-files"></i>Files</a></li>
                        <li><a href="#"><i class="bi bi-mic"></i>Audio</a></li>
                        <li><a href="#"><i class="bi bi-file-earmark"></i>Document</a></li>
                        <li><a href="#"><i class="bi bi-file-bar-graph"></i>Pull</a></li>
                        <li><a href="#"><i class="bi bi-geo-alt"></i>Location</a></li>
                    </ul>
                </div>
                <!-- Send-->
                <button class="btn btn-submit" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="18"
                        height="18" fill="currentColor" class="bi bi-cursor" viewBox="0 0 16 16">
                        <path
                            d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103zM2.25 8.184l3.897 1.67a.5.5 0 0 1 .262.263l1.67 3.897L12.743 3.52 2.25 8.184z">
                        </path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

{{-- @extends('dashboard.dashlayouts.footer') --}}
@extends('dashboard.dashlayouts.script')
@extends('dashboard.dashlayouts.header')
