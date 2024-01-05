<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan AUTH
        $email = Auth::guard('karyawan')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();
        return view('dashboard.index', compact('dataprofile'));
    }

    public function profile()
    {
        // Mendapatkan AUTH
        $email = Auth::guard('karyawan')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();
        $dataprofilelengkap = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->where('karyawan.email', $email)
            ->first();

        return view('dashboard.profile.index', compact('dataprofile', 'dataprofilelengkap'));
    }

    public function taaruf()
    {
        // Mendapatkan AUTH
        $email = Auth::guard('karyawan')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();
        // Membaca jenis kelamin dari data profile
        $jenisKelamin = $dataprofile->jenkel;
        // Mendapatkan semua data karyawan dengan jenis kelamin yang berbeda
        $users = DB::table('karyawan')
            ->where('jenkel', '!=', $jenisKelamin) // Mengambil data dengan jenis kelamin berbeda
            ->get();
        return view('dashboard.taaruf.index', compact('dataprofile', 'users'));
    }

    public function progress()
    {
        // Mendapatkan AUTH
        $email = Auth::guard('karyawan')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();
        return view('dashboard.progress.index', compact('dataprofile'));
    }

    public function updateprofile(Request $request)
    {
        $user = Auth::guard('karyawan')->user();
        $email = $user->email;
        $nama = $request->nama;
        $password = $request->password;

        // Validasi untuk file yang diupload
        $request->validate([
            'foto' => 'image|mimes:png,jpg|max:2024'
        ]);

        try {
            // Proses Upload Foto
            $foto = $user->foto;
            if ($request->hasFile('foto')) {
                $foto = $email . '.' . $request->file('foto')->getClientOriginalExtension();
                $request->file('foto')->storeAs('public/uploads/karyawan/img/', $foto);
            }

            // Data untuk diupdate
            $data = [
                'nama' => $nama,
                'foto' => $foto,
            ];

            // Jika password diisi, update password
            if (!empty($password)) {
                $data['password'] = Hash::make($password);
            }

            // Lakukan update data karyawan
            DB::table('karyawan')->where('email', $email)->update($data);

            return Redirect::back()->with(['success' => 'Berhasil diupdate']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Maaf ada kesalahan inputan']);
        }
    }

    public function updateprofile2(Request $request)
    {
        $user = Auth::guard('karyawan')->user();
        $email = $user->email;
        $nohp = $request->nohp;
        $tempatlahir = $request->tempatlahir;
        $tgllahir = $request->tgllahir;
        $tinggi = $request->tinggi;
        $berat = $request->berat;
        $goldar = $request->goldar;
        $statusnikah = $request->statusnikah;
        $pekerjaan = $request->pekerjaan;
        $suku = $request->suku;
        $pendidikan = $request->pendidikan;
        $hobi = $request->hobi;
        $motto = $request->motto;
        $alamat = $request->alamat;
        $video = $request->video;

        // Validasi untuk file yang diupload
        $request->validate([
            'video' => 'mimetypes:video/mp4,video/x-msvideo,video/mpeg,video/quicktime|max:8024',
        ]);

        try {
            // Pemeriksaan apakah biodata dengan email tersebut sudah ada
            $adaData = DB::table('biodata')->where('email', $email)->first();

            // Proses Upload Foto
            $video = $user->video;
            if ($request->hasFile('video')) {
                $video = $email . '.' . $request->file('video')->getClientOriginalExtension();
                $request->file('video')->storeAs('public/uploads/karyawan/video/', $video);
            }

            // Data untuk diupdate
            $data = [
                'email' => $email,
                'nohp' => $nohp,
                'tempatlahir' => $tempatlahir,
                'tgllahir' => $tgllahir,
                'tinggi' => $tinggi,
                'berat' => $berat,
                'goldar' => $goldar,
                'statusnikah' => $statusnikah,
                'pekerjaan' => $pekerjaan,
                'suku' => $suku,
                'pendidikan' => $pendidikan,
                'hobi' => $hobi,
                'motto' => $motto,
                'alamat' => $alamat,
                'video' => $video,
            ];
            // Lakukan insert jika belum ada data, atau update jika sudah ada
            if ($adaData) {
                DB::table('biodata')->where('email', $email)->update($data);
            } else {
                DB::table('biodata')->insert($data);
            }

            return Redirect::back()->with(['success' => 'Berhasil diupdate']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Maaf ada kesalahan inputan']);
        }
    }

    public function updateprofile3(Request $request)
    {
        $user = Auth::guard('karyawan')->user();
        $email = $user->email;
        $umurRange = $request->umurRange;
        $beratRange = $request->beratRange;
        $tinggiRange = $request->tinggiRange;
        $sukupilihan = $request->sukupilihan;
        $kriteriaumum = $request->kriteriaumum;

        try {
            // Pemeriksaan apakah biodata dengan email tersebut sudah ada
            $adaData = DB::table('kriteriapasangan')->where('email', $email)->first();

            // Data untuk diupdate
            $data = [
                'email' => $email,
                'kriteriaumur' => $umurRange,
                'kriteriatinggi' => $tinggiRange,
                'kriteriaberat' => $beratRange,
                'kriteriasuku' => $sukupilihan,
                'kriteriaumum' => $kriteriaumum,

            ];
            // Lakukan insert jika belum ada data, atau update jika sudah ada
            if ($adaData) {
                DB::table('kriteriapasangan')->where('email', $email)->update($data);
            } else {
                DB::table('kriteriapasangan')->insert($data);
            }

            return Redirect::back()->with(['success' => 'Berhasil diupdate']);
        } catch (\Exception $e) {
            dd($e);
            return Redirect::back()->with(['warning' => 'Maaf ada kesalahan inputan']);
        }
    }
}
