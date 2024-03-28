@extends('bimbel_layouts.master')

@section('content')
    <div class="row my-4 justify-content-center">
        <div class="col-lg-8">
            <div class="card rounded-5 mt-3 py-2">
                <div class="card-body px-5 py-4">
                    <form action="/siswa/update-profile/{{ $student_data->student->student_id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                        <div class="form-group row mb-4">
                            <div class="col-sm-12 text-center">
                                <!-- Preview image dengan fungsi hover dan klik -->
                                <div class="image-container" style="position: relative; display: inline-block;">
                                @if (!empty($student_data->student->profile_image_url))
                                    <img id="profileImage" class="rounded-circle" style="width: 200px; height: 200px; border-radius: 50%;" src="{{ asset('storage/' . $student_data->student->profile_image_url) }}" />
                                @else
                                    <img id="profileImage" class="rounded-circle" style="width: 200px; height: 200px; border-radius: 50%;" src="{{ asset('storage/profile_image/placeholder.jpeg') }}" />
                                @endif
                                <!-- Ikon pensil untuk edit -->
                                <div id="editIcon" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); visibility: hidden;">
                                    <i class="fas fa-pencil-alt fa-lg" style="color: #007bff; cursor: pointer;"></i>
                                </div>
                                </div>
                                <!-- Input file untuk upload gambar (hidden) -->
                                <input type="file" id="uploadProfileImage" name="profile_image" style="display: none;">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="full_name" class="col-sm-2 col-form-label text-right">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" id="full_name" name="full_name" value="{{ $student_data->full_name }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="email" class="col-sm-2 col-form-label text-right">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control" id="email" name="email" value="{{ $student_data->email }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="username" class="col-sm-2 col-form-label text-right">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" id="username" name="username" value="{{ $student_data->username }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="password" class="col-sm-2 col-form-label text-right">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <span class="text-warning small">( Isi hanya jika ingin mengubah password )</span>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="student_number" class="col-sm-2 col-form-label text-right">Nomor Peserta</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" id="student_number" name="student_number" value="{{ $student_data->student->student_number }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="birth_place" class="col-sm-2 col-form-label text-right">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" id="birth_place" name="birth_place" value="{{ $student_data->student->birth_place }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="birth_date" class="col-sm-2 col-form-label text-right">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control form-control" id="birth_date" name="birth_date" value="{{ $student_data->student->birth_date }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="Laki-Laki" class="col-sm-2 col-form-label text-right">{{ __('Jenis Kelamin') }} </label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="Laki-Laki" value="Laki-Laki" {{ $student_data->student->gender == 'Laki-Laki' ? 'checked' : '' }}>
                                    <label for="Laki-Laki" class="form-check-label" for="simulasi">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="perempuan" value="Perempuan" {{ $student_data->student->gender == 'Perempuan' ? 'checked' : '' }}>
                                    <label for="perempuan" class="form-check-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="Gender" class="col-sm-2 col-form-label text-right">{{ __('Alamat') }}</label>
                            <div class="col-sm-10">
                                <textarea name="address" id="address" rows="2" class="form-control">{{ $student_data->student->address }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="school_name" class="col-sm-2 col-form-label text-right">{{ __('Nama Sekolah') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control" id="school_name" name="school_name" value="{{ $student_data->student->school_name }}">
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <div class="col-sm-12">
                                <button type="suvmit" class="btn btn-primary form-control" style="background-color: #5DB6FA; border-color:#5DB6FA">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- Sertakan library FontAwesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<!-- Script untuk menampilkan ikon pensil saat hover dan mengganti gambar saat diklik -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const profileImage = document.getElementById('profileImage');
    const editIcon = document.getElementById('editIcon');
    const uploadProfileImage = document.getElementById('uploadProfileImage');

    // Tampilkan ikon pensil saat hover ke gambar
    profileImage.addEventListener('mouseenter', () => {
      editIcon.style.visibility = 'visible';
    });

    // Sembunyikan ikon pensil saat tidak di-hover lagi
    profileImage.addEventListener('mouseleave', () => {
      editIcon.style.visibility = 'hidden';
    });

    // Munculkan dialog browse saat ikon pensil diklik
    editIcon.addEventListener('click', () => {
      uploadProfileImage.click(); // Klik pada input file tersembunyi
    });

    // Ganti gambar saat user memilih gambar baru
    uploadProfileImage.addEventListener('change', (e) => {
      const file = e.target.files[0];
      const reader = new FileReader();

      reader.onload = () => {
        profileImage.src = reader.result;
      };

      if (file) {
        reader.readAsDataURL(file);
      }
    });
  });
</script>
@endpush
