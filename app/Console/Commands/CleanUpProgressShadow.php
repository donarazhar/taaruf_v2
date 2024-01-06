<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanUpProgressShadow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-up-progress-shadow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Hitung waktu 2 jam yang lalu
        $twoHoursAgo = Carbon::now()->subHours(2);

        // Hapus data yang lebih tua dari 2 jam dari tabel progress_shadow
        DB::table('progress_shadow')->where('created_at', '<', $twoHoursAgo)->delete();

        $this->info('Data progress_shadow yang lebih tua dari 2 jam telah dihapus.');
    }
}
