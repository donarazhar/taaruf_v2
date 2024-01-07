@extends('dashboard.dashlayouts.topbarchat')

<div class="page-content-wrapper py-3 chat-wrapper">
    <div class="container">
        <div class="chat-content-wrap">
            @foreach ($datachat as $d)
                @if ($d->email_sender == auth()->user()->email)
                    <!-- Outgoing Chat Item -->
                    <div class="single-chat-item outgoing">
                        <div class="user-avatar mt-1">
                            <span class="name-first-letter">
                                @php
                                    $pathchat = isset($d) && !empty($d->foto) ? Storage::url('uploads/karyawan/img/' . $d->foto) : '';
                                    $defaultAvatarchat = isset($d) && $d->jenkel === 'pria' ? 'avatar.jpg' : 'avatarwanita.jpg';
                                @endphp
                            </span>
                            <img class="my-2"
                                src="{{ !empty($pathchat) ? url($pathchat) : asset('assets/img/' . $defaultAvatarchat) }}"
                                class="user-avatar {{ isset($d) && $d->jenkel === 'pria' ? '' : 'img-fluid' }}">
                        </div>
                        <div class="user-message">
                            <div class="message-content">
                                <div class="single-message">
                                    <p>{{ $d->pesan }}</p>
                                </div>
                            </div>
                            <div class="message-time-status">
                                <div class="sent-time">{{ date('d-m-Y H:i:s'), strtotime($d->tgl_pesan) }}</div>
                                <div class="sent-status seen"><i class="fa fa-check" aria-hidden="true"></i></div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Incoming Chat Item -->
                    <div class="single-chat-item">
                        <div class="user-avatar mt-1">
                            <span class="name-first-letter">
                                @php
                                    $pathchat = isset($d) && !empty($d->foto) ? Storage::url('uploads/karyawan/img/' . $d->foto) : '';
                                    $defaultAvatarchat = isset($d) && $d->jenkel === 'pria' ? 'avatar.jpg' : 'avatarwanita.jpg';
                                @endphp
                            </span>
                            <img class="my-2 user-avatar {{ isset($d) && $d->jenkel === 'pria' ? '' : 'img-fluid' }}"
                                src="{{ !empty($pathchat) ? url($pathchat) : asset('assets/img/' . $defaultAvatarchat) }}"
                                alt="{{ isset($d) ? $d->nama : 'User Avatar' }}">
                        </div>
                        <div class="user-message">
                            <div class="message-content">
                                <div class="single-message">
                                    <p>{{ $d->pesan }}</p>
                                </div>
                            </div>
                            <div class="message-time-status">
                                <div class="sent-time">{{ date('d-m-Y H:i:s'), strtotime($d->tgl_pesan) }}</div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<div class="chat-footer">
    <div class="container h-100">
        @foreach ($dataprogress as $d)
            <div class="chat-footer-content h-100 d-flex align-items-center">
                <form action="/chat/ {{ $d->id }}/store" method="POST">
                    @csrf
                    <!-- Message-->
                    <input class="form-control form-control-clicked" type="text" name="pesan" id="pesan"
                        placeholder="Type here...">
                    <!-- Send-->
                    <button class="btn btn-submit" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-cursor" viewBox="0 0 16 16">
                            <path
                                d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103zM2.25 8.184l3.897 1.67a.5.5 0 0 1 .262.263l1.67 3.897L12.743 3.52 2.25 8.184z">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>

{{-- @extends('dashboard.dashlayouts.footer') --}}
@extends('dashboard.dashlayouts.script')
@extends('dashboard.dashlayouts.header')
