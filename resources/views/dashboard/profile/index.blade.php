@extends('dashboard.dashlayouts.style')
<div class="page-content-wrapper py-3">
    <div class="container">
        <!-- User Information-->
        <div class="card user-info-card mb-3">
            <div class="card-body d-flex align-items-center">
                {{-- Foto profile --}}
                <div class="user-profile">
                    @php
                        $user = Auth::guard('karyawan')->user();
                        $path = !empty($user->foto) ? Storage::url('uploads/karyawan/img/' . $user->foto) : '';
                        $defaultAvatar = $user->jenkel === 'pria' ? 'avatar.jpg' : 'avatarwanita.jpg';
                    @endphp
                    <img src="{{ !empty($path) ? url($path) : asset('assets/img/' . $defaultAvatar) }}" alt="avatar"
                        class="imaged w64 {{ $user->jenkel === 'pria' ? '' : 'img-fluid' }}" style="height:60px">
                </div>
                {{-- Akhir Foto profile --}}
                <div class="user-info">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-1">{{ $dataprofile->nama }}</h5><span
                            class="badge bg-info ms-2 rounded-pill">{{ $dataprofile->nip }}</span>
                    </div>
                    <p class="mb-0">{{ $dataprofile->email }}</p>
                </div>
            </div>
        </div>
        <div class="section">
            <a class="btn btn-primary w-100 mb-3">Silahkan Lengkapi Data Anda.</a>
        </div>
        <!-- User Meta Data-->
        <div class="section">
            {{-- Pesan error --}}
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::get('warning'))
                <div class="alert alert-warning">
                    {{ Session::get('warning') }}
                </div>
            @endif
        </div>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button bg-gradient-info text-dark" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <b> Biodata Dasar</b>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card user-data-card">
                            <div class="card-body">
                                <form action="/profile/{{ $dataprofile->email }}/updateprofile" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="nip">Nomor Induk Pegawai</label>
                                        <input class="form-control" id="nip" type="text"
                                            value="{{ $dataprofile->nip }}" placeholder="nip" readonly>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="nama">Nama Lengkap</label>
                                        <input class="form-control" name="nama" id="nama" type="text"
                                            value="{{ $dataprofile->nama }}" placeholder="Full Name" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control" id="email" type="text"
                                            value="{{ $dataprofile->email }}" placeholder="Email Address" readonly>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input class="form-control" name="password" id="password" type="text">
                                    </div>
                                    <style>
                                        #preview-container {
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            margin-top: 10px;
                                        }

                                        #preview-image {
                                            max-width: 40%;
                                            height: auto;
                                        }

                                        #preview-video {
                                            max-width: 100%;
                                            height: auto;
                                        }
                                    </style>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="foto">Ubah Foto</label>
                                        <input class="form-control" id="foto" name="foto" type="file"
                                            onchange="previewImage()">
                                    </div>
                                    <div id="preview-container"
                                        style="display: flex; justify-content: center; align-items: center; margin-top: 10px;">
                                        <img id="preview-image" style="width: 100%;"
                                            src="{{ asset('assets/img/preview.png') }}" alt="Preview" />
                                    </div>
                                    <script>
                                        function previewImage() {
                                            const input = document.getElementById('foto');
                                            const previewContainer = document.getElementById('preview-container');
                                            const previewImage = document.getElementById('preview-image');

                                            const file = input.files[0];

                                            if (file) {
                                                const reader = new FileReader();

                                                reader.onload = function(e) {
                                                    previewImage.src = e.target.result;
                                                    previewContainer.style.display = 'flex';
                                                };

                                                reader.readAsDataURL(file);
                                            } else {
                                                previewImage.src = '{{ asset('assets/img/preview.png') }}';
                                                previewContainer.style.display = 'flex';
                                            }
                                        }
                                    </script>
                                    <button class="btn btn-info w-100 mt-2" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button bg-gradient-info text-dark collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                        aria-controls="collapseTwo">
                        <b> Biodata Lengkap</b>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card user-data-card">
                            <div class="card-body">
                                <form action="/profile/{{ $dataprofile->email }}/updateprofile2" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="nohp">No. Handphone</label>
                                        <input class="form-control" name="nohp" id="nohp" type="text"
                                            value="{{ $dataprofilelengkap->nohp }}" maxlength="20" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="tempatlahir">Tempat Lahir</label>
                                        <input class="form-control" name="tempatlahir" id="tempatlahir"
                                            type="text" value="{{ $dataprofilelengkap->tempatlahir }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="tgllahir">Tanggal Lahir</label>
                                        <input class="form-control" name="tgllahir" id="tgllahir" type="date"
                                            value="{{ $dataprofilelengkap->tgllahir }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <label class="form-label" for="tinggi">Tinggi (cm) </label>
                                                <input class="form-control" name="tinggi" id="tinggi"
                                                    placeholder="Angkanya saja" type="text"
                                                    value="{{ $dataprofilelengkap->tinggi }}" required>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label class="form-label" for="berat">Berat (kg)</label>
                                                <input class="form-control" name="berat" id="berat"
                                                    placeholder="Angkanya saja" type="text"
                                                    value="{{ $dataprofilelengkap->berat }}" required>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group mb-3">
                                        <select class="form-select form-control" name="goldar" id="goldar"
                                            required>
                                            <option value="{{ $dataprofilelengkap->goldar }}">
                                                {{ $dataprofilelengkap->goldar ? $dataprofilelengkap->goldar . '' : '-Golongan Darah-' }}
                                            </option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                            <option value="O">O</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <select class="form-select form-control" name="statusnikah" id="statusnikah"
                                            required>
                                            <option value="{{ $dataprofilelengkap->statusnikah }}">
                                                {{ $dataprofilelengkap->statusnikah ? $dataprofilelengkap->statusnikah . '' : '-Status Nikah-' }}
                                            </option>
                                            @if ($dataprofile->jenkel == 'pria')
                                                <option value="Lajang">Lajang</option>
                                                <option value="Duda">Duda</option>
                                            @elseif ($dataprofile->jenkel == 'wanita')
                                                <option value="Lajang">Lajang</option>
                                                <option value="Janda">Janda</option>
                                            @endif

                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="pekerjaan">Pekerjaan</label>
                                        <input class="form-control" name="pekerjaan" id="pekerjaan" type="text"
                                            value="{{ $dataprofilelengkap->pekerjaan }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="suku">Suku</label>
                                        <input class="form-control" name="suku" id="suku" type="text"
                                            value="{{ $dataprofilelengkap->suku }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <select class="form-select form-control" name="pendidikan" id="pendidikan"
                                            required>
                                            <option value="{{ $dataprofilelengkap->pendidikan }}">
                                                {{ $dataprofilelengkap->pendidikan ? $dataprofilelengkap->pendidikan . '' : '-Pendidikan Terakhir-' }}
                                            </option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="D1">Diploma</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="hobi">Hobi</label>
                                        <input class="form-control" name="hobi" id="hobi" type="text"
                                            value="{{ $dataprofilelengkap->hobi }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="motto">Motto</label>
                                        <input class="form-control" name="motto" id="motto" type="text"
                                            value="{{ $dataprofilelengkap->motto }}" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="alamat">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="alamat" placeholder="Masukkan alamat lengkap" required>{{ $dataprofilelengkap->alamat }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="video">Pilih Video</label>
                                        <input class="form-control" id="video" name="video" type="file"
                                            accept="video/*" onchange="previewVideo()">
                                    </div>
                                    <div id="preview-container">
                                        <video id="preview-video" controls>
                                            <source id="video-source" src="#" type="video/mp4">
                                        </video>
                                    </div>
                                    <script>
                                        function previewVideo() {
                                            const input = document.getElementById('video');
                                            const previewContainer = document.getElementById('preview-container');
                                            const previewVideo = document.getElementById('preview-video');
                                            const videoSource = document.getElementById('video-source');

                                            const file = input.files[0];

                                            if (file) {
                                                const reader = new FileReader();

                                                reader.onload = function(e) {
                                                    videoSource.src = e.target.result;
                                                    previewContainer.style.display = 'flex';

                                                    // Tambahkan kontrol untuk memulai pemutaran video
                                                    previewVideo.load();
                                                    previewVideo.play();
                                                };

                                                reader.readAsDataURL(file);
                                            } else {
                                                // Jika tidak ada file dipilih, sembunyikan preview
                                                previewContainer.style.display = 'none';
                                            }
                                        }
                                    </script>
                                    <button class="btn btn-info w-100 mt-2" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button bg-gradient-info text-dark collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                        aria-controls="collapseThree">
                        <b> Kriteria Pasangan Yang Diharapkan</b>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card user-data-card">
                            <div class="card-body">
                                <form action="/profile/{{ $dataprofile->email }}/updateprofile3" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <style>
                                        .form-group {
                                            position: relative;
                                            margin-top: 10px;
                                        }

                                        .range-labels {
                                            display: flex;
                                            justify-content: space-between;
                                            margin-top: 30px;
                                            font-weight: bold;
                                            position: absolute;
                                            width: 100%;
                                            top: -10px;
                                            pointer-events: none;
                                        }

                                        .range-label {
                                            position: relative;
                                            width: calc(30% - 30px);
                                            text-align: center;
                                        }

                                        .form-range {
                                            width: 100%;
                                        }

                                        .form-control {
                                            width: 100%;
                                            margin-top: 10px;
                                        }
                                    </style>

                                    <div class="form-group">
                                        <label for="customRange2" class="form-label mb-4">Rentang Umur</label>
                                        <div class="range-labels">
                                            <div class="range-label" id="umurAwalLabel">17</div>
                                            <div class="range-label" id="umurAkhirLabel">60</div>
                                        </div>
                                        <input type="range" class="form-range" min="17" max="60"
                                            id="customRange2">
                                        <input type="text" class="form-control" id="umurRange" name="umurRange"
                                            value="{{ $dataprofilelengkap->kriteriaumur }}" hidden>
                                    </div>
                                    <div class="form-group">
                                        <label for="customRange3" class="form-label mb-4">Rentang Tinggi (cm)</label>
                                        <div class="range-labels">
                                            <div class="range-label" id="tinggiAwalLabel">100</div>
                                            <div class="range-label" id="tinggiAkhirLabel">200</div>
                                        </div>
                                        <input type="range" class="form-range" min="100" max="200"
                                            id="customRange3">
                                        <input type="text" class="form-control" id="tinggiRange"
                                            value="{{ $dataprofilelengkap->kriteriatinggi }}" name="tinggiRange"
                                            hidden>
                                    </div>
                                    <div class="form-group">
                                        <label for="customRange4" class="form-label mb-4">Rentang Berat (kg)</label>
                                        <div class="range-labels">
                                            <div class="range-label" id="beratAwalLabel">25</div>
                                            <div class="range-label" id="beratAkhirLabel">100</div>
                                        </div>
                                        <input type="range" class="form-range" min="25" max="100"
                                            id="customRange4">
                                        <input type="text" class="form-control" id="beratRange" name="beratRange"
                                            hidden value="{{ $dataprofilelengkap->kriteriaberat }}">
                                    </div>
                                    <script>
                                        const customRange2 = document.getElementById('customRange2');
                                        const customRange3 = document.getElementById('customRange3');
                                        const customRange4 = document.getElementById('customRange4');

                                        const umurRangeInput = document.getElementById('umurRange');
                                        const umurAwalLabel = document.getElementById('umurAwalLabel');
                                        const umurAkhirLabel = document.getElementById('umurAkhirLabel');

                                        const tinggiRangeInput = document.getElementById('tinggiRange');
                                        const tinggiAwalLabel = document.getElementById('tinggiAwalLabel');
                                        const tinggiAkhirLabel = document.getElementById('tinggiAkhirLabel');

                                        const beratRangeInput = document.getElementById('beratRange');
                                        const beratAwalLabel = document.getElementById('beratAwalLabel');
                                        const beratAkhirLabel = document.getElementById('beratAkhirLabel');

                                        customRange2.addEventListener('input', updateUmurRange);
                                        customRange3.addEventListener('input', updateTinggiRange);
                                        customRange4.addEventListener('input', updateBeratRange);

                                        function updateUmurRange() {
                                            const umurAwal = customRange2.min;
                                            const umurAkhir = customRange2.value;

                                            umurRangeInput.value = `${umurAwal} - ${umurAkhir}`;
                                            umurAwalLabel.textContent = umurAwal;
                                            umurAkhirLabel.textContent = umurAkhir;
                                        }

                                        function updateTinggiRange() {
                                            const tinggiAwal = customRange3.min;
                                            const tinggiAkhir = customRange3.value;

                                            tinggiRangeInput.value = `${tinggiAwal} - ${tinggiAkhir}`;
                                            tinggiAwalLabel.textContent = tinggiAwal;
                                            tinggiAkhirLabel.textContent = tinggiAkhir;
                                        }

                                        function updateBeratRange() {
                                            const beratAwal = customRange4.min;
                                            const beratAkhir = customRange4.value;

                                            beratRangeInput.value = `${beratAwal} - ${beratAkhir}`;
                                            beratAwalLabel.textContent = beratAwal;
                                            beratAkhirLabel.textContent = beratAkhir;
                                        }
                                    </script>
                                    <div class="form-group mb-3">
                                        <label class="form-label mb-3" for="kriteriasuku">Suku Pasangan</label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="betawi"
                                                        name="betawi" value="Betawi">
                                                    <label class="form-label">Betawi</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="jawa"
                                                        name="jawa" value="Jawa">
                                                    <label class="form-label">Jawa</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="sunda"
                                                        name="sunda" value="Sunda">
                                                    <label class="form-label">Sunda</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="bugis"
                                                        name="bugis" value="Bugis">
                                                    <label class="form-label">Bugis</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="batak"
                                                        name="batak" value="Batak">
                                                    <label class="form-label">Batak</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="madura"
                                                        name="madura" value="Madura">
                                                    <label class="form-label">Madura</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="dayak"
                                                        name="dayak" value="Dayak">
                                                    <label class="form-label">Dayak</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="aceh"
                                                        name="aceh" value="Aceh">
                                                    <label class="form-label">Aceh</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="melayu"
                                                        name="melayu" value="Melayu">
                                                    <label class="form-label">Melayu</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="lampung"
                                                        name="lampung" value="Lampung">
                                                    <label class="form-label">Lampung</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="bali"
                                                        name="bali" value="Bali">
                                                    <label class="form-label">Bali</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="ambon"
                                                        name="ambon" value="Ambon">
                                                    <label class="form-label">Ambon</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="bima"
                                                        name="bima" value="Bima">
                                                    <label class="form-label">Bima</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="makassar"
                                                        name="makassar" value="Makassar">
                                                    <label class="form-label">Makassar</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="minangkabau"
                                                        name="minangkabau" value="Minangkabau">
                                                    <label class="form-label">Minangkabau</label>
                                                </div>
                                                <div class="form-group ">
                                                    <textarea class="form-control" id="sukupilihan" name="sukupilihan" type="text" hidden>{{ $dataprofilelengkap->kriteriasuku }}</textarea>
                                                </div>
                                            </div>
                                            <script>
                                                const checkboxes = document.querySelectorAll('.form-check-input');
                                                const sukupilihanInput = document.getElementById('sukupilihan');

                                                checkboxes.forEach(checkbox => {
                                                    checkbox.addEventListener('change', updatesukupilihan);
                                                });

                                                function updatesukupilihan() {
                                                    const sukupilihan = Array.from(checkboxes)
                                                        .filter(checkbox => checkbox.checked)
                                                        .map(checkbox => checkbox.value)
                                                        .join(', ');

                                                    sukupilihanInput.value = sukupilihan;
                                                }
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="kriteriaumum">Kriteria Umum</label>
                                        <textarea class="form-control" name="kriteriaumum" id="kriteriaumum" type="text"> {{ $dataprofilelengkap->kriteriaumum }}</textarea>
                                    </div>

                                    <button class="btn btn-info w-100 mt-2" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('myscript')
    <script>
        $(function() {
            // Script mask inputan kode tidak boleh lebih dari 10 angka
            $('#nohp').mask('0000-0000-000000');
            $('#tinggi').mask('000');
            $('#berat').mask('000');
        });
    </script>
@endpush
