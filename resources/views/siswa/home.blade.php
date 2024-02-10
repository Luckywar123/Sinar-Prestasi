@extends('siswa_layouts.master')

@section('background')
    <img src="{{ asset('assets/background.png') }}" alt="Background Image">
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('assets/logo.png') }}" width="10%" height="10%" alt="Logo">
            </div>
            <div class="col-md-9">
                <h1 class="display-4 text-left font-weight-bold" style="color: #5DB6FA">Bimbingan Belajar</h1>
                <h2 class="text-left" style="color: #0F3077">Sinar Prestasi</h2>
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-md-12">
                <p class="h3 text-left" style="color: rgba(0, 0, 0, 0.87);">Sinar Prestasi menyediakan pelayanan pembelajaran untuk  membimbing murid meraih masa depan yang bersinar dengan lulus berbagai macam tes SKD dengan Skor tertinggi.</p>
            </div>
        </div>
        <div class="row mt-5 justify-content-end">
            <div class="col-md-3">
                <button type="button" class="btn btn-md rounded-pill px-4" style="background-color: #0F3077; color:#DFF8FD">Testimoni</button>
            </div>
        </div>
    </div>
@endsection
