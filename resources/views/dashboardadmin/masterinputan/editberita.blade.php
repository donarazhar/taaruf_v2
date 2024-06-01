<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <form action="/masterberita/{{ $databerita->id }}/updateberita" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-lg-6">
                        @php
                            $path = Storage::url('uploads/berita/' . $databerita->foto);
                        @endphp
                        <img style="height:120px" src="{{ $path }}">
                    </div>
                    <div class="col-lg-6">
                        <img id="preview-image" style="height:120px" src="{{ asset('assets/img/preview.png') }}"
                            alt="Preview" />
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="fotoedit">Ubah Foto</label>
            <input class="form-control" id="fotoedit" name="fotoedit" type="file" accept="image/*"
                onchange="previewImage()">
            @if ($databerita->foto)
                <img src="{{ asset('storage/uploads/berita/' . $databerita->foto) }}" alt="Foto Berita" class="mt-2"
                    style="max-width: 200px; max-height: 200px;" hidden>
            @endif
        </div>
        <input class="form-control" id="fotoeditlama" name="fotoeditlama" type="text" value="{{ $databerita->foto }}"
            required hidden>

        <div class="form-group mb-3">
            <label class="form-label" for="juduledit">Judul</label>
            <input class="form-control" id="juduledit" name="juduledit" type="text" value="{{ $databerita->judul }}"
                required>
        </div>
        <div class="form-group mb-3">
            <label class="form-label" for="subjuduledit">Sub Judul</label>
            <input class="form-control" id="subjuduledit" name="subjuduledit" type="text"
                value="{{ $databerita->subjudul }}" required>
        </div>
        <div class="form-group mb-3">
            <label class="form-label" for="isiberitaedit">Isi Berita</label>
            <textarea class="form-control" id="isiberitaedit" name="isiberitaedit" type="text" cols="10" rows="5"
                value="{{ $databerita->isi }}" required>{{ $databerita->isi }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label class="form-label" for="linkedit">Link</label>
            <input class="form-control" id="linkedit" name="linkedit" type="text" value="{{ $databerita->link }}"
                readonly required>
        </div>
        <button class="btn btn-info w-100 mt-2" type="submit">Update</button>
    </form>
    <script>
        function previewImage() {
            const input = document.getElementById('fotoedit');
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
</body>

</html>
