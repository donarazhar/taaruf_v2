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

    public function historychat($id)
    {
        // Mendapatkan data dari tabel 'chat_shadow' berdasarkan id_progress
        $chatData = DB::table('chat')
            ->join('progress', 'chat.id_progress', '=', 'progress.id')
            ->leftJoin('karyawan as senderKaryawan', 'chat.email_sender', '=', 'senderKaryawan.email')
            ->leftJoin('karyawan as profileKaryawan', 'progress.email_profile', '=', 'profileKaryawan.email')
            ->where('progress.id', $id)
            ->select(
                'progress.id as id_progress',
                'progress.email_auth',
                'progress.email_profile',
                'senderKaryawan.nama as nama_sender',
                'profileKaryawan.nama as nama_profile',
                'senderKaryawan.foto as foto_sender',
                'profileKaryawan.foto as foto_profile',
                'chat.pesan as pesan_sender',
                'chat.pesan as pesan_profile',
                'chat.tgl_pesan as tgl_pesan_sender',
                'chat.tgl_pesan as tgl_pesan_profile',
                DB::raw('CASE WHEN chat.email_sender = progress.email_auth THEN chat.pesan ELSE NULL END as pesan_sender'),
                DB::raw('CASE WHEN chat.email_sender = progress.email_profile THEN chat.pesan ELSE NULL END as pesan_profile'),
                DB::raw('CASE WHEN chat.email_sender = progress.email_auth THEN chat.tgl_pesan ELSE NULL END as tgl_pesan_sender'),
                DB::raw('CASE WHEN chat.email_sender = progress.email_profile THEN chat.tgl_pesan ELSE NULL END as tgl_pesan_profile')
            )
            ->get();

        // Mendapatkan data dari tabel 'chat_shadow' berdasarkan id_progress
        $chatShadowData = DB::table('chat_shadow')
            ->join('progress_shadow', 'chat_shadow.id_progress', '=', 'progress_shadow.id')
            ->leftJoin('karyawan as senderKaryawan', 'chat_shadow.email_sender', '=', 'senderKaryawan.email')
            ->leftJoin('karyawan as profileKaryawan', 'progress_shadow.email_profile', '=', 'profileKaryawan.email')
            ->where('progress_shadow.id', $id)
            ->select(
                'progress_shadow.id as id_progress',
                'progress_shadow.email_auth',
                'progress_shadow.email_profile',
                'senderKaryawan.nama as nama_sender',
                'profileKaryawan.nama as nama_profile',
                'senderKaryawan.foto as foto_sender',
                'profileKaryawan.foto as foto_profile',
                'chat_shadow.pesan as pesan_sender',
                'chat_shadow.pesan as pesan_profile',
                'chat_shadow.tgl_pesan as tgl_pesan_sender',
                'chat_shadow.tgl_pesan as tgl_pesan_profile',
                DB::raw('CASE WHEN chat_shadow.email_sender = progress_shadow.email_auth THEN chat_shadow.pesan ELSE NULL END as pesan_sender'),
                DB::raw('CASE WHEN chat_shadow.email_sender = progress_shadow.email_profile THEN chat_shadow.pesan ELSE NULL END as pesan_profile'),
                DB::raw('CASE WHEN chat_shadow.email_sender = progress_shadow.email_auth THEN chat_shadow.email_sender ELSE NULL END as tgl_pesan_sender'),
                DB::raw('CASE WHEN chat_shadow.email_sender = progress_shadow.email_profile THEN chat_shadow.tgl_pesan ELSE NULL END as tgl_pesan_profile')
            )
            ->get();
        // Menggabungkan data dari 'chat' dan 'chat_shadow'
        $allChats = $chatData->merge($chatShadowData);

        // Jika data tidak ditemukan, mungkin ada penanganan khusus yang perlu dilakukan
        if ($allChats->isEmpty()) {
            return redirect()->back()->with(['error' => 'Data tidak ditemukan.']);
        }
        return view('dashboardadmin.chathistory.history', compact('allChats'));
    }
}
