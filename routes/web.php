<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
    Route::post('/prosesdaftar', [AuthController::class, 'prosesdaftar']);
});
Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.login');
    })->name('loginuser');
    Route::post('/prosesloginuser', [AuthController::class, 'prosesloginuser']);
});

// ROUTE AUTH
Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [DashboardController::class, 'profile']);
    Route::get('/taaruf', [DashboardController::class, 'taaruf']);
    Route::get('/progress', [DashboardController::class, 'progress']);
    Route::post('/profile/{email}/updateprofile', [DashboardController::class, 'updateprofile']);
    Route::post('/profile/{email}/updateprofile2', [DashboardController::class, 'updateprofile2']);
    Route::post('/profile/{email}/updateprofile3', [DashboardController::class, 'updateprofile3']);

    // Taaruf
    Route::get('/taaruf/{email}/lihatprofile', [TaarufContoller::class, 'lihatprofile']);
    Route::post('/taaruf/progressprofile', [TaarufContoller::class, 'progressprofile']);
});
