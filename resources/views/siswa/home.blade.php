@extends('siswa_layouts.master')

@section('background')
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <div class="image-container">

            <div class="carousel-item active">
                <img src="{{ asset('assets/background2.jpeg') }}" class="d-block w-100 img-opacity" alt="Background Image 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/background3.jpeg') }}" class="d-block w-100 img-opacity" alt="Background Image 3">
            </div>
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
<style>
    .img-opacity {
        opacity: 0.55; /* opacity / transparation */
    }

    .image-container {
        width: 2500px; /* Set container width */
        height: 2000px; /* Set container height */
        overflow: hidden; /* Ensure image doesn't overflow */
    }

    .image-container img {
        width: 100%; /* Make image fill container */
        height: 100%; /* Make image fill container */
        object-fit: cover; /* Maintain aspect ratio and cover entire container */
    }

</style>

@endsection

@section('content')
    <div class="content mt-5" style ="padding-top: 250px; position: absolute;">
        <div class="row align-items-center">
            <div class="col-md-2 ">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" style="width: 100px; height: 100px" class="img-fluid">
            </div>
            <div class="col-md-10 ">
            <h1 class="display-4 text-start fw-bold outlined-text" style="color: #5DB6FA; text-shadow: 2px 2px 4px #000000;">Bimbingan Belajar</h1>
            <p class="lead text-start fw-bold display-6" style="color: #0F3077">Sinar Prestasi</p>
            </div>
        </div>

    <div class="row mt-4">
        <div class="col-md-12">
        <p class="text-left" style="color: rgba(0, 0, 0, 1); font-size: 1.1rem; text-align: justify; "> <!-- Menambahkan properti font-size: 1.2rem; untuk memperbesar tulisan -->
            Bimbingan Belajar Sinar Prestasi merupakan lembaga pendidikan yang secara khusus untuk persiapan seleksi
            masuk sekolah kedinasan. Adapun sekolah kedinasan yang diampu adalah sekolah kedinasan yang menjadikan
            Seleksi Kompetensi Dasar atau Computer Assisted Test sebagai salah satu materi seleksi yang diujikan yaitu
            Test Wawasan Kebangsaan, Tes Intelejensi Umum, dan Tes Karakteristik Pribadi.
        </p>
        <p class="text-left" style="color: rgba(0, 0, 0, 1); font-size: 1.1rem;text-align: justify;"> <!-- Sama seperti di atas, menambahkan properti font-size: 1.2rem; untuk memperbesar tulisan -->
            Berbeda dengan lembaga pendidikan lain yang hanya menyajikan akademik sebagai bahan ajar utamanya,
            Bimbingan Belajar Sinar Prestasi mebimbing siswa dan siswi dari mulau SKD/TKD, Konsultasi Kesehatan,
            Psikologi, dan Kesempatan. Maka, Bimbingan Sinar Prestasi menjadikan One Stop Preparation Course
            yang memadukan bimbingan untuk semua jenis tes yang diujikan dengan standar kompetensi yang sesuai
            dengan kebutuhan.
        </p>
        <p class="text-left" style="color: rgba(0, 0, 0, 1); font-size: 1.1rem;text-align: justify;"> <!-- Sama seperti di atas, menambahkan properti font-size: 1.2rem; untuk memperbesar tulisan -->
            Untuk mendukung proses pelaksanaan belajar dan mengajar agar maksimal, Bimbingan Belajar Sinar Prestasi
            telah menyediakan asrama, dengan adanya asrama menjadikan siswa dan siswa lebih fokus dalam latihan dan belajar.
            Lalu, Bimbingan Belajar Sinar Prestasi dilengkapi degan metode pembelajaran yang modern serta pengajar yang
            berkompeten dibidangnya lulusan Top Five Universitas di Indonesia.
        </p>
        </div>
    </div>

        <div class="row mt-2 justify-content-end">
            <div class="col-md-3 col-12"> <!-- Ubah menjadi 12 kolom pada perangkat seluler -->

                <a href="/testimoni" class="btn btn-md rounded-pill px-4" style="background-color: #0F3077; color:#DFF8FD">Testimoni</a>
            </div>
        </div>
    </div>

    <style>
        .outlined-text {
            text-stroke: 1px #87CEFA; /* Warna biru muda untuk garis di dalam huruf */
            -webkit-text-stroke: 1px #87CEFA; /* Untuk browser yang menggunakan prefiks vendor -webkit- */
            -moz-text-stroke: 1px #87CEFA; /* Untuk browser yang menggunakan prefiks vendor -moz- */
            color: black; /* Warna teks */
        }
    </style>
@endsection
