@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 mb-4">Table Data Pengguna</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Pengguna</h6>
            </div>
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
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable text-center" id="dataTable" width="100%"
                                    cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                    style="width: 100%; font-size:13px;">
                                    <thead>
                                        <tr role="row">
                                            <th rowspan="1" colspan="1" style="width: auto;"> No</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> NIP</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Foto</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Nama</th>
                                            <th rowspan="1" colspan="1" style="width: auto;">Email</th>
                                            {{-- <th rowspan="1" colspan="1" style="width: auto;"> TB</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> BB</th> --}}
                                            <th rowspan="1" colspan="1" style="width: auto;"> Referensi</th>
                                            {{-- <th rowspan="1" colspan="1" style="width: auto;"> TTL</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Kriteria Pasangan</th> --}}
                                            <th rowspan="1" colspan="1" style="width: auto;"> Status</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($karyawan as $d)
                                            <tr class="odd">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->nip }}</td>
                                                <td>
                                                    @php
                                                        $path = Storage::url('uploads/karyawan/img/' . $d->foto);

                                                    @endphp
                                                    <img src="{{ $path }}" style="height:30px">
                                                </td>
                                                <td>{{ $d->nama }}</td>
                                                <td>{{ $d->email }}</td>
                                                {{-- <td>{{ $d->pendidikan ?? '-' }}</td> --}}
                                                {{-- <td>{{ $d->tinggi ?? '-' }} cm</td>
                                                <td>{{ $d->berat ?? '-' }} kg</td> --}}
                                                <td>{{ $d->referensi_detail ?? '-' }}</td>
                                                {{-- <td>{{ $d->tempatlahir ?? '-' }},
                                                    {{ $d->tgllahir ? date('d/m/Y', strtotime($d->tgllahir)) : '-' }}

                                                <td>{{ $d->kriteriaumum ?? '-' }}</td> --}}
                                                </td>
                                                <td>
                                                    <a href="/masterkaryawan/{{ $d->id_karyawan }}/verifikasi"
                                                        class="btn {{ $d->status == 1 ? 'btn-success' : 'btn-warning' }} btn-icon-split btn-sm">
                                                        <span class="icon text-white-50">
                                                            @if ($d->status == 1)
                                                                <i class="fas fa-check"></i>
                                                            @elseif ($d->status === null)
                                                                <i class="fas fa-exclamation-triangle"></i>
                                                            @endif
                                                        </span>
                                                    </a>


                                                </td>
                                                <td><a href="#" class="btn btn-primary btn-icon-split btn-sm">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-search"></i>
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
