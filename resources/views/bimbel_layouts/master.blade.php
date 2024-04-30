<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimbingan Belajar Sinar Prestasi</title>
    <!-- Favicon -->
    <link href="{{ asset('assets/favicon.png') }}" rel="icon" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Montserrat", sans-serif;
        }

        body,
        img {
            margin: 0;
            padding: 0;
        }

        .full-screen-image {
            height: calc(100vh - 56px);
            /* 56px adalah tinggi navbar */
            position: relative;
            /* Menjadikan posisi absolut konten di dalamnya */
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

        body {
            background-color: #D9D9D9;
        }

        .navbar-nav .nav-link {
            color: #0F3077 !important;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
        }
    </style>
    @yield('style')
</head>

<body>

    @include('bimbel_layouts.navbar')

    <div class="full-screen-image">
        @yield('background')

        <!-- Konten di bagian tengah gambar -->
        @yield('content')
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Memeriksa perubahan status collapse navbar
        document.addEventListener('DOMContentLoaded', function() {
            var navbarCollapse = document.getElementById('navbarSupportedContent');
            var dropdownItem = document.querySelector('.navbar-nav .dropdown');
            var listItem1Added = false; // Menyimpan status apakah item sudah ditambahkan

            navbarCollapse.addEventListener('show.bs.collapse', function() {
                // Cek apakah item sudah ditambahkan sebelumnya
                if (!listItem1Added) {
                    // Tambahkan item yang ingin ditampilkan hanya saat navbar collapse
                    var navbarList = document.querySelector('.navbar-nav.ms-auto');
                    var listItem1 =
                        '<li class="nav-item"><a class="nav-link" href="/siswa/ubah-profil/<?php echo auth()->user()->user_id; ?>">Ubah Profil</a></li>';
                    navbarList.insertAdjacentHTML('beforeend', listItem1);
                    listItem1Added = true; // Tandai bahwa item sudah ditambahkan
                }
                // Sembunyikan dropdown saat navbar collapse dibuka
                if (dropdownItem) {
                    dropdownItem.style.display = 'none';
                }
            });

            navbarCollapse.addEventListener('hide.bs.collapse', function() {
                // Tampilkan kembali dropdown saat navbar collapse tertutup
                if (dropdownItem) {
                    dropdownItem.style.display = 'block';
                }
                // Hapus item yang hanya ditampilkan saat navbar collapse
                var navbarList = document.querySelector('.navbar-nav.ms-auto');
                var listItemToRemove = navbarList.querySelector(
                'li:last-child'); // Menemukan elemen yang ingin dihapus
                if (listItemToRemove) { // Memastikan elemen ditemukan sebelum menghapus
                    navbarList.removeChild(listItemToRemove);
                    listItem1Added = false; // Tandai bahwa item sudah dihapus
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
