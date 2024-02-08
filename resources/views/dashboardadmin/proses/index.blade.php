@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 mb-4">Table Data Progress</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Progress</h6>
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
                                            <th rowspan="1" colspan="2" style="width: auto;"> Pasangan</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Tanggal Progress</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allDataProgress as $data)
                                            <tr class="odd">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @php
                                                        $path = Storage::url('uploads/karyawan/img/' . $data->foto_auth);
                                                    @endphp
                                                    <img src="{{ $path }}" style="height:30px"><span
                                                        class="badge
                                                        @if ($data->authStatus === 1) badge-success
                                                        @elseif($data->authStatus === 0)
                                                            badge-danger
                                                        @else
                                                            badge-dark @endif
                                                        badge-counter">
                                                        @if ($data->authStatus === 1)
                                                            Merasa Cocok
                                                        @elseif($data->authStatus === 0)
                                                            Tidak Cocok
                                                        @else
                                                            Belum Menentukan
                                                        @endif
                                                    </span> |
                                                    {{ $data->nama_auth }}
                                                </td>
                                                <td>
                                                    @php
                                                        $path = Storage::url('uploads/karyawan/img/' . $data->foto_profile);

                                                    @endphp
                                                    <img src="{{ $path }}" style="height:30px"> <span
                                                        class="badge
                                                        @if ($data->profileStatus === 1) badge-success
                                                        @elseif($data->profileStatus === 0)
                                                            badge-danger
                                                        @else
                                                            badge-dark @endif
                                                        badge-counter">
                                                        @if ($data->profileStatus === 1)
                                                            Merasa Cocok
                                                        @elseif($data->profileStatus === 0)
                                                            Tidak Cocok
                                                        @else
                                                            Belum Menentukan
                                                        @endif
                                                    </span> |
                                                    {{ $data->nama_profile }}
                                                </td>
                                                <td>{{ date('d-m-Y'), strtotime($data->progress_tgl) }}</td>
                                                <td>
                                                    @if ($data->profileStatus == 1 && $data->authStatus == 1)
                                                        <a href="{{ route('prosescetak', ['id' => $data->id]) }}"
<<<<<<< HEAD
                                                            target="_blank" class="btn btn-success btn-sm">Proses</a>
=======
                                                            class="btn btn-success btn-sm">Proses</a>
>>>>>>> d2b598cf6d3e85ae8975ec357624a4515d74b268
                                                    @endif
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
