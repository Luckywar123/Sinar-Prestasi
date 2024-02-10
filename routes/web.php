<?php

use Illuminate\Support\Facades\Route;

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
});
