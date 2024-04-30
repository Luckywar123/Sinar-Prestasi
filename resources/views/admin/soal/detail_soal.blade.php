@extends('admin_layouts.master')

@section('page_title')
    Tambah Detail Soal
@endsection

@section('content')

<div class="row">
    <div class="col-12 mb-4 align-items-center">
        <h2 class="text-center my-2 fw-semibold" style="color: #0F3077">Tambah Detail Soal</h2>
        <hr style="width: 32%; margin:auto; ">
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    <div class="col-12">
        <form action="/admin/simpan-detail-soal/" method="POST" id="formDetailSoal" enctype="multipart/form-data">
            @csrf
            <div class="card rounded-5 mt-3 py-2" style="border-radius: 1rem">
                <div class="card-body px-5 py-4">
                    <div class="form-group row mb-4">
                        <div class="col-12 ">
                            <img id="previewImage" src="#" alt="Preview" style="display: none; width: max-width; height: 200px">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-sm-12">
                            <textarea class="form-control" style="border: none; resize: none; outline: none;" rows="5" placeholder="Ketik di sini.." id="textarea" name="question_text" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-md-2 ms-auto">
                            <button type="button" class="btn btn-primary form-control" style="background-color: #5DB6FA; color: #0F3077; border-color:#5DB6FA" id="inputGambarBtn">Input Gambar</button>
                            <input type="file" id="gambarInput" name="gambar" style="display: none;" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card rounded-5 mt-3 py-2" style="border-radius: 1rem">
                <div class="card-body px-5 py-4">
                    <div class="form-group row mb-4">
                        <label for="textOption" class="form-label col-sm-2">Pilihan Jawaban:</label>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inputType" id="textOption" value="text" checked>
                                <label class="form-check-label" for="textOption">
                                    Text
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inputType" id="imageOption" value="image">
                                <label class="form-check-label" for="imageOption">
                                    Gambar
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 ms-auto">
                            <button type="button" class="btn btn-primary form-control" style="background-color: #5DB6FA; color: #0F3077; border-color:#5DB6FA" id="tambahJawabanBtn">Tambah Jawaban</button>
                        </div>
                    </div>

                    <div id="jawabanSection">
                        <!-- Konten jawaban dinamis akan ditambahkan di sini -->
                    </div>
                    <div class="form-group row mb-4">

                    </div>
                    <input type="hidden" id="selectedOption" name="selectedOption" value="text"> <!-- Input hidden untuk menyimpan nilai radio button yang dipilih -->
                    <div class="form-group row mt-5">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary form-control" style="background-color: #5DB6FA; color: #0F3077; border-color:#5DB6FA">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        // Event listener untuk tombol "Input Gambar"
        document.getElementById('inputGambarBtn').addEventListener('click', function() {
            // Memicu klik pada input file tersembunyi saat tombol diklik
            document.getElementById('gambarInput').click();
        });

        // Event listener untuk input file
        document.getElementById('gambarInput').addEventListener('change', function() {
            // Mendapatkan gambar yang dipilih oleh pengguna
            var selectedFile = this.files[0];

            // Membuat objek URL untuk gambar yang dipilih
            var imageURL = URL.createObjectURL(selectedFile);

            // Menampilkan gambar sebagai preview
            var previewImage = document.getElementById('previewImage');
            previewImage.src = imageURL;
            previewImage.style.display = 'block';
        });
    </script>
    <script>
        var jumlahJawaban = 0;

        // Fungsi untuk menonaktifkan atau mengaktifkan radio button pilihan jawaban
        function toggleRadioButtons(disabled) {
            var radioButtons = document.querySelectorAll('input[type="radio"][name="inputType"]');
            radioButtons.forEach(function(radioButton) {
                radioButton.disabled = disabled;
            });
        }

        // Event listener untuk tombol "Tambah Jawaban"
        document.getElementById('tambahJawabanBtn').addEventListener('click', function() {
            if (jumlahJawaban < 5) { // Periksa apakah jumlah jawaban masih kurang dari 5
                var jawabanSection = document.getElementById('jawabanSection');
                var inputType = document.querySelector('input[name="inputType"]:checked').value;

                // Buat elemen form dinamis sesuai dengan pilihan inputType
                var newJawaban = document.createElement('div');
                newJawaban.classList.add('form-group', 'row', 'mb-4');

                if (inputType === 'text') {
                    newJawaban.innerHTML = `
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Ketik pilihan ganda di sini .." id="textJawaban${jumlahJawaban}" name="textJawaban${jumlahJawaban}" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" placeholder="Score" id="score${jumlahJawaban}" name="score${jumlahJawaban}" required>
                        </div>
                        <div class="col-md-1">
                            <button type="button" onclick="hapusJawaban(event)" class="btn btn-danger form-control hapusJawabanBtn">Hapus</button>
                        </div>
                    `;
                } else if (inputType === 'image') {
                    newJawaban.innerHTML = `
                        <div class="col-md-8">
                            <input type="file" class="form-control" accept="image/*" id="imageJawaban${jumlahJawaban}" name="imageJawaban${jumlahJawaban}" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" placeholder="Score" id="score${jumlahJawaban}" name="score${jumlahJawaban}" required>
                        </div>
                        <div class="col-md-1">
                            <button type="button" onclick="hapusJawaban(event)" class="btn btn-danger form-control hapusJawabanBtn">Hapus</button>
                        </div>
                    `;
                }

                jawabanSection.appendChild(newJawaban);

                jumlahJawaban++; // Tambahkan jumlah jawaban

                // Sembunyikan tombol "Tambah Jawaban" jika jumlah jawaban mencapai batas
                if (jumlahJawaban >= 5) {
                    document.getElementById('tambahJawabanBtn').style.display = 'none';
                }

                // Nonaktifkan radio button jika jumlah jawaban lebih dari 1
                if (jumlahJawaban > 0) {
                    toggleRadioButtons(true);
                }
            }
        });

        // Fungsi untuk menghapus jawaban
        function hapusJawaban(event) {
            event.target.parentNode.parentNode.remove();
            jumlahJawaban--; // Kurangi jumlah jawaban saat menghapus
            // Tampilkan kembali tombol "Tambah Jawaban" jika jumlah jawaban kurang dari 5 setelah penghapusan
            if (jumlahJawaban < 5) {
                document.getElementById('tambahJawabanBtn').style.display = 'block';
            }
            // Aktifkan kembali radio button jika jumlah jawaban menjadi 0
            if (jumlahJawaban === 0) {
                toggleRadioButtons(false);
            }
        }

        // Event listener untuk radio button "Pilihan Jawaban"
        document.querySelectorAll('input[type="radio"][name="inputType"]').forEach(function(radioButton) {
            radioButton.addEventListener('change', function() {
                document.getElementById('selectedOption').value = this.value; // Set nilai input hidden sesuai dengan radio button yang dipilih
            });
        });
    </script>


@endpush
