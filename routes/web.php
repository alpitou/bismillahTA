<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SakitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardDomController;
use App\Http\Controllers\DashboardUsaController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TugasController;

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

// Rute untuk akses Inspektur dengan grup middleware
Route::middleware(['auth', 'role:Inspektur'])->group(function () {
    Route::resource('/pegawai', PegawaiController::class); // Menambah, menghapus, memperbarui informasi pegawai
    Route::resource('/surat', SuratController::class); // Kelola berkas surat jalan dan izin
    Route::resource('/komentar', KomentarController::class); // Kelola komentar pada laporan
    Route::resource('/dokumen', DokumenController::class); // Kelola dokumen pegawai
});

// Rute untuk pegawai (hapus rute duplikasi sebelumnya)
Route::resource('/pegawai', PegawaiController::class)->middleware('auth');

// Rute untuk Domisili
Route::get('/dashboard/domisili/{domisili:noSurat}/cetak', [DashboardDomController::class, 'cetak'])->middleware('auth');
Route::resource('/dashboard/domisili', DashboardDomController::class)->middleware('auth');

// Rute untuk Usaha
Route::get('/dashboard/usaha/{usaha:noSurat}/cetak', [DashboardUsaController::class, 'cetak'])->middleware('auth');
Route::resource('/dashboard/usaha', DashboardUsaController::class)->middleware('auth');

// Rute untuk komentar pada tugas
Route::prefix('dashboard/tugas/{tugas_id}')->group(function () {
    Route::get('/komentar', [KomentarController::class, 'index'])->name('tugas.komentar.index');
    Route::post('/komentar', [KomentarController::class, 'store'])->name('tugas.komentar.store');
    Route::get('/komentar/{id}/edit', [KomentarController::class, 'edit'])->name('tugas.komentar.edit');
    Route::put('/komentar/{id}', [KomentarController::class, 'update'])->name('tugas.komentar.update');
    Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])->name('tugas.komentar.destroy');
});

// Rute Komentar pada Domisili
Route::prefix('dashboard/domisili/{domisili_id}')->group(function () {
    Route::get('/komentar', [KomentarController::class, 'index'])->name('komentar.index');
    Route::post('/komentar', [KomentarController::class, 'store'])->name('komentar.store');
    Route::get('/komentar/{id}/edit', [KomentarController::class, 'edit'])->name('komentar.edit');
    Route::put('/komentar/{id}', [KomentarController::class, 'update'])->name('komentar.update');
    Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])->name('komentar.destroy');
});

// Rute Komentar
Route::post('/dashboard/domisili/{noSurat}/komentar', [KomentarController::class, 'store']);
Route::post('/dashboard/usaha/{noSurat}/komentar', [KomentarController::class, 'storeKomentar']);
Route::post('/dashboard/sakits/{noSurat}/komentar', [KomentarController::class, 'storeKomentarSakit']);

// Rute Laporan
Route::resource('/dashboard/laporan', LaporanController::class)->middleware('auth');
Route::get('/dashboard/laporan/{laporan}/cetak', [LaporanController::class, 'cetak'])->middleware('auth');

// Rute Sakit
Route::resource('/dashboard/sakit', SakitController::class)->middleware('auth');
Route::get('/dashboard/sakit/{sakit}/cetak', [SakitController::class, 'cetak'])->middleware('auth');
Route::get('/dashboard/sakits', [SakitController::class, 'index'])->name('sakits.index');


// Rute untuk Tugas
Route::resource('/dashboard/tugas', TugasController::class)->middleware('auth');
Route::get('/dashboard/tugas/{tugas}/cetak', [TugasController::class, 'cetak'])->middleware('auth');