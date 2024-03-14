@extends('siswa_layouts.master')

@section('background')
    <img src="{{ asset('assets/background.png') }}" alt="Background Image">
@endsection

@section('content')
    <div class="content mt-5">
        <div class="row align-items-center">
            <div class="col-md-2">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" style="width: 100px; height: 100px" class="img-fluid">
            </div>
            <div class="col-md-10">
                <h1 class="display-5 text-start fw-bold" style="color: #5DB6FA">Bimbingan Belajar</h1>
                <p class="lead text-start fw-bold" style="color: #0F3077">Sinar Prestasi</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <p class="text-left" style="color: rgba(0, 0, 0, 0.87);">
                    Bimbingan Belajar Sinar Prestasi merupakan lembaga pendidikan yang secara khusus untuk persiapan seleksi
                    masuk sekolah kedinasan. Adapun sekolah kedinasan yang diampu adalah sekolah kedinasan yang menjadikan
                    Seleksi Kompetensi Dasar atau Computer Assisted Test sebagai salah satu materi seleksi yang diujikan yaitu
                    Test Wawasan Kebangsaan, Tes Intelejensi Umum, dan Tes Karakteristik Pribadi.
                </p>
                <p class="text-left" style="color: rgba(0, 0, 0, 0.87);">
                    Berbeda dengan lembaga pendidikanlain yang hanya menyajikan akademik sebagai bahan ajar utamanya,
                    Bimbingan Belajar Sinar Prestasi mebimbing siswa dan siswi dari mulau SKD/TKD, Konsultasi Kesehatan,
                    Psikologi, dan Kesempatan. Maka, Bimbingan Sinar Prestasi menjadikan One Stop Preparation Course
                    yang memadukan bimbingan untuk semua jenis tes yang diujikan dengan standar kompetensi yang sesuai
                    dengan kebutuhan.
                </p>
                <p class="text-left" style="color: rgba(0, 0, 0, 0.87);">
                    Untuk mendukung proses pelaksanaan belajar dan mengajar agar maksimal, Bimbingan Belajar Sinar Prestasi
                    telah menyediakan asrama, dengan adanya asrama menjadikan siswa dan siswa lebih fokus dalam latihan dan belajar.
                    Lalu, Bimbingan Belajar Sinar Prestasi dilengkapi degan metode pembelajaran yang modern serta pengajar yang
                    berkompeten dibidangnya lulusan Top Five Universitas di Indonesia.
                </p>
            </div>
        </div>
        <div class="row mt-2 justify-content-end">
            <div class="col-md-3">

                <a href="/testimoni" class="btn btn-md rounded-pill px-4" style="background-color: #0F3077; color:#DFF8FD">Testimoni</a>
            </div>
        </div>
    </div>
@endsection
