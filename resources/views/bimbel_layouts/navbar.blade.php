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
                @if(Request::is('siswa/simulasi/*')) <!-- Jika URL cocok dengan pola 'simulasi/*' -->
                    <li class="nav-item">
                        <p class="nav-link text-light" >
                            <i class="fas fa-stopwatch me-2" style="color: #DFF8FD; font-size: 20px;"></i>
                            <span id="timer" class="fw-semibold" style="color: #DFF8FD; font-size: 20px;">
                            </span>
                        </p>
                    </li>
                    <li class="nav-item">
                        <p class="nav-link">
                            <span class="fw-semibold" style="color: #DFF8FD; font-size: 20px;">
                                <?php echo auth()->user()->full_name ?>
                            </span>
                        </p>
                    </li>
                @else
                    <li class="nav-item active"> <!-- Jika tidak cocok, tampilkan seperti biasa -->
                        <a class="nav-link text-light" href="/siswa/home">Score</span></a>
                    </li>
                    <li class="nav-item mr-2">
                        <a class="nav-link text-light" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-lg fa-user-circle me-2"></i>My Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                {{-- <a href="javasript:void(0)">Ubah Profil</a> --}}
                                Ubah Profil
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
