<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TaarufContoller extends Controller
{
    public function lihatprofile(Request $request)
    {
        $user = Auth::guard('karyawan')->user()->email;
        $emailprofile   = $request->email;
        $karyawan = DB::table('karyawan')
            ->select('karyawan.*', 'biodata.*', 'kriteriapasangan.*')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->where('karyawan.email', '=', $emailprofile) // Tambahkan tanda kutip di sekitar $email
            ->first();

        // Melakukan query ke database untuk mendapatkan status
        $status = DB::table('progress')
            ->where(function ($query) use ($user, $emailprofile) {
                $query->where('email_auth', $user)
                    ->orWhere('email_profile', $user)
                    ->orWhere('email_auth', $emailprofile)
                    ->orWhere('email_profile', $emailprofile);
            })
            ->where('status', 1)
            ->select('status')
            ->first();

        $isDisabled = $status ? true : false;


        $cekemail = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->select('karyawan.email', 'biodata.email as biodata_email', 'kriteriapasangan.email as kriteriapasangan_email')
            ->where('karyawan.email', $user)
            ->first();

        if ($cekemail) {
            // Jika email ditemukan di tabel karyawan
            if (
                $cekemail->biodata_email !== null && $cekemail->kriteriapasangan_email !== null
            ) {
                // Lakukan sesuatu jika email ditemukan di kedua tabel biodata dan kriteriapasangan
                // Misalnya, aktifkan menu
                $menuAktif = true;
            } else {
                // Lakukan sesuatu jika email tidak ditemukan di salah satu atau kedua tabel
                // Misalnya, nonaktifkan menu
                $menuAktif = false;
            }
        } else {
            // Lakukan sesuatu jika email tidak ditemukan di tabel karyawan
            // Misalnya, nonaktifkan menu
            $menuAktif = false;
        }
        return view('dashboard.taaruf.lihatprofile', compact('karyawan', 'emailprofile', 'isDisabled', 'menuAktif'));
    }
    public function progressprofile(Request $request)
    {
        $user = Auth::guard('karyawan')->user()->email;
        $emailprofile = $request->input('emailprofile');
        $status = '1';
        try {
            $data = [
                'email_auth' => $user,
                'email_profile' => $emailprofile,
                'progress_tgl' => now(),
                'status' => $status
            ];
            $simpan = DB::table('progress')->insert($data);
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Anda berhasil memprogress']);
            }
        } catch (\Exception $e) {
            dd($e);
            return Redirect::back()->with(['warning' => 'Maaf ada kesalahan']);
        }
    }
}
