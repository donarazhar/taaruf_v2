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

        $dataprogress = DB::table('progress')
            ->leftJoin('karyawan', 'karyawan.email', '=', 'progress.email_auth')
            ->where(function ($query) use ($emailAuth) {
                $query->where('progress.email_auth', $emailAuth)
                    ->orWhere('progress.email_profile', $emailAuth);
            })
            ->where('progress.status', 1)
            ->select('progress.*', 'karyawan.nama')
            ->get();

        // Melakukan LEFT JOIN ke tabel karyawan untuk mendapatkan data dari tabel karyawan
        $datachat = DB::table('chat')
            ->join(
                'progress',
                'progress.id',
                '=',
                'chat.id_progress'
            )
            ->leftJoin('karyawan', 'karyawan.email', '=', 'chat.email_sender')
            ->where(function ($query) use ($emailAuth) {
                $query->where('progress.email_auth', $emailAuth)
                    ->orWhere('progress.email_profile', $emailAuth);
            })
            ->where('progress.status', 1)
            ->select('chat.id', 'progress.id as id_progress', 'chat.email_sender', 'chat.pesan', 'chat.tgl_pesan', 'karyawan.nama', 'karyawan.foto', 'karyawan.jenkel')
            ->orderBy('chat.tgl_pesan', 'asc')
            ->get();

        return view('dashboard.progress.chat', compact('karyawan', 'datachat', 'dataprogress'));
    }

    public function store($id, Request $request)
    {

        $emailAuth = Auth::guard('karyawan')->user()->email;
        $pesan = $request->pesan;

        try {
            $data = [

                'pesan' => $pesan,
                'id_progress' => $id,
                'email_sender' => $emailAuth,
                'tgl_pesan' => now()->format('Y-m-d H:i:s')
            ];

            $simpan = DB::table('chat')->insert($data);
            if ($simpan) {
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
