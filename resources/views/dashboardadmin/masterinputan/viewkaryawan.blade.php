<!DOCTYPE html>
<html>

<head>

</head>

<body>
    @foreach ($datakaryawan as $karyawan)
        <div class="row">
            <div class="col-lg-3">
                <div class="card text-center p-2 ">
                    @if ($karyawan->foto == null)
                        <img src="assets/img/nophoto.png" alt="avatar" style="width:140px">
                    @else
                        @php
                            $path = Storage::url('uploads/karyawan/img/' . $karyawan->foto);
                        @endphp
                        <img src="{{ $path }}" style="width:140px">
                    @endif
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card text-left p-2">
                    <p> Email : {{ $karyawan->emailkaryawan }} <br>
                        Nama Pegawai : {{ $karyawan->nama }} <br>
                        Jenkel : {{ $karyawan->jenkel }} <br>
                        @if ($karyawan->referensi_detail === null)
                            Referensi : Ybs adalah Pegawai YPI Al Azhar
                        @else
                            Referensi : {{ $karyawan->referensi_detail }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-2">
                    <p><b>Biodata Lengkap</b> <br>
                        TTL : {{ $karyawan->tempatlahir }}, {{ date('d-M-Y', strtotime($karyawan->tgllahir)) }} <br>
                        Pendidikan : {{ $karyawan->pendidikan }} <br>
                        Suku : {{ $karyawan->suku }} <br>
                        Status Nikah : {{ $karyawan->statusnikah }} <br>
                        Motto Hidup : {{ $karyawan->motto }} <br>
                        Hobi : {{ $karyawan->hobi }}
                    </p>
                </div> <br>
                <div class="card p-2">
                    <p><b>Kriteria Pasangan</b> <br>
                        Kriteria Pasangan : {{ $karyawan->kriteriaumum }} <br>
                        Suku Yang Diinginkan : {{ $karyawan->suku }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</body>

</html>
