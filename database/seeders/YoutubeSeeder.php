<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YoutubeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('youtube')->insert([
            [
                'link' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'gambar' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'https://www.youtube.com/embed/9bZkp7q19f0',
                'gambar' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'https://www.youtube.com/embed/jNQXAC9IVRw',
                'gambar' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'https://www.youtube.com/embed/kJQP7kiw9Fk',
                'gambar' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'https://www.youtube.com/embed/Z1BCujX3pw8',
                'gambar' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}