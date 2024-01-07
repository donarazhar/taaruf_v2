<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ChatController extends Controller
{
    public function chat($id)
    {
        // Mendapatkan email auth
        $emailAuth = Auth::guard('karyawan')->user()->email;

        // Mendapatkan data profile berdasarkan email
        $karyawan = DB::table('karyawan')
            ->select('karyawan.*', 'biodata.*', 'kriteriapasangan.*')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin(
                'kriteriapasangan',
                'karyawan.email',
                '=',
                'kriteriapasangan.email'
            )
            ->where(
                'karyawan.email',
                '=',
                $emailAuth
            ) // Tambahkan tanda kutip di sekitar $email
            ->first();
        // Melakukan LEFT JOIN ke tabel karyawan untuk mendapatkan data dari tabel karyawan
        $datachat = DB::table('progress')
            ->leftJoin('karyawan', 'karyawan.email', '=', 'progress.email_auth')
            ->where(function ($query) use ($emailAuth) {
                $query->where('progress.email_auth', $emailAuth)
                    ->orWhere('progress.email_profile', $emailAuth);
            })
            ->where('progress.status', 1)
            ->select('progress.*', 'karyawan.nama')
            ->get();


        return view('dashboard.progress.chat', compact('karyawan', 'datachat'));
    }
}
