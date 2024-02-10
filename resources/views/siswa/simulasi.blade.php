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
    <h1 class="text-left mb-2" style="color: #0F3077">Simulasi SKD</h5>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 my-1">
            <img src="{{ asset('assets/TKP.svg') }} "alt="TKP">
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <img src="{{ asset('assets/TIU.svg') }} "alt="TIU">
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 my-1">
            <img src="{{ asset('assets/TWK.svg') }} "alt="TWK">
        </div>
    </div>
</div>
@endsection
