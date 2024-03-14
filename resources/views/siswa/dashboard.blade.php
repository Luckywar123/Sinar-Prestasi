@extends('bimbel_layouts.master')

@section('content')
<div class="content w-75">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <a href="/siswa/simulasi">
                <img src="{{ asset('assets/Simulasi.svg') }}" alt="Logo Full" width="50">
            </a>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <a href="/siswa/test">
                <img src="{{ asset('assets/Test.svg') }}" alt="Logo Full" width="50">
            </a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tokenModal" tabindex="-1" aria-labelledby="tokenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="submit-token-form" action="{{route('startTest')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tokenModalLabel">Masukkan Token</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="tokenInput" name="token" placeholder="Masukkan Token" maxlength="6" value="{{ old('token') }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="kirimBtn">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan kode untuk menampilkan pesan error -->
@if(session('error'))
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Validasi Token</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ session('error') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function(){
        $('#errorModal').modal('show');
    });
</script>
@endpush
@endif
@endsection
