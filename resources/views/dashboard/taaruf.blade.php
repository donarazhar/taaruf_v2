@extends('dashboard.dashlayouts.style')
<div class="page-content-wrapper py-3">
    <div class="blog-wrapper direction-rtl">
        <div class="container">
            <div class="row g-3">

                {{-- Menampilkan data karyawan yang berlawanan jenis kelamin --}}
                @php
                    $authUser = Auth::guard('karyawan')->user();
                    $oppositeGender = $authUser->jenkel == 'pria' ? 'wanita' : 'pria';

                    $users = DB::table('karyawan')
                        ->where('jenkel', $oppositeGender)
                        ->get();
                @endphp

                @foreach ($users as $user)
                    <!-- Single Blog Card-->
                    <div class="col-6 col-sm-4 col-md-3">
                        <div class="card position-relative shadow-sm">
                            @php
                                $path = !empty($user->foto) ? Storage::url('uploads/karyawan/' . $user->foto) : '';
                                $defaultAvatar = $user->jenkel === 'pria' ? 'avatar.jpg' : 'avatarwanita.jpg';
                            @endphp
                            <img class="card-img-top {{ $user->jenkel === 'pria' ? '' : 'img-fluid' }}"
                                src="{{ !empty($path) ? url($path) : asset('assets/img/' . $defaultAvatar) }}"
                                alt="">
                            <span
                                class="badge bg-warning text-dark position-absolute card-badge">{{ $user->nama }}</span>
                            <div class="card-body">
                                <span class="badge bg-dark mb-2 d-inline-block">{{ $user->nip }}</span>
                                <small class="d-block mb-2 text-dark" style="font-size: 8px;">Referensi:
                                    <b>
                                        @if ($user->referensi == 2 && !is_null($user->referensi_detail))
                                            {{ $user->referensi_detail }}
                                        @elseif ($user->referensi == 1)
                                            {{ $user->referensi_detail ?? 'Pegawai Al Azhar' }}
                                        @endif
                                    </b>
                                </small>
                                <a class="btn btn-primary btn-sm" href="page-blog-details.html">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- Menampilkan data karyawan yang berlawanan jenis kelamin --}}

            </div>
        </div>
    </div>
</div>
