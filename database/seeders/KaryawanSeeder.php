<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('karyawan')->insert([
            [
                'nip' => 'K001',
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'jenkel' => 'L',
                'password' => Hash::make('password123'),
                'referensi' => 'Internal',
                'referensi_detail' => 'Referensi dari rekan kerja',
                'foto' => '',
                'status' => '1',
                'email_verification_token' => 'BfX7iVXDRFGKE7q2nFB6TxfFGFDlLmnQtGcbSWqu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => 'K002',
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@example.com',
                'jenkel' => 'P',
                'password' => Hash::make('password123'),
                'referensi' => 'External',
                'referensi_detail' => 'Referensi dari iklan lowongan',
                'foto' => '',
                'status' => '1',
                'email_verification_token' => 'BfX7iVXDRFGKE7q2nFB6TxfFGFDlLmnQtGcbSWqu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => 'K003',
                'nama' => 'Ahmad Wijaya',
                'email' => 'ahmad.wijaya@example.com',
                'jenkel' => 'L',
                'password' => Hash::make('password123'),
                'referensi' => 'Internal',
                'referensi_detail' => 'Referensi dari manajemen',
                'foto' => '',
                'status' => '1',
                'email_verification_token' => 'BfX7iVXDRFGKE7q2nFB6TxfFGFDlLmnQtGcbSWqu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => 'K004',
                'nama' => 'Rina Kusuma',
                'email' => 'rina.kusuma@example.com',
                'jenkel' => 'P',
                'password' => Hash::make('password123'),
                'referensi' => 'External',
                'referensi_detail' => 'Referensi dari media sosial',
                'foto' => '',
                'status' => '1',
                'email_verification_token' => 'BfX7iVXDRFGKE7q2nFB6TxfFGFDlLmnQtGcbSWqu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => 'K005',
                'nama' => 'Dedi Hermawan',
                'email' => 'dedi.hermawan@example.com',
                'jenkel' => 'L',
                'password' => Hash::make('password123'),
                'referensi' => 'Internal',
                'referensi_detail' => 'Referensi dari kepala departemen',
                'foto' => '',
                'status' => '1',
                'email_verification_token' => 'BfX7iVXDRFGKE7q2nFB6TxfFGFDlLmnQtGcbSWqu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}