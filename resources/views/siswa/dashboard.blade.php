@extends('siswa_layouts.master')

@section('style')
    <style>
        body{
            background-color: #D9D9D9;
        }
    </style>
@endsection

@section('content')
<div class="content w-75">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <img src="{{ asset('assets/simulasi.svg') }} "alt="Logo Full" width="50">
        </div>
        <div class="col-lg-6  col-md-12 col-sm-12">
            <img src="{{ asset('assets/test.svg') }} "alt="Logo Full" width="50">
        </div>
    </div>
</div>
@endsection
