@extends('admin_layouts.master')

@section('page_title')
    Tambah Data Guru
@endsection

@section('content')


<div class="row">
    <div class="col-12 mb-4 align-items-center">
        <h2 class="text-center my-2 fw-semibold" style="color: #0F3077">Tambah Data Guru</h2>
        <hr style="width: 32%; margin:auto; ">
    </div>

    <div class="col-12">
        <div class="card rounded-5 mt-3 py-2" style="border-radius: 1rem">
            <div class="card-body px-5 py-4">
                <form action="{{route('simpanDataGuru')}}" method="POST" id="formTambahGuru">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="full_name" class="col-sm-2 col-form-label text-right">Nama Lengkap <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control" id="full_name" name="full_name" placeholder="Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="email" class="col-sm-2 col-form-label text-right">Email <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="username" class="col-sm-2 col-form-label text-right">Username <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control" id="username" name="username" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="password" class="col-sm-2 col-form-label text-right">Password <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="konfirmasiPassword" class="col-sm-2 col-form-label text-right">Konfirmasi Password <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control form-control" id="konfirmasiPassword" name="konfirmasiPassword" placeholder="Konfirmasi Password" required>
                            <div id="passwordMismatch" class="text-danger" style="display: none;">Password tidak sesuai</div>
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <div class="col-sm-4">
                            <button type="reset" class="btn btn-secondary form-control">Reset</button>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary form-control" style="background-color: #5DB6FA; color: #0F3077; border-color:#5DB6FA">Simpan</button>
                        </div>
                        <div class="col-sm-4">
                            <a class="btn btn-warning form-control" href="/admin/list-data-guru">Kembali</a>
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
        document.getElementById('konfirmasiPassword').addEventListener('input', function(event) {
            var password = document.getElementById('password').value;
            var konfirmasiPassword = event.target.value;
            var passwordMismatch = document.getElementById('passwordMismatch');

            if (password !== konfirmasiPassword) {
                passwordMismatch.style.display = 'block';
            } else {
                passwordMismatch.style.display = 'none';
            }
        });
    </script>
@endpush
