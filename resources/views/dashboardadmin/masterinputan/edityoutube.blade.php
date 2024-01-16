<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <form action="/masteryoutube/{{ $datayoutube->id }}/updateyoutube" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-lg-6">
                        @php
                            $path = Storage::url('uploads/youtube/' . $datayoutube->gambar);
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
            @if ($datayoutube->gambar)
                <img src="{{ asset('storage/uploads/youtube/' . $datayoutube->gambar) }}" alt="Foto Youtube"
                    class="mt-2" style="max-width: 200px; max-height: 200px;" hidden>
            @endif
        </div>
        <input class="form-control" id="fotoeditlama" name="fotoeditlama" type="text"
            value="{{ $datayoutube->gambar }}" required hidden>

        <div class="form-group mb-3">
            <label class="form-label" for="linkedit">Link</label>
            <input class="form-control" id="linkedit" name="linkedit" type="text" value="{{ $datayoutube->link }}"
                required>
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
