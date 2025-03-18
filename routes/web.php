<?php

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalTestController;
use App\Http\Controllers\JadwalUserController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PendaftaranUserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NilaiPesertaController;
use Illuminate\Support\Facades\Route;

// Halaman utama (landing page)
Route::get('/', function () {
    return view('frontend.home'); // Mengarahkan ke frontend.home.blade.php
});

// Halaman home setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home'); // Rute untuk halaman home setelah login

Route::get('/', [HomeController::class, 'index']);

Route::get('/', [JadwalTestController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    // Dashboard untuk Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard untuk User
    Route::get('/dashboard-user', [DashboardUserController::class, 'index'])->name('dashboard.user');
});

Route::get('/data-peserta', [UserController::class, 'index'])->name('data-peserta');
Route::get('/nilai-peserta', [NilaiController::class, 'index'])->name('nilai-peserta');
Route::post('/nilai-peserta', [NilaiController::class, 'store'])->name('nilai-peserta.store');
Route::delete('/nilai-peserta', [NilaiController::class, 'destroy'])->name('nilai-peserta.destroy');
Route::put('/nilai-peserta', [NilaiController::class, 'update'])->name('nilai-peserta.update');
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
Route::get('/penjadwalan', [JadwalTestController::class, 'index'])->name('penjadwalan');
Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata');
Route::put('/biodata/{id}', [BiodataController::class, 'update'])->name('biodata.update');
Route::get('/jadwal-user', [JadwalUserController::class, 'index'])->name('jadwal-user');
Route::post('/jadwal-user', [JadwalUserController::class, 'showJadwalPeserta'])->name('jadwal-user');
Route::get('/jadwal-user', [JadwalUserController::class, 'showJadwalPeserta'])->name('jadwal-user');
Route::get('/jadwal-user/pendaftaran', [PendaftaranUserController::class, 'index'])->name('jadwal-user.pendaftaran');
Route::post('/pendaftaran', [PendaftaranUserController::class, 'store'])->name('pendaftaran.store');
Route::get('/cetak-kartu/{id}', [DashboardUserController::class, 'cetakKartu'])->name('cetak.kartu');


Route::post('/print-score', [JadwalUserController::class, 'printScore'])->name('print.score');
Route::get('/get-tanggal-test/{id_pendaftaran}', [NilaiController::class, 'getTanggalTest']);
Route::get('/user/tanggal-test', [JadwalUserController::class, 'tanggalTestUser'])->name('user.tanggal-test');
Route::post('/generate-certificate', [JadwalUserController::class, 'generateCertificate'])->name('generate.certificate');



// peserta
Route::middleware(['auth'])->group(function () {
    // Menampilkan daftar peserta
    Route::get('data-peserta', [UserController::class, 'index'])->name('data-peserta');

    // Form tambah peserta
    Route::get('data-peserta/create', [UserController::class, 'create'])->name('data-peserta.create');

    // Proses tambah peserta
    Route::post('data-peserta', [UserController::class, 'store'])->name('data-peserta.store');

    // Form edit peserta
    Route::get('data-peserta/{id}/edit', [UserController::class, 'edit'])->name('data-peserta.edit');

    // Proses update peserta
    Route::put('data-peserta/{id}', [UserController::class, 'update'])->name('data-peserta.update');

    // Proses hapus peserta
    Route::delete('data-peserta/{id}', [UserController::class, 'destroy'])->name('data-peserta.destroy');

    Route::post('data-peserta/import', [UserController::class, 'importExcelData']);
});


// jadwal
Route::middleware(['auth'])->group(function () {
    // Route untuk menampilkan daftar jadwal
    Route::get('/jadwal', [JadwalTestController::class, 'index'])->name('jadwal.index');

    // Route untuk menampilkan form tambah jadwal
    Route::get('/jadwal/create', [JadwalTestController::class, 'create'])->name('jadwal.create');

    // Route untuk menyimpan jadwal baru
    Route::post('/jadwal', [JadwalTestController::class, 'store'])->name('jadwal.store');

    // Route untuk menampilkan form edit jadwal
    Route::get('/jadwal/{id}/edit', [JadwalTestController::class, 'edit'])->name('jadwal.edit');

    // Route untuk memperbarui jadwal
    Route::put('/jadwal/{id}', [JadwalTestController::class, 'update'])->name('jadwal.update');

    // Route untuk menghapus jadwal
    Route::delete('/jadwal/{id}', [JadwalTestController::class, 'destroy'])->name('jadwal.destroy');
});

// managemen pendaftarn admin
Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::post('/pendaftaran/verifikasi/{id}', [PendaftaranController::class, 'verifikasi'])->name('pendaftaran.verifikasi');
    Route::get('pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::get('pendaftaran/{id}/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('pendaftaran/{id}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::delete('pendaftaran/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
});

// export
Route::get('data-peserta/export', [UserController::class, 'export']);
Route::get('pendaftaran/export', [PendaftaranController::class, 'exportPendaftar']);

//transaksi


Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');


// Rute untuk otentikasi (login/register)
Auth::routes();