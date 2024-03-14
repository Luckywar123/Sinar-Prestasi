@extends('admin_layouts.master')

@section('page_title')
    Detail Data Siswa
@endsection

@section('content')


<div class="row">
    <div class="col-4 mb-5" style="border: 1px solid #0F3077;">
        <h4 class="text-center my-2" style="color: #0F3077">Detail Data Siswa</h4>
    </div>

    <div class="col-12">
        <div class="card rounded-5 mt-3 py-2" style="border-radius: 1rem">
            <div class="card-body px-5 py-4">
                <div class="form-group row mb-4">
                    <div class="col-sm-12 text-center">
                        @if (!empty($student->profile_image_url))
                            <img class="rounded-circle" style="width: 200px; height: 200px; border-radius: 50%;" src="{{ asset('storage/' . $student->profile_image_url) }}" />
                        @else
                            <img class="rounded-circle" style="width: 200px; height: 200px; border-radius: 50%;" src="{{ asset('storage/profile_image/placeholder.jpeg') }}" /">
                        @endif
                    </div>
                </div>


                <div class="form-group row mb-4">
                    <label for="full_name" class="col-sm-2 col-form-label text-right">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control" id="full_name" name="full_name" value="{{ $student->user->full_name }}" disabled>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="email" class="col-sm-2 col-form-label text-right">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control form-control" id="email" name="email" value="{{ $student->user->email }}" disabled>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="username" class="col-sm-2 col-form-label text-right">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control" id="username" name="username" value="{{ $student->user->username }}" disabled>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="student_number" class="col-sm-2 col-form-label text-right">Nomor Peserta</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control" id="student_number" name="student_number" value="{{ $student->student_number }}" disabled>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="birth_place" class="col-sm-2 col-form-label text-right">Tempat Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control" id="birth_place" name="birth_place" value="{{ $student->birth_place }}" disabled>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="birth_date" class="col-sm-2 col-form-label text-right">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control" id="birth_date" name="birth_date" value="{{ $student->birth_date }}" disabled>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="gender" class="col-sm-2 col-form-label text-right">{{ __('Jenis Kelamin') }}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control" id="gender" name="gender" value="{{ $student->gender }}" disabled>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="Gender" class="col-sm-2 col-form-label text-right">{{ __('Alamat') }}</label>
                    <div class="col-sm-10">
                        <textarea name="address" id="address" rows="2" class="form-control" disabled>{{ $student->address }}</textarea>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="school_name" class="col-sm-2 col-form-label text-right">{{ __('Nama Sekolah') }}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control" id="school_name" name="school_name" value="{{ $student->school_name }}" disabled>
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <div class="col-sm-12">
                        <a href="/guru/list-data-siswa">
                            <button type="button" class="btn btn-primary form-control" style="background-color: #A6A6A6; border-color:#5DB6FA">Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
