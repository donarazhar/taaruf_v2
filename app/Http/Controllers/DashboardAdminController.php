<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Mendapatkan AUTH
        $email = Auth::guard('user')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $datauser = DB::table('users')->where('email', $email)->first();
        $datakaryawan = Karyawan::select(
            'karyawan.*',
            'biodata.*',
            'kriteriapasangan.*',
            'karyawan.id as id_karyawan'
        )
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->orderBy('id_karyawan', 'asc')
            ->paginate(4); // Sesuaikan nilai paginate sesuai kebutuhan

        $pendidikan = Biodata::selectRaw('pendidikan, COUNT(*) as count')
            ->groupBy('pendidikan')
            ->get();
        $suku = Biodata::selectRaw('suku, COUNT(*) as count')
            ->groupBy('suku')
            ->get();

        $allidProgress = DB::table('progress')
            ->select('id')
            ->distinct()
            ->union(DB::table('progress_shadow')->select('id')->distinct())
            ->get();

        // Mengambil data dari tabel 'chat' berdasarkan id_progress
        $allChats = DB::table('chat')
            ->join('progress', 'chat.id_progress', '=', 'progress.id')
            ->leftJoin('karyawan', 'chat.email_sender', '=', 'karyawan.email')
            ->leftJoin('karyawan as karyawan_profile', 'progress.email_profile', '=', 'karyawan_profile.email')
            ->whereIn('progress.id', $allidProgress->pluck('id'))
            ->select(
                'progress.id as id_progress',
                'progress.email_auth',
                'progress.email_profile',
                'karyawan.nama as nama_sender',
                'karyawan.foto as foto_sender',
                'karyawan_profile.nama as nama_profile',
                'karyawan_profile.foto as foto_profile',
                'chat.pesan as pesan_sender',
                'chat.tgl_pesan'
            )
            ->get();

        // Mengambil data dari tabel 'chat_shadow' berdasarkan id_progress
        $allChatsShadow = DB::table('chat_shadow')
            ->join('progress_shadow', 'chat_shadow.id_progress', '=', 'progress_shadow.id')
            ->leftJoin('karyawan', 'chat_shadow.email_sender', '=', 'karyawan.email')
            ->leftJoin('karyawan as karyawan_profile', 'progress_shadow.email_profile', '=', 'karyawan_profile.email')
            ->whereIn(
                'progress_shadow.id',
                $allidProgress->pluck('id')
            )
            ->select(
                'progress_shadow.id as id_progress',
                'progress_shadow.email_auth',
                'progress_shadow.email_profile',
                'karyawan.nama as nama_sender',
                'karyawan.foto as foto_sender',
                'karyawan_profile.nama as nama_profile',
                'karyawan_profile.foto as foto_profile',
                'chat_shadow.pesan as pesan_sender',
                'chat_shadow.tgl_pesan'
            )
            ->get();

        $allData = $allChats->merge($allChatsShadow);
        $groupedData = $allData->groupBy('id_progress');
        $resultChat = [];
        foreach ($groupedData as $idProgress => $group) {
            $resultChat[] = [
                'id_progress' => $idProgress,
                'data' => $group->map(function ($item) {
                    return [
                        'email_auth' => $item->email_auth,
                        'email_profile' => $item->email_profile,
                        'nama_sender' => $item->nama_sender,
                        'nama_profile' => $item->nama_profile,
                        'foto_sender' => $item->foto_sender,
                        'foto_profile' => $item->foto_profile,
                        'pesan_sender' => $item->pesan_sender,
                        'tgl_pesan' => $item->tgl_pesan,
                    ];
                })->all(),
            ];
        }

        return view('dashboardadmin.index', compact('datauser', 'datakaryawan', 'pendidikan', 'suku', 'resultChat'));
    }

    public function daftartanya()
    {
        // Mendapatkan AUTH
        $email = Auth::guard('user')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $datauser = DB::table('users')->where('email', $email)->first();
        $pertanyaan = DB::table('pertanyaan')->get();
        return view('dashboardadmin.tanya.index', compact('pertanyaan', 'datauser'));
    }
    public function prosestaaruf()
    {
        // Mendapatkan AUTH
        $email = Auth::guard('user')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $datauser = DB::table('users')->where('email', $email)->first();

        $dataProgress = DB::table('progress')
            ->leftJoin('likedislike as authLike', 'progress.email_auth', '=', 'authLike.emailact')
            ->leftJoin('likedislike as profileLike', 'progress.email_profile', '=', 'profileLike.emailact')
            ->leftJoin('karyawan as authKaryawan', 'progress.email_auth', '=', 'authKaryawan.email')
            ->leftJoin('karyawan as profileKaryawan', 'progress.email_profile', '=', 'profileKaryawan.email')
            ->select(
                'progress.id',
                'progress.progress_tgl',
                'authKaryawan.nama as nama_auth',
                'profileKaryawan.nama as nama_profile',
                'authKaryawan.foto as foto_auth',
                'profileKaryawan.foto as foto_profile',
                'authLike.status as authStatus',
                'profileLike.status as profileStatus',
            )
            ->get();


        $dataProgressShadow = DB::table('progress_shadow')
            ->leftJoin('likedislike_shadow as authLike', function ($join) {
                $join->on('progress_shadow.email_auth', '=', 'authLike.emailact')
                    ->where('authLike.id_progress', '=', DB::raw('progress_shadow.id'));
            })
            ->leftJoin('likedislike_shadow as profileLike', function ($join) {
                $join->on('progress_shadow.email_profile', '=', 'profileLike.emailact')
                    ->where('profileLike.id_progress', '=', DB::raw('progress_shadow.id'));
            })
            ->leftJoin('karyawan as authKaryawan', 'progress_shadow.email_auth', '=', 'authKaryawan.email')
            ->leftJoin('karyawan as profileKaryawan', 'progress_shadow.email_profile', '=', 'profileKaryawan.email')
            ->select(
                'progress_shadow.id',
                'progress_shadow.progress_tgl',
                'authKaryawan.nama as nama_auth',
                'profileKaryawan.nama as nama_profile',
                'authKaryawan.foto as foto_auth',
                'profileKaryawan.foto as foto_profile',
                DB::raw('CASE WHEN authLike.status IN (0, 1) THEN authLike.status ELSE null END AS authStatus'),
                DB::raw('CASE WHEN profileLike.status IN (0, 1) THEN profileLike.status ELSE null END AS profileStatus')
            )
            ->get();

        $allDataProgress = $dataProgress->merge($dataProgressShadow);
        // Jika data tidak ditemukan, mungkin ada penanganan khusus yang perlu dilakukan
        if ($allDataProgress->isEmpty()) {
            return redirect()->back()->with(['error' => 'Data tidak ditemukan.']);
        }

        return view('dashboardadmin.proses.index', compact('allDataProgress', 'datauser'));
    }
    public function prosescetak($id, Request $request)
    {
        // Mendapatkan AUTH
        $email = Auth::guard('user')->user()->email;
        // Mendapatkan data profile berdasarkan email
        $datauser = DB::table('users')->where('email', $email)->first();

        $dataProgress = DB::table('progress')
            ->leftJoin('likedislike as authLike', 'progress.email_auth', '=', 'authLike.emailact')
            ->leftJoin('likedislike as profileLike', 'progress.email_profile', '=', 'profileLike.emailact')
            ->leftJoin('karyawan as authKaryawan', 'progress.email_auth', '=', 'authKaryawan.email')
            ->leftJoin('karyawan as profileKaryawan', 'progress.email_profile', '=', 'profileKaryawan.email')
            ->where('progress.id', $id)
            ->select(
                'progress.id',
                'progress.progress_tgl',
                'authKaryawan.nama as nama_auth',
                'profileKaryawan.nama as nama_profile',
                'authKaryawan.foto as foto_auth',
                'profileKaryawan.foto as foto_profile',
                'authLike.status as authStatus',
                'profileLike.status as profileStatus',
            )
            ->get();

        $dataProgressShadow = DB::table('progress_shadow')
            ->leftJoin('likedislike_shadow as authLike', function ($join) {
                $join->on('progress_shadow.email_auth', '=', 'authLike.emailact')
                    ->where('authLike.id_progress', '=', DB::raw('progress_shadow.id'));
            })
            ->leftJoin('likedislike_shadow as profileLike', function ($join) {
                $join->on('progress_shadow.email_profile', '=', 'profileLike.emailact')
                    ->where('profileLike.id_progress', '=', DB::raw('progress_shadow.id'));
            })
            ->leftJoin('karyawan as authKaryawan', 'progress_shadow.email_auth', '=', 'authKaryawan.email')
            ->leftJoin('karyawan as profileKaryawan', 'progress_shadow.email_profile', '=', 'profileKaryawan.email')
            ->where('progress_shadow.id', $id)
            ->select(
                'progress_shadow.id',
                'progress_shadow.progress_tgl',
                'authKaryawan.nama as nama_auth',
                'profileKaryawan.nama as nama_profile',
                'authKaryawan.foto as foto_auth',
                'profileKaryawan.foto as foto_profile',
                DB::raw('CASE WHEN authLike.status IN (0, 1) THEN authLike.status ELSE null END AS authStatus'),
                DB::raw('CASE WHEN profileLike.status IN (0, 1) THEN profileLike.status ELSE null END AS profileStatus')
            )
            ->get();

        $allDataProgress = $dataProgress->merge($dataProgressShadow);
        // Jika data tidak ditemukan, mungkin ada penanganan khusus yang perlu dilakukan
        if ($allDataProgress->isEmpty()) {
            return redirect()->back()->with(['error' => 'Data tidak ditemukan.']);
        }
        return view('dashboardadmin.proses.cetak', compact('allDataProgress', 'datauser'));
    }
}
