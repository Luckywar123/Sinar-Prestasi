@extends('siswa_layouts.master')

@section('style')
    <style>
        .img-opacity {
            opacity: 1;
            /* Atur nilai opacity sesuai keinginan Anda, 0.0 hingga 1.0 */
        }
        .bg-image {
            /* Mengatur gambar latar belakang untuk memenuhi lebar dan tinggi layar */
            background-size: cover;
            background-position: center;
            /* Set tinggi layar sesuai dengan perangkat */
            height: 100vh;
        }
    </style>
@endsection

@section('background')
    <img src="{{ asset('assets/background2.jpeg') }}" alt="Background Image" class="bg-image bg-dark img-fluid img-opacity">
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12"> <!-- Ubah class card menjadi col-md-6 -->
                <div class="card rounded-5 mt-3 py-2">
                    <div class="card-body px-5 py-3">
                        <h3 class="card-title font-weight-bold my-5" style="color: #0F3077">Selamat Datang</h3>

                        <form id="formAuthentication" action="{{ route('authenticate') }}" method="POST">
                            @csrf
                            <div class="form-group row mb-4"> <!-- Tambahkan class row di sini -->
                                <label for="username" class="col-md-5 col-form-label text-right text-dark">ID Pengguna</label> <!-- Ubah class col-3 menjadi col-md-5 -->
                                <div class="col-md-7"> <!-- Ubah class col-4 menjadi col-md-7 -->
                                    <input type="text" class="form-control" id="username"
                                        name="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group row mb-4"> <!-- Tambahkan class row di sini -->
                                <label for="password" class="col-md-5 col-form-label text-right text-dark">Password</label> <!-- Ubah class col-3 menjadi col-md-5 -->
                                <div class="col-md-7"> <!-- Ubah class col-4 menjadi col-md-7 -->
                                    <input type="password" class="form-control" id="password"
                                        name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-primary form-control"
                                    style="background-color: #5DB6FA; color: #0F3077">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
