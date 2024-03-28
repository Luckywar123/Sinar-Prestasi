@extends('admin_layouts.master')

@section('page_title')
    Tambah Data Soal
@endsection

@section('content')


<div class="row">
    <div class="col-12 mb-4 align-items-center">
        <h2 class="text-center my-2 fw-semibold" style="color: #0F3077">Tambah Data Soal</h2>
        <hr style="width: 32%; margin:auto; ">
    </div>

    <div class="col-12">
        <div class="card rounded-5 mt-3 py-2" style="border-radius: 1rem">
            <div class="card-body px-5 py-4">
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
                <form action="{{route('simpanDataSoal')}}" method="POST" id="formTambahSoal">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="category" class="col-sm-2 col-form-label text-right">{{ __('Jenis Soal') }} <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category" id="category">
                                <option value="" selected disabled hidden>Pilih Jenis Soal</option>
                                <option value="TKP">Tes Karakteristik Pribadi (TKP)</option>
                                <option value="TIU">Tes Intelegensia Umum (TIU)</option>
                                <option value="TWK">Tes Wawancara Kebangsaan (TWK)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="sub_category" class="col-sm-2 col-form-label text-right">{{ __('Sub Soal') }} <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-control" name="sub_category" id="sub_category">
                                <option value="" selected disabled hidden>Pilih Sub Soal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="simulasi" class="col-sm-2 col-form-label text-right">{{ __('Tipe Ujian') }} <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exam_type" id="simulasi" value="Simulasi">
                                <label for="simulasi" class="form-check-label" for="simulasi">Simulasi</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exam_type" id="test" value="Test">
                                <label for="test" class="form-check-label" for="test">Test</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary form-control" style="background-color: #5DB6FA; color: #0F3077; border-color:#5DB6FA">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('category').addEventListener('change', function() {
        var category = this.value;
        var subcategorySelect = document.getElementById('sub_category');

        // Hapus semua opsi subkategori
        subcategorySelect.innerHTML = '<option value="" selected disabled hidden>Pilih Sub Soal</option>';

        // Tambahkan opsi subkategori berdasarkan kategori yang dipilih
        if (category === 'TKP') {
            addSubcategoryOptions(['Pelayanan Publik', 'Jejaring Kerja', 'Sosial Budaya', 'Teknologi Informasi', 'Profesionalisme', 'Anti Radikalisme']);
        } else if (category === 'TWK') {
            addSubcategoryOptions(['Nasionalisme', 'Integritas', 'Bela Negara', 'Pilar Negara', 'Bahasa Indonesia']);
        } else if (category === 'TIU') {
            addSubcategoryOptions(['Analogi', 'Silogisme', 'Analitis', 'Perbandingan', 'Numerik', 'Deret', 'Ketidaksamaan', 'Serial']);
        }
    });

    function addSubcategoryOptions(subcategories) {
        var subcategorySelect = document.getElementById('sub_category');
        subcategories.forEach(function(subcategory) {
            var option = document.createElement('option');
            option.text = subcategory;
            option.value = subcategory;
            subcategorySelect.add(option);
        });
    }
</script>

@endpush
