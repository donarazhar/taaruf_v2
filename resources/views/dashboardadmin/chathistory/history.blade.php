@extends('dashboard.dashlayouts.topbarchathistory')
<div class="page-content-wrapper py-3 chat-wrapper">
    <div class="container">
        <div class="chat-content-wrap">
            @php
                $allChats = $allChats
                    ->sortBy(function ($item) {
                        return $item->tgl_pesan_sender ?? $item->tgl_pesan_profile;
                    })
                    ->values();
            @endphp
            @foreach ($allChats as $d)
                @if ($d->nama_sender && $d->pesan_sender !== null)
                    <!-- Outgoing Chat Item -->
                    <div class="single-chat-item outgoing">
                        <div class="user-avatar mt-1">
                            <span class="name-first-letter">
                                @php
                                    $pathchat = Storage::url('uploads/karyawan/img/' . $d->foto_sender);
                                @endphp
                            </span>
                            <img class="my-2 user-avatar" src="{{ url($pathchat) }}" alt="{{ $d->nama_sender }}">
                        </div>
                        <div class="user-message">
                            <div class="message-content">
                                <div class="single-message">
                                    <p>{{ $d->pesan_sender }}</p>
                                </div>
                            </div>
                            <div class="message-time-status">
                                <div class="sent-time">{{ date('d-m-Y H:i:s', strtotime($d->tgl_pesan_sender)) }}</div>
                                <div class="sent-status seen"><i class="fa fa-check" aria-hidden="true"></i></div>
                            </div>
                        </div>
                    </div>
                @elseif ($d->nama_profile && $d->pesan_profile !== null)
                    <!-- Incoming Chat Item -->
                    <div class="single-chat-item incoming">
                        <div class="user-avatar mt-1">
                            <span class="name-first-letter">
                                @php
                                    $pathchatprofile = Storage::url('uploads/karyawan/img/' . $d->foto_profile);
                                @endphp
                            </span>
                            <img class="my-2 user-avatar" src="{{ url($pathchatprofile) }}"
                                alt="{{ $d->nama_profile }}">
                        </div>
                        <div class="user-message">
                            <div class="message-content">
                                <div class="single-message">
                                    <p>{{ $d->pesan_profile }}</p>
                                </div>
                            </div>
                            <div class="message-time-status">
                                <div class="sent-time">{{ date('d-m-Y H:i:s', strtotime($d->tgl_pesan_profile)) }}</div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>
</div>
@extends('dashboard.dashlayouts.script')
@extends('dashboard.dashlayouts.header')
