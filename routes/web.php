<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardDomController;
use App\Http\Controllers\DashboardUsaController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\PegawaiController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->middleware('guest');
    Route::post('/register', 'store');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
// Route::get('/dashboard/cetak_pdf', [DashboardController::class, 'cetak_pdf'])->middleware('auth');
Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index'); Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create'); Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store'); Route::get('/pegawai/{id}', [PegawaiController::class, 'show'])->name('pegawai.show'); Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit'); Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update'); Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

Route::get('/dashboard/domisili/{domisili:noSurat}/cetak', [DashboardDomController::class, 'cetak'])->middleware('auth');
Route::get('/dashboard/usaha/{usaha:noSurat}/cetak', [DashboardUsaController::class, 'cetak'])->middleware('auth');
Route::resource('/dashboard/domisili', DashboardDomController::class)->middleware('auth');
Route::resource('/dashboard/usaha', DashboardUsaController::class)->middleware('auth');

// Route::get('/dashboard/domisili/cetak_pdf', [DashboardDomController::class, 'cetak_pdf'])->middleware('auth');
// Rute untuk halaman khusus Inspektur
Route::get('/inspektur', function () {
    // Halaman khusus Inspektur
})->middleware('role:Inspektur');

// Rute untuk halaman khusus Ketua Tim
Route::get('/ketua-tim', function () {
    // Halaman khusus Ketua Tim
})->middleware('role:Ketua Tim');

// Rute untuk halaman khusus Pegawai
Route::get('/pegawai', function () {
    // Halaman khusus Pegawai
})->middleware('role:Pegawai');

// Rute untuk akses Inspektur
Route::middleware(['auth', 'role:Inspektur'])->group(function () {
    Route::resource('/pegawai', PegawaiController::class); // Menambah, menghapus, memperbarui informasi pegawai
    Route::resource('/surat', SuratController::class); // Kelola berkas surat jalan dan izin
    Route::resource('/komentar', KomentarController::class); // Kelola komentar pada laporan
    Route::resource('/dokumen', DokumenController::class); // Kelola dokumen pegawai
});

Route::prefix('dashboard/domisili/{domisili_id}')->group(function () {
    Route::get('/komentar', [KomentarController::class, 'index'])->name('komentar.index');
    Route::post('/komentar', [KomentarController::class, 'store'])->name('komentar.store');
    Route::get('/komentar/{id}/edit', [KomentarController::class, 'edit'])->name('komentar.edit');
    Route::put('/komentar/{id}', [KomentarController::class, 'update'])->name('komentar.update');
    Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])->name('komentar.destroy');
});
