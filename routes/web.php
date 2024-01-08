<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterInputanController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\TaarufContoller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ROUTE TAMU/PENGGUNA TANPA LOGIN
Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.beranda');
    })->name('/');
    Route::get('/daftar', function () {
        return view('auth.daftar');
    })->name('daftar');
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/prosesdaftar', [AuthController::class, 'prosesdaftar']);
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
    Route::get('/masterkaryawan/verify/{token}', [MasterInputanController::class, 'verify'])->name('verify');
});
Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('authpanel.login');
    })->name('/panel');
    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});

// ROUTE AUTH
Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Profile
    Route::get('/profile', [DashboardController::class, 'profile']);
    Route::post('/profile/{email}/updateprofile', [DashboardController::class, 'updateprofile']);
    Route::post('/profile/{email}/updateprofile2', [DashboardController::class, 'updateprofile2']);
    Route::post('/profile/{email}/updateprofile3', [DashboardController::class, 'updateprofile3']);

    // Taaruf
    Route::get('/taaruf', [DashboardController::class, 'taaruf']);
    Route::get('/taaruf/{email}/lihatprofile', [TaarufContoller::class, 'lihatprofile']);
    Route::post('/taaruf/progressprofile', [TaarufContoller::class, 'progressprofile']);

    // Progress
    Route::get('/progress', [ProgressController::class, 'index']);
    Route::get('/like/{id}', [ProgressController::class, 'like'])->name('like');
    Route::get('/dislike/{id}', [ProgressController::class, 'dislike'])->name('dislike');

    // Chat
    Route::get('/chat/{id}', [ChatController::class, 'chat'])->name('chat');
    Route::post('/chat/{id}/store', [ChatController::class, 'store'])->name('store');
});


Route::middleware(['auth:user'])->group(function () {
    Route::get('/dashboardadmin', [DashboardAdminController::class, 'index'])->name('dashboardadmin');
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);
    Route::get('/masterkaryawan', [MasterInputanController::class, 'masterkaryawan'])->name('masterkaryawan');
    Route::get('/masterkaryawan/{id_karyawan}/verifikasi', [MasterInputanController::class, 'verifikasi'])->name('verifikasi');
});
