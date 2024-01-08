@extends('dashboardadmin.layoutsadmin.sidebar')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 mb-4">Table Data Berita</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Berita</h6>
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
                                            <th rowspan="1" colspan="1" style="width: auto;"> Foto</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Judul</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Sub Judul</th>
                                            <th rowspan="1" colspan="1" style="width: auto;">Isi</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Link</th>
                                            <th rowspan="1" colspan="1" style="width: auto;"> Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($databerita as $d)
                                            <tr class="odd">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @php
                                                        $path = Storage::url('uploads/berita/' . $d->foto);
                                                    @endphp
                                                    <img style="height:60px" src="{{ $path }}">
                                                </td>
                                                <td>{{ $d->judul }}</td>
                                                <td>{{ $d->subjudul }}</td>
                                                <td>{{ Illuminate\Support\Str::limit($d->isi, $limit = 30, $end = '...') }}
                                                </td>
                                                <td>{{ $d->link }} </td>
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

    {{-- Modal Edit --}}
    <div class="modal modal-blur fade" id="modal-editBerita" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Berita</h5>
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
            $(".edit").click(function() {
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: '/masterberita/editberita',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(respond) {
                        $('#loadeditform').html(respond);

                        // Inisialisasi TinyMCE setelah konten modal dimuat
                        tinymce.init({
                            selector: '#isiberitaedit',
                            height: 300,
                            plugins: [
                                'advlist autolink lists link image charmap print preview anchor',
                                'searchreplace visualblocks code fullscreen',
                                'insertdatetime media table paste code help wordcount'
                            ],
                            toolbar: 'undo redo | formatselect | ' +
                                'bold italic backcolor | alignleft aligncenter ' +
                                'alignright alignjustify | bullist numlist outdent indent | ' +
                                'removeformat | help',
                            content_style: 'body { font-family: "Helvetica", sans-serif; font-size: 14px }'
                        });

                        // Tampilkan modal setelah konten dimuat
                        $("#modal-editBerita").modal("show");
                    }
                });
            });

        });
    </script>
@endpush
