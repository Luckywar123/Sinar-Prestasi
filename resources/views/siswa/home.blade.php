@extends('siswa_layouts.master')

@section('background')
    <div class="container-fluid p-0">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-block w-100 bg-image text-opacity-25"" style="background-image: url('{{ asset('assets/background2.jpeg') }}');"></div>
                </div>
                <div class="carousel-item">
                    <div class="d-block w-100 bg-image text-opacity-25"" style="background-image: url('{{ asset('assets/background3.jpeg') }}');"></div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-md-2 col-sm-12 ">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="img-fluid">
            </div>
            <div class="col-md-10 col=sm-12">
                <h1 class="display-4 text-start fw-bold outlined-text" style="color: #5DB6FA;">Bimbingan Belajar</h1>
                <p class="lead text-start fw-bold display-6" style="color: #0F3077">Sinar Prestasi</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <p class="text-start" style="color: rgba(0, 0, 0, 1); font-size: 1.1rem;">
                    Bimbingan Belajar Sinar Prestasi merupakan lembaga pendidikan yang secara khusus untuk persiapan seleksi
                    masuk sekolah kedinasan. Adapun sekolah kedinasan yang diampu adalah sekolah kedinasan yang menjadikan
                    Seleksi Kompetensi Dasar atau Computer Assisted Test sebagai salah satu materi seleksi yang diujikan
                    yaitu
                    Test Wawasan Kebangsaan, Tes Intelejensi Umum, dan Tes Karakteristik Pribadi.
                </p>
                <p class="text-start" style="color: rgba(0, 0, 0, 1); font-size: 1.1rem;">
                    Berbeda dengan lembaga pendidikan lain yang hanya menyajikan akademik sebagai bahan ajar utamanya,
                    Bimbingan Belajar Sinar Prestasi mebimbing siswa dan siswi dari mulai SKD/TKD, Konsultasi Kesehatan,
                    Psikologi, dan Kesempatan. Maka, Bimbingan Sinar Prestasi menjadikan One Stop Preparation Course
                    yang memadukan bimbingan untuk semua jenis tes yang diujikan dengan standar kompetensi yang sesuai
                    dengan kebutuhan.
                </p>
                <p class="text-start" style="color: rgba(0, 0, 0, 1); font-size: 1.1rem;">
                    Untuk mendukung proses pelaksanaan belajar dan mengajar agar maksimal, Bimbingan Belajar Sinar Prestasi
                    telah menyediakan asrama, dengan adanya asrama menjadikan siswa dan siswi lebih fokus dalam latihan dan
                    belajar.
                    Lalu, Bimbingan Belajar Sinar Prestasi dilengkapi degan metode pembelajaran yang modern serta pengajar
                    yang
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

    <style>
        .outlined-text {
            text-stroke: 1px #87CEFA;
            -webkit-text-stroke: 1px #87CEFA;
            -moz-text-stroke: 1px #87CEFA;
            color: black;
        }

        .bg-image {
            height: 100vh; /* Sesuaikan tinggi gambar dengan tinggi layar */
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .container {
            position: relative;
            z-index: 1; /* Pastikan konten tampil di atas gambar */
        }
    </style>
@endsection
