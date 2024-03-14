@extends('admin_layouts.master')

@section('page_title')
    List Data Siswa
@endsection

@section('content')

<div class="row">
    <div class="col-3 mb-5" style="border: 1px solid #0F3077;">
        <h4 class="text-center my-2" style="color: #0F3077">Daftar Peserta Ujian</h4>
    </div>

    <div class="col-12">
        <p>
            <b>Kelas/Ruangan</b>
        </p>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    <div class="col-12">
        <table class="table table-bordered">
            <thead class="text-center" style="background-color: #2F6BB3; color: #DFF8FD">
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
            </thead>
            <tbody style="color: #1C4B8F">
                @foreach($students as $key => $student)
                <tr style="@if (($key%2) != 0) background-color: #DFF8FD; @else background-color: #FFFFFF @endif">
                    <td class="align-middle text-center" style="width: 16%">{{ $key+1 }}</td>
                    <td class="align-middle" style="width: 60%">{{ $student->user->full_name }}</td>
                    <td class="align-middle text-center" style="width: 24%">
                        <div class="form-group row">
                            <div class="col-6">
                                <button type="button" class="form-control btn btn-md rounded" style="border-color: #FF4D3D; color: #FF4D3D;" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $student->student_id }}">
                                    Hapus
                                </button>
                            </div>
                            <div class="col-6">
                                <a class="form-control btn btn-md rounded" style="border-color: #4FA7F9; color: #4FA7F9;" href="detail-data-siswa/{{ $student->student_id }}">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="deleteModal{{ $student->student_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $student->student_id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $student->student_id }}">Konfirmasi Penghapusan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <a class="btn btn-danger" href="{!! url('guru/delete-data-siswa') !!}/{{$student->student_id}}">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
