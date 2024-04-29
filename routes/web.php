<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminSoalController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;

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
    return view('siswa.home');
});

//Login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('siswa/home');
});

Route::get('/konsultasi', function () {
    return view('siswa/konsultasi');
});

Route::get('/testimoni', function () {
    return view('testimoni');
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

        Route::get('simulasi/{category}', [SiswaController::class, 'startSimulasi'])->name('startSimulasi');
        Route::post('simpan-jawaban-simulasi/{exam_answer_id}', [SiswaController::class, 'simpanJawabanSimulasi'])->name('simpanJawabanSimulasi');
        Route::post('selesai-simulasi', [SiswaController::class, 'selesaiSimulasi'])->name('selesaiSimulasi');

        Route::post('start-test', [SiswaController::class, 'startTest'])->name('startTest');

        Route::get('after-test/{exam_id}', [SiswaController::class, 'afterTest'])->name('afterTest');
        Route::get('score/{exam_id}', [SiswaController::class, 'scoreTest'])->name('scoreTest');
        Route::get('hasil-test/{exam_id}', [SiswaController::class, 'hasilTest'])->name('hasilTest');

        Route::get('ubah-profil/{user_id}', [SiswaController::class, 'ubahProfil'])->name('ubahProfil');
        Route::patch('update-profile/{student_id}', [SiswaController::class, 'updateProfil'])->name('updateProfil');

        Route::get('riwayat-test', [SiswaController::class, 'riwayatTest'])->name('riwayatTest');
        Route::post('download-soal', [SiswaController::class, 'downloadSoal'])->name('downloadSoal');
        Route::get('print-soal', [SiswaController::class, 'printSoal'])->name('printSoal');
    });

    Route::prefix('guru')->group(function () {
        Route::get('list-data-siswa', [GuruController::class, 'listDataSiswa'])->name('listDataSiswa');
        Route::get('tambah-data-siswa', [GuruController::class, 'tambahDataSiswa'])->name('tambahDataSiswa');
        Route::post('simpan-data-siswa', [GuruController::class, 'simpanDataSiswa'])->name('simpanDataSiswa');
        Route::get('detail-data-siswa/{student_id}', [GuruController::class, 'detailDataSiswa'])->name('detailDataSiswa');
        Route::get('delete-data-siswa/{student_id}', [GuruController::class, 'deleteDataSiswa'])->name('deleteDataSiswa');

        Route::get('recap-data-siswa', [GuruController::class, 'recapDataSiswa'])->name('recapDataSiswa');

        Route::get('get-guru-token', [GuruController::class, 'getToken'])->name('getToken');
        Route::post('generate-new-token', [GuruController::class, 'generateToken'])->name('generateToken');

        Route::get('data-statistik', [GuruController::class, 'dataStatistik'])->name('dataStatistik');

        Route::get('print-statistik', [GuruController::class, 'printStatistik'])->name('printStatistik');

        Route::get('filter-by-month', [GuruController::class, 'filterRecap'])->name('filter-by-month');
    });
});
