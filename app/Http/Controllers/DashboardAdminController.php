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

        $allIdProgress = DB::table('progress')->select('id')->distinct()
            ->union(DB::table('chat')->select('id_progress')->distinct())
            ->union(DB::table('chat_shadow')->select('id_progress')->distinct())
            ->union(DB::table('progress_shadow')->select('id')->distinct())
            ->get();

        return view('dashboardadmin.index', compact('datauser', 'datakaryawan', 'pendidikan', 'suku'));
    }
}
