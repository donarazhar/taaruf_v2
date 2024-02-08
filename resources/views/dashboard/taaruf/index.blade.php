@extends('dashboard.dashlayouts.style')
<div class="page-content-wrapper py-3">
    <div class="blog-wrapper direction-rtl">
        <div class="container">
            <div class="row g-3">

                {{-- Menampilkan data karyawan yang berlawanan jenis kelamin --}}
                @php
                    $authUser = Auth::guard('karyawan')->user();
                    $oppositeGender = $authUser->jenkel == 'pria' ? 'wanita' : 'pria';

<<<<<<< HEAD
                    $users = DB::table('karyawan')->where('jenkel', $oppositeGender)->get();
=======
                    $users = DB::table('karyawan')
                        ->where('jenkel', $oppositeGender)
                        ->get();
>>>>>>> d2b598cf6d3e85ae8975ec357624a4515d74b268
                @endphp
                @foreach ($users as $user)
                    <!-- Single Blog Card-->
                    <div class="col-4 col-sm-4 col-md-3">
                        <div class="card position-relative shadow-sm">
                            @php
                                $path = !empty($user->foto) ? Storage::url('uploads/karyawan/img/' . $user->foto) : '';
                                $defaultAvatar = $user->jenkel === 'pria' ? 'avatar.jpg' : 'avatarwanita.jpg';
                            @endphp
                            <img class="card-img-top {{ $user->jenkel === 'pria' ? '' : 'img-fluid' }}"
                                src="{{ !empty($path) ? url($path) : asset('assets/img/' . $defaultAvatar) }}"
                                alt="">
                            <span class="badge bg-warning text-dark position-absolute card-badge"
                                style="top: 0.1rem; left:0.1rem;">{{ $user->nama }}</span>
                            <div class="card-body">
                                <span class="badge bg-dark mb-2 d-inline-block">{{ $user->nip }}</span>
                                <small class="d-block mb-2 text-dark" style="font-size: 8px;">Referensi:
                                    <b>
                                        @if ($user->referensi == 2 && !is_null($user->referensi_detail))
                                            {{ $user->referensi_detail }}
                                        @elseif ($user->referensi == 1)
                                            {{ $user->referensi_detail ?? '-' }}
                                        @endif
                                    </b>
                                </small>
                                <a class="btn btn-primary btn-sm" href="/taaruf/{{ $user->email }}/lihatprofile">Lihat
                                </a>
<<<<<<< HEAD
                                <a class="btn btn-danger btn-sm" href="/taaruf/{{ $user->email }}/lihatprofile"><i
                                        class="bi bi-heart-fill"></i>
                                </a>
=======
>>>>>>> d2b598cf6d3e85ae8975ec357624a4515d74b268
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@push('myscript')
@endpush
