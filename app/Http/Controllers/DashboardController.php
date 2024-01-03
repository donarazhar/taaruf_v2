<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $email = Auth::guard('karyawan')->user()->email;
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();
        return view('dashboard.index', compact('dataprofile'));
    }

    public function profile()
    {
        $email = Auth::guard('karyawan')->user()->email;
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();
        return view('dashboard.profile', compact('dataprofile'));
    }

    public function taaruf()
    {
        $email = Auth::guard('karyawan')->user()->email;
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();
        return view('dashboard.taaruf', compact('dataprofile'));
    }
    public function progress()
    {
        $email = Auth::guard('karyawan')->user()->email;
        $dataprofile = DB::table('karyawan')->where('email', $email)->first();
        return view('dashboard.progress', compact('dataprofile'));
    }
}
