<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaarufContoller extends Controller
{
    public function lihatprofile(Request $request)
    {
        $email = $request->email;
        $karyawan = DB::table('karyawan')->where('karyawan.email', $email)
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->first();

        return view('dashboard.taaruf.lihatprofile', compact('karyawan'));
    }
}
