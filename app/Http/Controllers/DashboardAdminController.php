<?php

namespace App\Http\Controllers;

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
        $databerita = DB::table('berita')->get();
        return view('dashboardadmin.index', compact('datauser', 'databerita'));
    }
}
