<nav class="navbar navbar-expand-lg navbar-light py-3 px-5" style="background-color: #5DB6FA;">
    <div class="container-fluid">
        <a class="navbar-brand ml-auto" href="#">
            <img src="{{ asset('assets/logo.png') }}" width="36" height="36" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item active">
                    <a class="nav-link text-light" href="/siswa/home">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Testimoni</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/siswa/login">Login</a> <!-- Tampilkan tautan login jika pengguna belum diautentikasi -->
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
