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

        <div class="row mt-5">
            <div class="col-12 my-2">
                <span id="token-Simulasi" class="mx-2">Token CAT :</span>
            </div>
            <div class="col-12">
                <button class="mx-2 btn btn-sm btn-warning" onclick="regenerateToken('Simulasi', 'token-Simulasi')" style="background-color: #5DB6FA; color: #FFFFFF; border-color:#5DB6FA">Regenerate Token</button>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 my-2">
                <span id="token-Download" class="mx-2">Token Download:</span>
            </div>
            <div class="col-12">
                <button class="mx-2 btn btn-sm btn-warning" onclick="regenerateToken('Download', 'token-Download')" style="background-color: #5DB6FA; color: #FFFFFF; border-color:#5DB6FA">Regenerate Token</button>
            </div>
        </div>


        @endif
    </ul>
</div>
