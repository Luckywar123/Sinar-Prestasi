@extends('admin_layouts.master')

@section('page_title')
    Ubah Data Soal
@endsection

@section('content')
    <div class="row">
        <div class="col-12 mb-4 align-items-center">
            <h2 class="text-center my-2 fw-semibold" style="color: #0F3077">Ubah Data Soal</h2>
            <hr style="width: 32%; margin:auto; ">
        </div>

        <div class="col-12">
            <form action="/admin/update-data-soal/{{ $question->question_id }}" method="POST" id="formDetailSoal"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card rounded-5 mt-3 py-2" style="border-radius: 1rem">
                    <div class="card-body px-5 py-4">
                        <div class="form-group row mb-4">
                            <label for="category" class="col-sm-2 col-form-label text-right">{{ __('Jenis Soal') }} <span
                                    style="color: red">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-control" name="category" id="category" required>
                                    <option value="TKP" @if ($question->category == 'TKP') selected @endif>Tes
                                        Karakteristik Pribadi (TKP)</option>
                                    <option value="TWK" @if ($question->category == 'TWK') selected @endif>Tes Wawancara
                                        Kebangsaan (TWK)</option>
                                    <option value="TIU" @if ($question->category == 'TIU') selected @endif>Tes
                                        Intelegensia Umum (TIU)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="sub_category" class="col-sm-2 col-form-label text-right">{{ __('Sub Soal') }} <span
                                    style="color: red">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-control" name="sub_category" id="sub_category" required>
                                    <option value="" selected disabled hidden>Pilih Sub Soal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card rounded-5 mt-3 py-2" style="border-radius: 1rem">
                    <div class="card-body px-5 py-4">
                        <div class="form-group row mb-4">
                            <div class="col-12 ">
                                @if ($question->question_image_url != null)
                                    <img id="previewImage" src="{{ asset('storage/' . $question->question_image_url) }}"
                                        alt="Preview" style="display: block; width: max-width; height: 200px">
                                @else
                                    <img id="previewImage" src="#" alt="Preview"
                                        style="display: none; width: max-width; height: 200px">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-sm-12">
                                <textarea class="form-control" style="border: none; resize: none; outline: none;" rows="5"
                                    placeholder="Ketik di sini.." id="question_text" name="question_text">{{ $question->question_text }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-md-2 ms-auto">
                                <button type="button" class="btn btn-primary form-control"
                                    style="background-color: #5DB6FA; color: #0F3077; border-color:#5DB6FA"
                                    id="ubahGambarBtn">
                                    @if ($question->question_image_url != null)
                                        Ubah Gambar
                                    @else
                                        Input Gambar
                                    @endif
                                </button>
                                <input type="file" id="gambarInput" name="gambar" style="display: none;"
                                    accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card rounded-5 mt-3 py-2" style="border-radius: 1rem">
                    <div class="card-body px-5 py-4">
                        @foreach ($question->answer as $answer)
                            @if ($answer->answer_image_url != null)
                                <img id="previewAnswer{{ $answer->answer_id }}"
                                    src="{{ asset('storage/' . $answer->answer_image_url) }}" alt="Preview"
                                    style="display: block; width: max-width; height: 200px">
                                {{-- <span class="text-warning">Gunakan form di bawah hanya jika ada </span> --}}
                                <div class="form-group row mb-4">
                                    <input type="hidden">
                                    <div class="col-md-10">
                                        <input type="file" class="form-control" accept="image/*"
                                            id="imageJawaban{{ $answer->answer_id }}"
                                            name="imageJawaban{{ $answer->answer_id }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" placeholder="Score"
                                            id="score{{ $answer->answer_id }}" value="{{ $answer->answer_score }}"
                                            name="score{{ $answer->answer_id }}" required>
                                    </div>
                                </div>
                            @else
                                <div class="form-group row mb-4">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="textJawaban{{ $answer->answer_id }}"
                                            name="textJawaban{{ $answer->answer_id }}" value="{{ $answer->answer_text }}"
                                            required>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control" id="score{{ $answer->answer_id }}"
                                            name="score{{ $answer->answer_id }}" value="{{ $answer->answer_score }}"
                                            required>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <input type="hidden" id="selectedOption" name="selectedOption" value="text">
                        <!-- Input hidden untuk menyimpan nilai radio button yang dipilih -->
                        <div class="form-group row mt-5">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary form-control"
                                    style="background-color: #5DB6FA; color: #0F3077; border-color:#5DB6FA">Simpan</button>
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
        document.getElementById('ubahGambarBtn').addEventListener('click', function() {
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

        document.querySelectorAll('[id^=imageJawaban]').forEach(function(inputElement) {
            inputElement.addEventListener('change', function() {
                // Mendapatkan gambar yang dipilih oleh pengguna
                var selectedFile = this.files[0];

                // Membuat objek URL untuk gambar yang dipilih
                var imageURL = URL.createObjectURL(selectedFile);

                // Menemukan elemen gambar yang sesuai berdasarkan ID
                var previewAnswerID = 'previewAnswer' + this.id.substr('imageJawaban'.length);
                var previewAnswer = document.getElementById(previewAnswerID);

                // Menampilkan gambar sebagai preview
                previewAnswer.src = imageURL;
                previewAnswer.style.display = 'block';
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var categorySelect = document.getElementById('category');
            var subcategorySelect = document.getElementById('sub_category');

            // Atur nilai awal subkategori berdasarkan kategori yang telah terpilih saat halaman dimuat
            updateSubcategoryOptions(categorySelect.value);

            // Tambahkan event listener untuk perubahan nilai pada input kategori
            categorySelect.addEventListener('change', function() {
                var category = this.value;
                updateSubcategoryOptions(category);
            });

            function updateSubcategoryOptions(category) {
                // Hapus semua opsi subkategori
                subcategorySelect.innerHTML ='<option value="" selected disabled hidden>Pilih Sub Soal</option>';

                // Tambahkan opsi subkategori berdasarkan kategori yang dipilih
                if (category === 'TKP') {
                    addSubcategoryOptions(['Pelayanan Publik', 'Jejaring Kerja', 'Sosial Budaya',
                        'Teknologi Informasi',
                        'Profesionalisme', 'Anti Radikalisme'
                    ]);
                } else if (category === 'TWK') {
                    addSubcategoryOptions(['Nasionalisme', 'Integritas', 'Bela Negara', 'Pilar Negara',
                        'Bahasa Indonesia'
                    ]);
                } else if (category === 'TIU') {
                    addSubcategoryOptions(['Analogi', 'Silogisme', 'Analitis', 'Perbandingan', 'Numerik',
                        'Deret',
                        'Ketidaksamaan', 'Serial'
                    ]);
                }

                if(category === "{{ $question->sub_category }}") {
                    // Set nilai awal terpilih untuk subkategori berdasarkan nilai $question->sub_category
                    subcategorySelect.value = "{{ $question->sub_category }}";
                }
            }

            function addSubcategoryOptions(subcategories) {
                subcategories.forEach(function(subcategory) {
                    var option = document.createElement('option');
                    option.text = subcategory;
                    option.value = subcategory;
                    subcategorySelect.add(option);
                });
            }
        });
    </script>

    {{-- <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            license_key: 'gpl',
            plugins: 'autolink lists link image charmap preview anchor pagebreak',
            toolbar: 'undo redo copy paste| styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
            menubar: false,
            autosave_ask_before_unload: false,
            height: 300,
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            hidden_input: false
        });
    </script> --}}
@endpush
