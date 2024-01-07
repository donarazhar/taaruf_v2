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
        $dataprofile = DB::table('users')->where('email', $email)->first();
        return view('dashboardadmin.index', compact('dataprofile'));
    }
}
