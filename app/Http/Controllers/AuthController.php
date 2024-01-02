<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function prosesdaftar(Request $request)
    {
        $nip = $request->nip;
        $nama = $request->nama;
        $jenkel = $request->jenkel;
        $referensi = $request->referensi;
        $referensiDetail = $request->referensiDetail;
        $email = $request->email;
        $password = $request->password;

        try {
            $data = [
                'nip' => $nip,
                'nama' => $nama,
                'jenkel' => $jenkel,
                'referensi' => $referensi,
                'referensi_detail' => $referensiDetail,
                'email' => $email,
                'password' => Hash::make($password)
            ];

            $simpan = DB::table('karyawan')->insert($data);
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Berhasil Mendaftar !!!, Mohon menunggu email konfirmasi untuk LOGIN.']);
            }
        } catch (\Exception $e) {
            dd($e);
            return Redirect::back()->with(['warning' => 'Maaf ada kesalahan inputan']);
        }
    }

    // Login admin
    public function proseslogin(Request $request)
    {
        if (Auth::guard('karyawan')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/login')->with(['warning' => 'Username / Password Salah']);
        }
    }

    public function proseslogout()
    {
        // logout admin
        if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }
}
