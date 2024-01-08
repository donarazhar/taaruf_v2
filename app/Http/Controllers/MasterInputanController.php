<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class MasterInputanController extends Controller
{
    public function masterkaryawan()
    {
        // Mendapatkan AUTH
        $user = Auth::guard('user')->user()->email;
        // Mendapatkan data user berdasarkan email
        $datauser = DB::table('users')->where('email', $user)->first();
        $karyawan = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->select('karyawan.*', 'biodata.*', 'kriteriapasangan.*', 'karyawan.id as id_karyawan')
            ->orderBy('id_karyawan', 'asc')
            ->get();

        return view('dashboardadmin.masterinputan.karyawan', compact('datauser', 'karyawan'));
    }


    public function verifikasi($id_karyawan)
    {
        // Ambil data karyawan berdasarkan ID
        $karyawan = DB::table('karyawan')
            ->leftJoin('biodata', 'karyawan.email', '=', 'biodata.email')
            ->leftJoin('kriteriapasangan', 'karyawan.email', '=', 'kriteriapasangan.email')
            ->select('karyawan.*', 'biodata.*', 'kriteriapasangan.*', 'karyawan.id as id_karyawan')
            ->first();

        // Pastikan karyawan ditemukan
        if (!$karyawan) {
            return redirect()->back()->with(['error' => 'Karyawan tidak ditemukan']);
        }

        // Generate token acak
        $token = Str::random(40); // Ubah panjang token sesuai kebutuhan

        // Simpan token ke dalam database karyawan
        DB::table('karyawan')->where('id', $id_karyawan)->update(['email_verification_token' => $token]);

        // Render view Blade untuk mendapatkan isi pesan HTML
        $emailContentHTML = View::make('dashboardadmin.masterinputan.aktivasi', ['activation_link' => url("/masterkaryawan/verify/{$token}")])->render();

        // Hapus tag HTML untuk mendapatkan konten teks
        $emailContentText = strip_tags($emailContentHTML);

        // Kirim email aktivasi kepada karyawan
        $user = [
            'email' => $karyawan->email,
            'activation_link' => url("/masterkaryawan/verify/{$token}")
        ];

        Mail::send('dashboardadmin.masterinputan.aktivasi', $user, function ($message) use ($user) {
            $message->from('no-reply@masjidagungalazhar.com', 'Aktivasi Akun');
            $message->to($user['email']);
            $message->cc('taarufonline2023@gmail.com');
            $message->subject('Aktivasi Akun | Aplikasi Taaruf Online');
        });

        // API WA Gateway untuk mengirimkan pesan teks ke WA Karyawan
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://wag.masjidagungalazhar.com/send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('message' => $emailContentText . ' Copi link berikut : ' . $user['activation_link'], 'number' => $karyawan->nohp, 'file_dikirim' => ''),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        // Redirect jika email berhasil dikirim
        return redirect()->back()->with(['success' => 'Email verifikasi telah dikirim.']);
    }


    public function verify($token)
    {

        // Temukan karyawan berdasarkan token
        $karyawan = DB::table('karyawan')->where('email_verification_token', $token)->first();

        // Pastikan karyawan ditemukan
        if (!$karyawan) {
            return redirect()->back()->with(['error' => 'Token verifikasi tidak valid']);
        }

        // Set status karyawan menjadi 1 (terverifikasi)
        DB::table('karyawan')->where('email_verification_token', $token)->update(['status' => 1]);

        // Redirect atau lakukan operasi lain sesuai kebutuhan
        return Redirect::route('/')->with(['success' => 'Sukses verifikasi !!!']);
    }
}
