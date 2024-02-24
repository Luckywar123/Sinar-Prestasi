@extends('bimbel_layouts.master')

@section('content')
<div class="content w-75">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <a href="/siswa/simulasi">
                <img src="{{ asset('assets/simulasi.svg') }}" alt="Logo Full" width="50">
            </a>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <a href="/siswa/test">
                <img src="{{ asset('assets/test.svg') }}" alt="Logo Full" width="50">
            </a>
        </div>
    </div>
</div>
@endsection
