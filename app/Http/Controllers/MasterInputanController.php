<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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

        // Render view Blade untuk mendapatkan link pesan HTML
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

    public function masterberita()
    {
        // Mendapatkan AUTH
        $user = Auth::guard('user')->user()->email;
        // Mendapatkan data user berdasarkan email
        $datauser = DB::table('users')->where('email', $user)->first();
        $databerita = DB::table('berita')->get();

        return view('dashboardadmin.masterinputan.berita', compact('databerita', 'datauser'));
    }

    public function editberita(Request $request)
    {
        $id = $request->id;
        $user = Auth::guard('user')->user()->email;
        $datauser = DB::table('users')->where('email', $user)->first();
        $databerita = DB::table('berita')->where('id', $id)->first();

        return view('dashboardadmin.masterinputan.editberita', compact('databerita', 'datauser'));
    }

    public function updateberita($id, Request $request)
    {
        // Validasi input
        $request->validate([
            'fotoedit' => 'image|mimes:png,jpg|max:2024',
            'juduledit' => 'required',
            'subjuduledit' => 'required',
            'isiberitaedit' => 'required',
            'linkedit' => 'required',
        ]);

        try {
            // Mengambil data berita dari database
            $databerita = DB::table('berita')->where('id', $id)->first();
            $fotoFile = $request->file('fotoedit');
            // Menentukan nama file foto yang akan digunakan
            $extension = $fotoFile->getClientOriginalExtension();
            $filename = substr(Hash::make($fotoFile->getClientOriginalName()), 0, 10) . '.' . $extension;
            $foto = $filename;

            // Proses Upload Foto baru
            if ($request->hasFile('fotoedit')) {
                $fotoFile->storeAs('public/uploads/berita/', $filename);

                // Hapus foto lama jika berhasil mengunggah foto baru
                if ($databerita->foto && Storage::exists('public/uploads/berita/' . $databerita->foto)) {
                    Storage::delete('public/uploads/berita/' . $databerita->foto);
                }
            }

            // Data yang akan diupdate
            $data = [
                'foto' => $foto,
                'judul' => $request->input('juduledit'),
                'subjudul' => $request->input('subjuduledit'),
                'isi' => $request->input('isiberitaedit'),
                'link' => $request->input('linkedit'),
            ];

            // Lakukan update
            DB::table('berita')->where('id', $id)->update($data);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Berita berhasil diperbarui');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function berita1(Request $request)
    {
        $id = "1";
        $databerita = DB::table('berita')->where('id', $id)->first();
        return view('dashboardadmin.masterinputan.berita1', compact('databerita'));
    }
    public function berita2(Request $request)
    {
        $id = "2";
        $databerita = DB::table('berita')->where('id', $id)->first();
        return view('dashboardadmin.masterinputan.berita2', compact('databerita'));
    }
    public function berita3(Request $request)
    {
        $id = "3";
        $databerita = DB::table('berita')->where('id', $id)->first();
        return view('dashboardadmin.masterinputan.berita3', compact('databerita'));
    }
    public function berita4(Request $request)
    {
        $id = "4";
        $databerita = DB::table('berita')->where('id', $id)->first();
        return view('dashboardadmin.masterinputan.berita4', compact('databerita'));
    }
}
