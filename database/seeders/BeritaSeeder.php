<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('berita')->insert([
            [
                'foto' => 'berita/berita1.jpg',
                'judul' => 'Peluncuran Program Kesejahteraan Karyawan Baru',
                'subjudul' => 'Perusahaan meluncurkan program kesejahteraan komprehensif untuk meningkatkan kualitas hidup karyawan',
                'isi' => 'Perusahaan kami dengan bangga mengumumkan peluncuran program kesejahteraan karyawan yang baru dan komprehensif. Program ini mencakup asuransi kesehatan premium, program pensiun yang lebih baik, dan berbagai fasilitas kesejahteraan lainnya. Kami berkomitmen untuk menciptakan lingkungan kerja yang mendukung dan memberikan nilai tambah bagi seluruh karyawan kami.',
                'link' => 'https://example.com/berita/1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'foto' => 'berita/berita2.jpg',
                'judul' => 'Raih Kesempatan Emas Bergabung dengan Tim Kami',
                'subjudul' => 'Perusahaan membuka lowongan kerja untuk berbagai posisi strategis',
                'isi' => 'Kami membuka kesempatan bagi talenta-talenta terbaik untuk bergabung dengan tim kami. Posisi yang tersedia meliputi engineer, marketing specialist, product manager, dan berbagai posisi lainnya. Bergabunglah dengan perusahaan yang dinamis dan terus berkembang. Kirimkan CV Anda melalui portal karir kami.',
                'link' => 'https://example.com/berita/2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'foto' => 'berita/berita3.jpg',
                'judul' => 'Inovasi Terbaru dalam Platform Digital Kami',
                'subjudul' => 'Teknologi AI dan machine learning terintegrasi untuk pengalaman pengguna yang lebih baik',
                'isi' => 'Tim engineering kami telah mengembangkan fitur-fitur inovatif menggunakan teknologi artificial intelligence dan machine learning. Fitur-fitur baru ini dirancang untuk memberikan pengalaman pengguna yang lebih personal dan intuitif. Update terbaru akan diluncurkan bulan depan dengan berbagai peningkatan performa dan keamanan.',
                'link' => 'https://example.com/berita/3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'foto' => 'berita/berita4.jpg',
                'judul' => 'Pencapaian Luar Biasa: Melampaui Target Penjualan Kuartal Ini',
                'subjudul' => 'Pertumbuhan bisnis mencapai 150% dari target yang telah ditetapkan',
                'isi' => 'Dengan kerja keras dan dedikasi seluruh tim, kami berhasil melampaui target penjualan kuartal ini dengan pencapaian 150%. Kesuksesan ini adalah hasil dari strategi pemasaran yang tepat, layanan pelanggan yang excellent, dan inovasi produk berkelanjutan. Terima kasih atas kontribusi luar biasa dari semua departemen.',
                'link' => 'https://example.com/berita/4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'foto' => 'berita/berita5.jpg',
                'judul' => 'Komitmen Kami terhadap Keberlanjutan Lingkungan',
                'subjudul' => 'Program green initiative untuk mengurangi jejak karbon perusahaan',
                'isi' => 'Perusahaan kami berkomitmen untuk mengurangi dampak lingkungan melalui berbagai inisiatif hijau. Program ini meliputi penggunaan energi terbarukan, pengurangan limbah plastik, dan penanaman pohon. Kami percaya bahwa bisnis yang berkelanjutan adalah bisnis yang bertanggung jawab terhadap masa depan planet kita.',
                'link' => 'https://example.com/berita/5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}