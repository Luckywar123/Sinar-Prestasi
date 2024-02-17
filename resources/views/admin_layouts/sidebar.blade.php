<div class="sidebar text-white px-4">
    <img src="{{ asset('assets/sidebar.png') }}" alt="Logo">
    <ul class="nav flex-column">
        @if(auth()->user()->role == "Admin Soal")
        <li class="nav-item">
            <a class="nav-link active" href="/admin/list-data-guru">Data Guru</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/admin/tambah-data-soal">Tambah Soal</a>
        </li>
        @elseif (auth()->user()->role == "Guru")
        <li class="nav-item">
            <a class="nav-link active" href="#">Recap Siswa</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Data Siswa</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Statistika</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Daftar Siswa</a>
        </li>
        @endif

    </ul>
</div>
