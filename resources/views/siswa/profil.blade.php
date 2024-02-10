@extends('siswa_layouts.master')

@section('style')
    <style>
        body{
            background-color: #D9D9D9;
        }
    </style>
@endsection

@section('content')
    <div class="content w-50">
        <div class="card mt-3 py-2" style="border-radius: 1.5rem">
            <div class="card-body px-5 py-3">
                <div class="row d-flex align-items-center">
                    <div class="col-4">
                        <img style="width: 100px; height: 100px" class="rounded-circle" src="https://via.placeholder.com/100x100" />
                    </div>
                    <div class="col-8 text-left ml-n5">
                        <h4 class="card-title font-weight-bold mb-0" style="color: #0F3077">Refal Purnama Putra</h5>
                        <p style="color: #565656">RefalPurnama@gmail.com</p>
                        <span style="color: #565656">
                            <i class="fas fa-edit mr-2"></i> Edit Foto Profil
                        </span>
                    </div>
                </div>

                <form class="mt-5">
                    <div class="form-group mb-4 text-left">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control form-control-md text-dark" id="alamat" placeholder="Alamat" style="background-color: #D9D9D9; opacity: 70%;">
                    </div>

                    <div class="form-group mb-4 text-left">
                        <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-control form-control-md text-dark" id="nama_sekolah" placeholder="Nama Sekolah" style="background-color: #D9D9D9; opacity: 70%;">
                    </div>

                    <div class="form-group row mt-5">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary form-control" style="background-color: #5DB6FA; color: #0F3077">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection


