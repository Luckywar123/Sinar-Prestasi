<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
        />
        <style>
            /* Custom styles */
            .full-screen-image {
                min-height: 100vh;
                background-image: url('/assets/background.png');
                background-size: cover;
            }
            /* Optional: Style scrollbar if visible */
            .scrollable-container {
                overflow-x: auto; /* Enable horizontal scrollbar */
                overflow-y: hidden; /* Hide vertical scrollbar */
                white-space: nowrap; /* Prevent text wrapping */
                scrollbar-width: none; /* Hide scrollbar for Firefox */
                -ms-overflow-style: none; /* Hide scrollbar for IE and Edge */
            }
            .card-container {
                width: 160%; /* Full width */
                display: flex;
                flex-wrap: nowrap; /* Ensure cards stay in a single row */
                padding-bottom: 1rem; /* Add padding to the bottom */
            }
            .card-testimoni {
                width: 440px; /* Set width of each card */
                border-radius: 15px; /* Rounded corners */
                margin-right: 2rem; /* Add margin between cards */
            }
            .card-body {
                padding: 1rem; /* Add padding inside card body */
            }
        </style>
        <title>Bimbingan Belajar Sinar Prestasi</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light py-3 px-5" style="background-color: #5DB6FA;">
            <div class="container-fluid">
                <a class="navbar-brand ml-auto" href="#">
                    <img src="{{ asset('assets/logo.png') }}" width="36" height="36" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-light" href="/home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="/testimoni">Testimoni</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="/konsultasi">Kontak</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-light" href="/login">Login</a> <!-- Tampilkan tautan login jika pengguna belum diautentikasi -->
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container-fluid full-screen-image">
            <!-- judul -->
            <div class="row justify-content-center align-items-center py-5">
                <div class="col-md-6 text-center">
                    <h1 class="fw-lighter fs-2">
                        <strong>Respon Positif</strong>
                        pengguna<br> Bimbel Sinar Prestasi
                    </h1>
                </div>
            </div>

            <!-- cardGuru -->
            <div class="scrollable-container">
                <div class="card-container ms-5">
                    <!-- Card 1 -->
                    <div class="card shadow card-testimoni px-4 py-4">
                        <div class="row g-0">
                            <div class="col-md-3 d-flex align-items-center">
                                <div class="rounded-circle overflow-hidden" style="width: 80px; height: 80px;">
                                    <img src="assets/testi_1.jpeg" class="img-fluid" alt="Testimonial Image">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold mb-1">Senda Adriansyah</h5>
                                    <p class="card-text mb-1" style="font-size: 12px; color: #565656;">Institut Pemerintahan Dalam Negeri (IPDN)</p>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <p class="card-text" style="font-size: 12px; color: #565656; text-align: justify; white-space: normal;">
                                    Dengan bimbel di Sinar Prestasi sangat membantu saya untuk memahami materi SKD,
                                    materi yang disampaikan oleh pengajar sangat mudah dipahami.
                                    Banyak diberikan soal-soal hots dan tryout setiap minggunya sehingga terbiasa dalam
                                    mengerjakan soal.<br>
                                    Terima kasih Sinar Prestasi!
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="card shadow card-testimoni px-4 py-4">
                        <div class="row g-0">
                            <div class="col-md-3 d-flex align-items-center">
                                <div class="rounded-circle overflow-hidden" style="width: 80px; height: 80px;">
                                    <img src="assets/testi_2.jpeg" class="img-fluid" alt="Testimonial Image">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold mb-1">Nandha Annisa S. Meyra</h5>
                                    <p class="card-text mb-1" style="font-size: 12px; color: #565656;">Institut Pemerintahan Dalam Negeri (IPDN)</p>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <p class="card-text" style="font-size: 12px; color: #565656; text-align: justify; white-space: normal;">
                                    Dalam hal pengajarannya bagus banget dengan cara pendekatan secara personal nya agar semua siswa nya menguasai semua materinya, setiap minggunya selalu di adain sistem cat untuk simulasi saat tes nanti sehingga kita bisa menilai sudah sejauh mana kesiapan dan kemampuan kita agar bisa di tingkatkan lebih lagi. Tentunya semua pengajarnya sangat ramah dan baikk, rate untuk belajar disini aku kasih 10000/10 pokonya gaakan ngerasain
                                    apa itu yang namanya takut gagal dan sebagainya karna selalu di beri motivasi dan dukungan. <br>
                                    Semoga bimbel sinar prestasi ini bisa selalu membantu bagi adik adik yang ingin melanjutkan pendidikannya di ikatan kedinasan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="card shadow card-testimoni px-4 py-4">
                        <div class="row g-0">
                            <div class="col-md-3 d-flex align-items-center">
                                <div class="rounded-circle overflow-hidden" style="width: 80px; height: 80px;">
                                    <img src="assets/testi_3.jpeg" class="img-fluid" alt="Testimonial Image">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold mb-1">Jerry Daryanto</h5>
                                    <p class="card-text mb-1" style="font-size: 12px; color: #565656;">Sekolah Tinggi Ilmu Pelayaran (STIP)</p>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <p class="card-text" style="font-size: 12px; color: #565656; text-align: justify; white-space: normal;">
                                    Selama saya mengikuti bimbel di Sinar Prestasi saya mendapatkan latihan-latihan soal dan pembelajaran yang sangat membantu saya untuk melewati tes yang akan di hadapi.
                                    <br>
                                    Bimbel cahaya prestasi adalah pilihan yang tepat untuk kalian mempersiapkan bergadung di sekolah kedinasan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 4 -->
                    <div class="card shadow card-testimoni px-4 py-4">
                        <div class="row g-0">
                            <div class="col-md-3 d-flex align-items-center">
                                <div class="rounded-circle overflow-hidden" style="width: 80px; height: 80px;">
                                    <img src="assets/testi_4.jpeg" class="img-fluid" alt="Testimonial Image">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold mb-1">Christian Simatupang</h5>
                                    <p class="card-text mb-1" style="font-size: 12px; color: #565656;">Institut Pemerintahan Dalam Negeri (IPDN)</p>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <p class="card-text" style="font-size: 12px; color: #565656; text-align: justify; white-space: normal;">
                                    Selama saya mengikuti bimbel di Sinar Prestasi, proses pembelajarannya sangat baik. Dengan mengedepankan kedisiplinan yang diterapkan di setiap kegiatan belajar mengajarnya menjadikan para siswa terbiasa untuk disiplin. Tutor yang mengajar memposisikan dirinya sebagai teman sekaligus kakak dari siswa dari siswa itu sendiri sehingga dalam proses pembelajaran menciptakan suasana yang nyaman sekaligus seru yang menjadikan siswa merasakan kenyamanan dan keleluasaan dalam proses diskusi materi sehingga efektif dalam mencapai tujuan kegiatan belajar mengajar.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Card 5 -->
                    <div class="card shadow card-testimoni px-4 py-4">
                        <div class="row g-0">
                            <div class="col-md-3 d-flex align-items-center">
                                <div class="rounded-circle overflow-hidden" style="width: 80px; height: 80px;">
                                    <img src="assets/testi_5.jpeg" class="img-fluid" alt="Testimonial Image">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold mb-1">Resti Sandya Dhita</h5>
                                    <p class="card-text mb-1" style="font-size: 12px; color: #565656;">Institut Pemerintahan Dalam Negeri (IPDN)</p>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <p class="card-text" style="font-size: 12px; color: #565656; text-align: justify; white-space: normal;">
                                    Belajar di bimbel Sinar Prestasi banyak membantu saya dalam proses belajar untuk mempersiapkan diri ikut serta seleksi masuk IPDN dan saya banyak mendapatkan motivasi baik dari teman teman maupun para pengelola bimbel yang rutin melaksanakan sesi sharing dengan kami. <br>
                                    Semoga bimbel Sinar Prestasi dapat terus mengembangkan program pembelajaran untuk membantu para calon praja meraih mimpinya.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- iklan -->
            <div class="row" style="padding-top: 2rem; padding-left: 5rem; padding-right: 5rem">
                <div class="my-2">
                    <h style="font-size: 28px">
                        Daftar sekarang untuk meraih masa depan yang bersinar dengan
                        belajar intensif bersama
                        <strong style="color: #0f3077">
                            Bimbingan Belajar Sinar Prestasi
                        </strong>
                    </h>
                    <br />
                </div>
                <a href="/konsultasi" style="color: #1c4b8f; font-size: 20px; text-decoration: none; margin-top:2px">
                    Klik untuk konsultasi
                </a>
            </div>
            <!-- daftar -->
            <div class="row pb-4" style="display: flex; justify-content: center; align-items: center; padding: 1rem;">
                <div class="text-center my-2">
                    <a type="button"
                        class="btn btn-primary fw-bold fs-5"
                        href="https://docs.google.com/forms/d/e/1FAIpQLScDAND_JFMC5sk5jG38xGo3gdJkYVCyqlYW_5-0hjEaZxR4_A/viewform?usp=sf_link"
                        target="_blank"
                        style="font-size: 24px; width: 252px; border-radius: 20px; background-color: #2F6BB3"
                    >
                        Daftar
                    </a><br />
                </div>
                <h class="fw-normal fs-4 text-center">Get Free Simulasi Test</h>
            </div>
        </div>
        <!-- judul -->
        <div class="container-fluid" style="background-color: #d9d9d9; width: 100%; height: 4rem">
            <!-- judul -->
            <div style="display: flex; justify-content: center;">
                <div style="width: 24rem; text-align: center; margin-top: 20px;">
                    <h class="fw-bolder fs-4" style="color: #0f3077;">Alumni Sinar Prestasi</h>
                </div>
            </div>
        </div>
        <!-- daftar alumni -->
        <div class="container-fluid" style="background-color: #d9d9d9;"">
            <div class="row justify-content-center">
                <div class="col-lg-2 mb-4 mt-4 mx-2">
                    <div class="card shadow" style="background-color: #5DB6FA; border: 0">
                        <img src="assets/testi_1.jpeg" class="card-img-top img-fluid" alt="Testimonial Image" style="object-fit: cover; height: 250px;">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Senda Adriansyah</h5>
                            <p class="card-text">IPDN</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mb-4 mt-4 mx-2">
                    <div class="card shadow" style="background-color: #5DB6FA; border: 0">
                        <img src="assets/testi_2.jpeg" class="card-img-top img-fluid" alt="Testimonial Image" style="object-fit: cover; height: 250px;">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Lucy Irta</h5>
                            <p class="card-text">IPDN</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mb-4 mt-4 mx-2">
                    <div class="card shadow" style="background-color: #5DB6FA; border: 0">
                        <img src="assets/testi_3.jpeg" class="card-img-top img-fluid" alt="Testimonial Image" style="object-fit: cover; height: 250px;">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Refal Fadly</h5>
                            <p class="card-text">STIP</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mb-4 mt-4 mx-2">
                    <div class="card shadow" style="background-color: #5DB6FA; border: 0">
                        <img src="assets/testi_4.jpeg" class="card-img-top img-fluid" alt="Testimonial Image" style="object-fit: cover; height: 250px;">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Refal Fadly</h5>
                            <p class="card-text">IPDN</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-2 mb-4 mt-4 mx-2">
                    <div class="card shadow" style="background-color: #5DB6FA; border: 0">
                        <img src="assets/testi_5.jpeg" class="card-img-top img-fluid" alt="Testimonial Image" style="object-fit: cover; height: 250px;">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Resti Sandya Dhita</h5>
                            <p class="card-text">IPDN</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mb-4 mt-4 mx-2">
                    <div class="card shadow" style="background-color: #5DB6FA; border: 0">
                        <img src="assets/testi_1.jpeg" class="card-img-top img-fluid" alt="Testimonial Image" style="object-fit: cover; height: 250px;">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Senda Adriansyah</h5>
                            <p class="card-text">IPDN</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mb-4 mt-4 mx-2">
                    <div class="card shadow" style="background-color: #5DB6FA; border: 0">
                        <img src="assets/testi_2.jpeg" class="card-img-top img-fluid" alt="Testimonial Image" style="object-fit: cover; height: 250px;">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Lucy Irta</h5>
                            <p class="card-text">IPDN</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mb-4 mt-4 mx-2">
                    <div class="card shadow" style="background-color: #5DB6FA; border: 0">
                        <img src="assets/testi_3.jpeg" class="card-img-top img-fluid" alt="Testimonial Image" style="object-fit: cover; height: 250px;">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Refal Fadly</h5>
                            <p class="card-text">STIP</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
    ></script>
</html>
