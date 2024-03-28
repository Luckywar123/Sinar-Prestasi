@extends('bimbel_layouts.master')

@section('content')
<div class="content w-75">
    <h2 class="text-left mb-lg-5" style="color: #0F3077">Latihan SKD</h2>
    <div class="d-flex align-items-center flex-column mb-3">
        <div class="p-2">
            <a href="/siswa/simulasi/TKP">
                <img src="{{ asset('assets/TKP.svg') }} "alt="TKP">
            </a>
        </div>
        <div class="p-2">
            <a href="/siswa/simulasi/TIU">
                <img src="{{ asset('assets/TIU.svg') }} "alt="TIU">
            </a>
        </div>
        <div class="p-2">
            <a href="/siswa/simulasi/TWK">
                <img src="{{ asset('assets/TWK.svg') }} "alt="TWK">
            </a>
        </div>
    </div>
</div>
@endsection
