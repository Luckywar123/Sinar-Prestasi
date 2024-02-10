@extends('siswa_layouts.master')

@section('style')
    <style>
        .img-opacity {
            opacity: 1; /* Atur nilai opacity sesuai keinginan Anda, 0.0 hingga 1.0 */
        }
    </style>
@endsection

@section('background')
    <img src="{{ asset('assets/background.png') }}" alt="Background Image" class="bg-dark img-opacity">
@endsection

@section('content')
    <div class="content w-75">
        <div class="row mt-5">
            <div class="col-4">
                <img src="{{ asset('assets/logo_full.png') }} "alt="Logo Full" width="50">
            </div>
        </div>

        <div class="card rounded-5 mt-3">
            <div class="card-body px-5 pt-5">
                <form>
                    <div class="form-group row mb-4">
                        <label for="nama" class="col-sm-2 col-form-label text-right">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-lg" id="nama" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="email" class="col-sm-2 col-form-label text-right">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control form-control-lg" id="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="phone" class="col-sm-2 col-form-label text-right">Nomor Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-lg" id="phone" placeholder="Nomor Phone">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-sm-2 col-form-label text-right">Jenis Kelamin</label>
                        <div class="col-sm-10 d-flex">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenisKelamin" id="lakiLaki" value="option1">
                                <label class="form-check-label" for="lakiLaki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenisKelamin" id="perempuan" value="option2">
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="password" class="col-sm-2 col-form-label text-right">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control form-control-lg" id="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="konfirmasiPassword" class="col-sm-2 col-form-label text-right">Konfirmasi Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control form-control-lg" id="konfirmasiPassword" placeholder="Konfirmasi Password">
                        </div>
                    </div>
                    <div class="form-group row mt-5">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary form-control" style="background-color: #5DB6FA; color: #0F3077">Daftar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


