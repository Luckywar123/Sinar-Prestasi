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
    <div class="content w-50">
        <div class="card mt-3 py-2" style="border-radius: 1rem">
            <div class="card-body px-5 py-3">
                <h3 class="card-title font-weight-bold my-5" style="color: #0F3077">Selamat Datang</h3>

                    <form>
                        <div class="form-group row mb-4">
                            <label for="id_pengguna" class="col-sm-3 col-form-label text-right">ID Pengguna</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-lg" id="id_pengguna" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label for="password" class="col-sm-3 col-form-label text-right">Password</label>
                            <div class="col-sm-9 mb-5">
                                <input type="password" class="form-control form-control-lg" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary form-control" style="background-color: #5DB6FA; color: #0F3077">Login</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>


    </div>
@endsection


