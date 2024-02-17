<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminSoalController;

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
    return view('welcome');
});

//Login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('list-data-guru', [AdminSoalController::class, 'listDataGuru'])->name('listDataGuru');
        Route::get('tambah-data-guru', [AdminSoalController::class, 'tambahDataGuru'])->name('tambahDataGuru');
        Route::post('simpan-data-guru', [AdminSoalController::class, 'simpanDataGuru'])->name('simpanDataGuru');
        Route::get('ubah-data-guru/{user_id}', [AdminSoalController::class, 'ubahDataGuru'])->name('ubahDataGuru');
        Route::patch('update-data-guru/{user_id}', [AdminSoalController::class, 'updateDataGuru'])->name('updateDataGuru');
        Route::get('delete-data-guru/{user_id}', [AdminSoalController::class, 'deleteDataGuru'])->name('deleteDataGuru');

    });

    Route::prefix('siswa')->group(function () {
        Route::get('/home', function () {
            return view('siswa/home');
        });

        Route::get('/daftar', function () {
            return view('siswa/daftar');
        });

        Route::get('/konsultasi', function () {
            return view('siswa/konsultasi');
        });

        Route::get('/login', function () {
            return view('siswa/login');
        });

        Route::get('/dashboard', function () {
            return view('siswa/dashboard');
        });

        Route::get('/simulasi', function () {
            return view('siswa/simulasi');
        });

        Route::get('/latihan', function () {
            return view('siswa/latihan');
        });

        Route::get('/after-test', function () {
            return view('siswa/after_test');
        });

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
