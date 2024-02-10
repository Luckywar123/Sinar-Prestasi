<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimbingan Belajar Sinar Prestasi</title>
    <!-- Load Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Montserrat", sans-serif;
        }
        body, img {
            margin: 0;
            padding: 0;
        }
        .full-screen-image {
            height: calc(100vh - 56px); /* 56px adalah tinggi navbar */
            position: relative; /* Menjadikan posisi absolut konten di dalamnya */
        }
        .full-screen-image img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
        /* Konten di bagian tengah gambar */
        .content {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: black;
        }
    </style>
    @yield('style')
</head>
<body>

    @include('siswa_layouts.navbar')

    <div class="full-screen-image">
        @yield('background')

        <!-- Konten di bagian tengah gambar -->
        @yield('content')
    </div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
