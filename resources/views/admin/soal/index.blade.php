@extends('admin_layouts.master')

@section('page_title')
    List Data Guru
@endsection

@section('content')

<div class="row">
    <div class="col-12 mb-2 align-items-center">
        <h2 class="text-center my-2 fw-semibold" style="color: #0F3077">Daftar Soal Test</h2>
        <hr style="width: 32%; margin:auto; ">
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
                <th>Gambar Soal</th>
                <th>Pertanyaan</th>
                <th>Jumlah Jawaban</th>
                <th>Status</th>
                <th>Aksi</th>
            </thead>
            <tbody class="table-light" style="color: #1C4B8F">
                @foreach($questions as $k => $q)
                <tr>
                    <td class="align-middle text-center">{{ $k+1 }}</td>
                    <td class="align-middle text-center">
                        @if ($q->question_image_url != NULL)
                            <img id="previewImage" src="{{ asset('storage/' . $q->question_image_url) }}" alt="Preview" style="display: width: max-width; height: 100px">
                        @else
                            -
                        @endif
                    </td>
                    <td class="align-middle" >{{substr($q->question_text, 0, 20) . '...';}}</td>
                    <td class="align-middle text-center" >{{ $q->answer->count() }}</td>
                    <td class="align-middle text-center">
                        <span class="badge bg-{{ $q->class }}">{{ $q->status }}</span>
                    </td>
                    <td class="align-middle text-center" style="width: 16%">
                        <div class="form-group row">
                            {{-- <div class="col-6">
                                <a class="form-control btn btn-md rounded" style="border-color: #4FA7F9; color: #4FA7F9;" href="ubah-data-guru/{{ $q->question_id }}">
                                    Edit
                                </a>
                            </div> --}}
                            <div class="col-12">
                                <button type="button" class="form-control btn btn-md rounded" style="border-color: #FF4D3D; color: #FF4D3D;" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $q->question_id }}">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="deleteModal{{ $q->question_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $q->question_id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $q->question_id }}">Konfirmasi Penghapusan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus soal ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <a class="btn btn-danger" href="{!! url('admin/delete-data-soal') !!}/{{$q->question_id}}">Hapus</a>
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
