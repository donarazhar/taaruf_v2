<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
        return view('dashboard.beranda');
    })->name('/');
    Route::get('/daftar', function () {
        return view('dashboard.daftar');
    })->name('daftar');
    Route::get('/login', function () {
        return view('dashboard.login');
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);
});
