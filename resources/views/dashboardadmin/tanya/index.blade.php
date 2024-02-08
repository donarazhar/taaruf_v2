@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 mb-4">Table Data Pertanyaan</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Pertanyaan</h6>
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
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                    role="grid" aria-describedby="dataTable_info" style="width: 100%; font-size:13px;">
                                    <thead>
                                        <tr role="row">
                                            <th rowspan="1" colspan="1" style="width: auto;"> No</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Email</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Pertanyaan</th>

                                            <th rowspan="1" colspan="1" style="width: auto;"> Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pertanyaan as $d)
                                            <tr class="odd">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->email }}</td>
                                                <td>{{ $d->pertanyaan }}</td>
                                                <td>{{ $d->tgl_tanya }}</td>

                                                <td>
                                                    <a href="#" class="btn btn-primary btn-icon-split btn-sm edit"
                                                        id="{{ $d->id }}">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-edit"></i>
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
