<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminSoalController;
use App\Http\Controllers\SiswaController;

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
    return view('bimbel_layouts.master');
});

//Login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('siswa/home');
});

Route::get('/daftar', function () {
    return view('siswa/daftar');
});

Route::get('/konsultasi', function () {
    return view('siswa/konsultasi');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('list-data-guru', [AdminSoalController::class, 'listDataGuru'])->name('listDataGuru');
        Route::get('tambah-data-guru', [AdminSoalController::class, 'tambahDataGuru'])->name('tambahDataGuru');
        Route::post('simpan-data-guru', [AdminSoalController::class, 'simpanDataGuru'])->name('simpanDataGuru');
        Route::get('ubah-data-guru/{user_id}', [AdminSoalController::class, 'ubahDataGuru'])->name('ubahDataGuru');
        Route::patch('update-data-guru/{user_id}', [AdminSoalController::class, 'updateDataGuru'])->name('updateDataGuru');
        Route::get('delete-data-guru/{user_id}', [AdminSoalController::class, 'deleteDataGuru'])->name('deleteDataGuru');

        Route::get('tambah-data-soal', [AdminSoalController::class, 'tambahDataSoal'])->name('tambahDataSoal');
        Route::post('simpan-data-soal', [AdminSoalController::class, 'simpanDataSoal'])->name('simpanDataSoal');
        Route::get('tambah-detail-soal/{question_id}', [AdminSoalController::class, 'tambahDetailSoal'])->name('tambahDetailSoal');
        Route::patch('simpan-detail-soal/{question_id}', [AdminSoalController::class, 'simpanDetailSoal'])->name('simpanDetailSoal');
    });

    Route::prefix('siswa')->group(function () {
        Route::get('dashboard', [SiswaController::class, 'goToDashboard'])->name('goToDashboard');
        Route::get('simulasi', [SiswaController::class, 'goToSimulasi'])->name('goToSimulasi');
        Route::get('test', [SiswaController::class, 'goToTest'])->name('goToTest');

        Route::get('simulasi/{category}', [SiswaController::class, 'startSimulasi'])->name('startSimulasi');
        Route::post('simpan-jawaban-simulasi/{exam_answer_id}', [SiswaController::class, 'simpanJawabanSimulasi'])->name('simpanJawabanSimulasi');
        Route::post('selesai-simulasi', [SiswaController::class, 'selesaiSimulasi'])->name('selesaiSimulasi');

        Route::get('after-test/{exam_id}', [SiswaController::class, 'afterTest'])->name('afterTest');
        Route::get('score/{exam_id}', [SiswaController::class, 'scoreTest'])->name('scoreTest');
        Route::get('hasil-test/{exam_id}', [SiswaController::class, 'hasilTest'])->name('hasilTest');

        Route::get('/nilai', function () {
            return view('siswa/nilai');
        });

        Route::get('/profil', function () {
            return view('siswa/profil');
        });
    });

    Route::prefix('guru')->group(function () {
        Route::get('/rekap', function () {
            return view('guru/rekap');
        });

        Route::get('/data', function () {
            return view('guru/data');
        });

        Route::get('/statistik', function () {
            return view('guru/statistik');
        });
    });
});
