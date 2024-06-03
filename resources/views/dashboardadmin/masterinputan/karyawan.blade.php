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
                                            <th rowspan="1" colspan="1" style="width: auto;"> Email</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Referensi</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Status</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Send</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($karyawan as $d)
                                            <tr class="odd">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->nip }}</td>
                                                <td>
                                                <td>
                                                    @if ($d->foto == null)
                                                        <img src="assets/img/nophoto.png" alt="avatar"
                                                            style="height:30px">
                                                    @else
                                                        @php
                                                            $path = Storage::url('uploads/karyawan/img/' . $d->foto);
                                                        @endphp
                                                        <img src="{{ $path }}" style="height:30px">
                                                    @endif
                                                </td>

                                                </td>
                                                <td>{{ $d->nama }}</td>
                                                <td>{{ $d->email }}</td>
                                                <td>{{ $d->referensi_detail ?? '-' }}</td>
                                                </td>
                                                <td>
                                                    <a href="/masterkaryawan/{{ $d->id }}/verifikasi"
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
                                                <td>
                                                    <a href="#"
                                                        class="btn {{ $d->email_verification_token != null ? 'btn-success' : 'btn-danger' }} btn-icon-split btn-sm">
                                                        <span class="icon text-white-50">
                                                            @if ($d->email_verification_token != null)
                                                                <i class="fas fa-check"></i>
                                                            @elseif ($d->email_verification_token == null)
                                                                <i class="fas fa-exclamation-triangle"></i>
                                                            @endif
                                                        </span>
                                                    </a>
                                                </td>
                                                <td><a href="#" class="btn btn-primary btn-icon-split btn-sm view"
                                                        id="{{ $d->id }}">
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

    {{-- Modal View --}}
    <div class="modal modal-blur fade" id="modal-viewKaryawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lihat Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditform">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            // Proses edit dengan AJAX
            $(".view").click(function() {
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: '/masterkaryawan/viewkaryawan',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(respond) {
                        $('#loadeditform').html(respond);
                        // Tampilkan modal setelah konten dimuat
                        $("#modal-viewKaryawan").modal("show");
                    }
                });
            });

        });
    </script>
@endpush
