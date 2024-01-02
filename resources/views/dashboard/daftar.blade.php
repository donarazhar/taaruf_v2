@extends('dashboard.layouts.bootstrap')
@section('content')
    <!--  CSS Pop up untuk memasukkan NIP -->
    <style>
        @media only screen and (max-width: 768px) {
            .popup-window {
                width: 100%;
                height: 100vh;
            }

            .popup-content {
                width: 100%;
                max-width: 700px;
                max-height: 90%;
                height: auto;
            }
        }

        .popup-window {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.75);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            width: 100%;
            height: 100vh;
        }

        .popup-content {
            background-color: rgb(255, 255, 255);
            padding: 0.5%;
            text-align: center;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            max-height: 90%;
            height: auto;
            overflow: hidden;
            margin: 0 auto;
            position: relative;
            top: 50%;
            transform: translateY(-50%);

        }

        .btn-primary {
            background: rgba(2, 127, 194);
        }

        .card-header {
            background: rgba(2, 127, 194);
        }
    </style>

    <div class="popup-window">
        <div class="popup-content">
            <div class="card">
                <div class="card-header">
                    <a class="card-title text-light">Verifikasi Nomor Induk Pegawai</a>
                </div>
                <div class="card-body">
                    <form id="id-check-form">
                        <div class="mb-4">
                            <input type="text" class="form-control" id="id-input" name="id-input"
                                placeholder="Masukkan NIP anda">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-sm w-30 btn-primary" id="nip">Cek NIP</button>
                            <button type="button" class="btn btn-sm w-30 btn-danger" id="nip"
                                onclick="cancelAndGoBack()">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section id="hero">
        <div class="container">
        </div>
    </section>
    <main id="main">
        <section id="contact" class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-6">
                        <div class="col-lg-12 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
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
                            <div class="card">
                                <div class="card-header text-light">
                                    <b>Formulir Pendaftaran</b>
                                </div>
                                <div class="card-body">
                                    <form action="/prosesdaftar" method="POST" id="frmdaftar">
                                        @csrf
                                        <div class="form-group php-email-form" role="form">
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <input type="text" name="nip" maxlength="12" class="form-control"
                                                        id="nip" placeholder="Masukkan NIP" pattern="\d*"
                                                        title="Hanya angka yang diperbolehkan"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 12)"
                                                        required>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <input type="text" name="nama" class="form-control" id="nama"
                                                        placeholder="Masukkan Nama" oninput="validateInput(this)" required>
                                                </div>
                                                <div class="col-md-12 form-group mt-3 mt-md-0">
                                                    <select class="form-select"
                                                        style="font-size:0.9rem; font:'Poppin', sans-serif;" name="jenkel"
                                                        id="jenkel" required>
                                                        <option value="">- Jenis Kelamin -</option>
                                                        <option value="pria">1. Pria</option>
                                                        <option value="wanita">2. Wanita</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 form-group mt-3 mt-md-0">
                                                    <select class="form-select"
                                                        style="font-size:0.9rem; font:'Poppin', sans-serif;"
                                                        name="referensi" id="referensi" required
                                                        onchange="toggleReferensiInput()">
                                                        <option value="">- Referensi -</option>
                                                        <option value="1">1. Saya Adalah Pegawai YPI Al Azhar</option>
                                                        <option value="2">2. Referensi Dari Pegawai YPI Al Azhar
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-md-12 form-group mt-3 mt-md-0" id="referensiInputContainer"
                                                    style="display: none;">
                                                    <input type="text" name="referensiDetail" class="form-control"
                                                        id="referensiDetail" oninput="validateInput(this)"
                                                        placeholder="Masukkan nama pegawai yang mereferensi">
                                                </div>
                                                <script>
                                                    function toggleReferensiInput() {
                                                        var referensiInputContainer = document.getElementById('referensiInputContainer');
                                                        var referensiDetailInput = document.getElementById('referensiDetail');
                                                        var referensiDropdown = document.getElementById('referensi');

                                                        if (referensiDropdown.value === '2') {
                                                            referensiInputContainer.style.display = 'block';
                                                            referensiDetailInput.setAttribute('required', 'required');
                                                        } else {
                                                            referensiInputContainer.style.display = 'none';
                                                            referensiDetailInput.removeAttribute('required');
                                                        }
                                                    }
                                                </script>
                                                <script>
                                                    function validateInput(input) {
                                                        input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
                                                    }
                                                </script>

                                                <div class="col-md-12 form-group mt-3 mt-md-0">
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        placeholder="Masukkan Email" required>
                                                </div>
                                                <div class="col-md-12 form-group mt-3 mt-md-0">
                                                    <input type="password" class="form-control" name="password"
                                                        id="password" placeholder="Masukkan Password" required>
                                                </div>

                                            </div>
                                            <div class="text-center mt-2">
                                                <button class="btn btn-sm w-100" type="submit">Kirim
                                                </button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
                </div>

            </div>
        </section>
    </main>
@endsection

<!-- Pop UP mengecek NIP yang terdaftar -->
<script>
    function cancelAndGoBack() {
        window.location.href = '/';
    }
    document.addEventListener("DOMContentLoaded", () => {
        const popupWindow = document.querySelector(".popup-window");
        const idCheckForm = document.getElementById("id-check-form");

        const validNip = localStorage.getItem("validNip"); // Mengecek status NIP valid
        if (validNip !== "true") {
            popupWindow.style.display = "block";
        } else {
            popupWindow.style.display = "none";
        }

        function closePopup() {
            popupWindow.style.display = "none";
        }

        idCheckForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const idInput = document.getElementById("id-input").value;

            // Mengirim permintaan ke API
            fetch(`https://apialazhar.eu.org/ypia?nip=${idInput}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        // Menyimpan status NIP valid
                        localStorage.setItem("validNip", "true");
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Selamat NIP anda terdaftar.",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        closePopup();
                        // Akses halaman daftar atau lakukan aksi lain yang diinginkan
                    } else {
                        alert("Maaf NIP anda tidak terdaftar silahkan hubungi ADMIN !");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan saat memeriksa NIP. Silahkan coba lagi.");
                });
        });
    });
</script>
