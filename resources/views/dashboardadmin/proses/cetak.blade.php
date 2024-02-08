<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Proses Ta'aruf</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        #alamat {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            color: hsl(125, 100%, 36%);
        }

        #title {
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            font-weight: bold;
            color: hsl(125, 100%, 36%);
        }

        h2#subjudul {
            font-family: 'Times New Roman', Times, serif;
            font-size: 30px;
            font-weight: bold;
            color: hsl(125, 100%, 36%);

        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            /* border: 1px solid black; */
            padding: 8px;
            text-align: left;
        }

        td img {
            display: block;
            /* Menghilangkan whitespace di sekitar gambar */
        }

        td#title {
            text-align: center;
            line-height: 10%;
        }

        hr {
            margin: 2px 0;
            border: none;
            height: 0.5px;
            background-color: hsl(125, 100%, 36%);
            border: 1px solid hsl(125, 100%, 36%);
        }

        hr#tebal {
            margin: 5px 0;
            border: none;
            height: 2px;
            background-color: hsl(125, 100%, 36%);
            border: 1.2px solid hsl(125, 100%, 36%);
        }

        p {
            font-family: 'Times New Roman', Times, serif;
            margin: 2px 0;
            line-height: 130%;
            font-size: 14px;
            color: hsl(0, 0%, 0%);
        }

        p#jumlah {
            font-family: 'Times New Roman', Times, serif;
            font-size: 18px;
            color: hsl(0, 0%, 0%);
        }
    </style>
</head>

<body class="A4 potrait">
    <section class="sheet padding-10mm">
        <table>
            <tr>
                <td style="width: 10px; text-align:center;">
                    <img src="{{ asset('assets/img/logo.png') }}" width="130%">
                </td>
                <td id="title" style="width: 60px;">
                    <span id="title">
                        Yayasan Pesantren Islam Al Azhar<br>
                        <h2 id="subjudul">Direktorat Dakwah dan Sosial</h2>
                    </span><br>
                    <span>
                        <small id="alamat">Jl. Sisingamangaraja Kebayoran Baru Jakarta Selatan 12110 Telp.
                            021-72783683</small>
                    </span>
                    <br> <br> <br> <br> <br><br><br><br><span><small id="alamat">Website :
                            www.masjidagungalazhar.com | Email : masjidagungalazhar@gmail.com</small></span>
                </td>
            </tr>
        </table>
        <hr>
        <hr id="tebal">
        <br>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 10%; text-align:left;">

                </td>
                <td style="width: 65%; text-align:left;">

                </td>

                <td style="width: 25%; text-align:right">
                    <p><b>Jakarta, {{ \Carbon\Carbon::parse(now())->isoFormat('DD/MM/YYYY') }}
                    </p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:left;">
                    <p><i>Assalamualaikum Warrahmatullahi Wabarakatuh,</p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:justify;">
                    <p>Salam ta'zim kami sampaikan semoga Allah SWT senantiasa melimpahkan rahmat, taufiq dan
                        hidayahNya serta memberikan kesehatan kepada kita semua sehingga dapat menjalankan tugas
                        dan aktifitas sehari-hari.
                    </p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:justify;">
                    @foreach ($allDataProgress as $data)
                        <p>Direktorat YPI Al Azhar memberikan rekomendasi atas pasangan
                            <b>{{ $data->nama_auth }}</b>
                            dan <b>{{ $data->nama_profile }}</b> yang
                            telah ditetapkan dalam aplikasi taaruf. Kami berharap pasangan ini memiliki tujuan
                            yang sama
                            untuk segera melangkah ke jenjang pernikahan..
                        </p>
                    @endforeach

                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr class="text-center">
                @foreach ($allDataProgress as $data)
                    <td style="width: 20%"></td>
                    <td style="width: 30%">
                        @php
                            $path = Storage::url('uploads/karyawan/img/' . $data->foto_auth);
                        @endphp
                        <img src="{{ $path }}" style="height:80px">
                    </td>
                    <td style="width: 30%">
                        @php
                            $path = Storage::url('uploads/karyawan/img/' . $data->foto_profile);
                        @endphp
                        <img src="{{ $path }}" style="height:80px">
                    </td>
                    <td style="width: 20%"></td>
                @endforeach
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:justify;">
                    <p>Maka untuk melanjutkan proses taaruf ini, kami jadwalkan konsultasi/bimbingan untuk pasangan ini
                        pada hari ......., .............. pukul ..... WIB di Ruang Takmir Masjid Agung Al Azhar.
                        <br><br>Untuk informasi lebih lanjut pasangan dapat menghubungi Whatsapp Center kami
                        0882-1211-4771.<br><br> Semoga Allah SWT memberkahi dan memudahkan jalannya perjalanan hidup
                        pasangan ini.<br><br>
                        Wassalamu'alaikum Warahmatullahi Wabarakatuh

                    </p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:justify;">
                    <p>Demikian ini kami sampaikan, Atas perhatiannya kami ucapkan terima kasih.
                    </p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:justify;">
                    <p><i>Billahit Taufiq wal Hidayah</i>
                    <p><i>Wassalamualaikum Warrahmatullahi Wabarakatuh</i>
                    </p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table><br>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:justify;">

                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>

    </section>

</body>

</html>
