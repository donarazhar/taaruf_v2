<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProgressController extends Controller
{
    public function index()
    {
        $user = Auth::guard('karyawan')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $karyawan = DB::table('karyawan')
            ->select('karyawan.*', 'biodata.*', 'kriteriapasangan.*')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->where('karyawan.email', '=', $user) // Tambahkan tanda kutip di sekitar $email
            ->first();
        // Melakukan LEFT JOIN ke tabel karyawan untuk mendapatkan data dari tabel karyawan
        $dataprogress = DB::table('progress')
            ->leftJoin('karyawan', 'karyawan.email', '=', 'progress.email_auth')
            ->where(function ($query) use ($user) {
                $query->where('progress.email_auth', $user)
                    ->orWhere('progress.email_profile', $user);
            })
            ->where('progress.status', 1)
            ->select('progress.*', 'karyawan.nama')
            ->get();

        $likedislike = DB::table('likedislike')->get();

        return view('dashboard.progress.index', compact('dataprogress', 'karyawan', 'likedislike'));
    }

    public function like($id)
    {
        // Mendapatkan email auth
        $emailAuth = Auth::guard('karyawan')->user()->email;

        // Proses update atau insert
        DB::table('LikeDislike')->updateOrInsert(
            ['id_progress' => $id, 'emailAct' => $emailAuth],
            ['status' => 1]
        );

        // Redirect atau lakukan operasi lain sesuai kebutuhan
        return Redirect::back()->with(['success' => 'Terima kasih anda sudah melakukan pilihan !!!']);
    }

    public function dislike($id)
    {
        // Mendapatkan email auth
        $emailAuth = Auth::guard('karyawan')->user()->email;

        // Mendapatkan data progress yang akan dipindahkan
        $progressData = DB::table('progress')->where('id', $id)->first();

        if ($progressData) {
            // Proses insert ke tabel progress_shadow
            DB::table('progress_shadow')->insert([
                'id' => $progressData->id,
                'email_auth' => $progressData->email_auth,
                'email_profile' => $progressData->email_profile,
                'progress_tgl' => $progressData->progress_tgl,
                'status' => $progressData->status,

            ]);

            // Proses hapus data dari tabel progress
            DB::table('progress')->where('id', $id)->delete();

            // Proses update atau insert LikeDislike
            DB::table('LikeDislike')->updateOrInsert(
                ['id_progress' => $id, 'emailact' => $emailAuth],
                ['status' => 0]
            );

            // Redirect atau lakukan operasi lain sesuai kebutuhan
            return Redirect::back()->with(['success' => 'Terima kasih, sistem akan menghapus data dalam 2 jam !!!']);
        } else {
            // Data progress tidak ditemukan, mungkin ada penanganan khusus yang perlu dilakukan
            return Redirect::back()->with(['error' => 'Data progress tidak ditemukan.']);
        }
    }
}
