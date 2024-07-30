<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MakulController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('page.login');
});

Route::get('/login', function () {
    return view('page.login');
});


Auth::routes();

Route::get('/register', function () {
    return abort(404);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/fakultas', [FakultasController::class, 'index'])->name('fakultas');
    Route::post('/fakultas', [FakultasController::class, 'store'])->name('fakultas.store');
    Route::post('/fakultas/storejurusan', [FakultasController::class, 'storeJurusan'])->name('fakultas.storejurusan');
    Route::delete('/fakultas/{id}/delete', [FakultasController::class, 'destroy'])->name('fakultas.destroy');


    Route::get('/data-dosen', [UserController::class, 'dosen'])->name('data-dosen');
    Route::post('/data-dosen', [UserController::class, 'dosen_store'])->name('dosen.store');
    Route::get('/data-mahasiswa', [UserController::class, 'mahasiswa'])->name('data-mahasiswa');
    Route::post('/data-mahasiswa', [UserController::class, 'mahasiswa_store'])->name('mahasiswa.store');
    Route::put('/data-mahasiswa/update/{id}', [UserController::class, 'mahasiswa_update'])->name('mahasiswa.update');

    Route::resource('makul', MakulController::class);
    Route::resource('user', UserController::class);

    Route::resource('qrcode', QrcodeController::class);
    Route::post('/qrcode', [QrcodeController::class, 'generate'])->name('qrcode.generate');
    Route::get('/scanpage', [QrcodeController::class, 'scanpage'])->name('scanpage');
    Route::post('/scanqrcode', [QrcodeController::class, 'scanqrcode'])->name('scanqrcode');

    Route::get('/riwayatabsensi', [AbsensiController::class, 'riwayatabsensi'])->name('riwayatabsensi');
    Route::get('/daftarabsensi', [AbsensiController::class, 'daftarabsensi'])->name('daftarabsensi');
    Route::get('/listabsen/{id}', [AbsensiController::class, 'listabsen'])->name('listabsen');

    Route::get('/profil/{id}', [UserController::class, 'profil'])->name('profil');
    Route::put('/profil/update/{id}', [UserController::class, 'profil_update'])->name('profil.update');
    // Route::get('/profil{id}', [UserController::class, 'profil'])->name('profil');
});
