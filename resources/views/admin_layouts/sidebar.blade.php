<div class="sidebar text-white px-4">
    <img src="{{ asset('assets/sidebar.png') }}" alt="Logo">
    <ul class="nav flex-column">
        @if (auth()->user()->role == 'Admin Soal')
            <li class="nav-item">
                <a class="nav-link active" href="/admin/list-data-guru">Data Guru</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/list-data-soal">Data Soal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/tambah-data-soal">Tambah Soal</a>
            </li>
        @elseif (auth()->user()->role == 'Guru')
            <li class="nav-item">
                <a class="nav-link active" href="/guru/recap-data-siswa">Recap Siswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/guru/list-data-siswa">Data Siswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/guru/data-statistik">Statistika</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/guru/tambah-data-siswa">Daftar Siswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/guru/list-data-token">Data Token</a>
            </li>
        @endif
    </ul>
</div>
