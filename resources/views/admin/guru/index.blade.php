@extends('admin_layouts.master')

@section('page_title')
    List Data Guru
@endsection

@section('content')

<div class="row">
    <div class="col-12 mb-2 align-items-center">
        <h2 class="text-center my-2 fw-semibold" style="color: #0F3077">Daftar Guru Pengajar</h2>
        <hr style="width: 32%; margin:auto; ">
    </div>

    <div class="d-flex align-items-end flex-column mb-2">
        <div class="p-2">
            <a class="btn btn-primary" href="/admin/tambah-data-guru" style="background-color: #2F6BB3; color: #DFF8FD; border-color:#2F6BB3">Tambah</a>
        </div>
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
                <th>Email</th>
                <th>Username</th>
                <th>Aksi</th>
            </thead>
            <tbody class="table-light" style="color: #1C4B8F">
                @foreach($users as $k => $u)
                <tr>
                    <td class="align-middle text-center">{{ $k+1 }}</td>
                    <td class="align-middle">{{ $u->full_name }}</td>
                    <td class="align-middle" >{{ $u->email }}</td>
                    <td class="align-middle" >{{ $u->username }}</td>
                    <td class="align-middle text-center" style="width: 16%">
                        <div class="form-group row">
                            <div class="col-6">
                                <a class="form-control btn btn-md rounded" style="border-color: #4FA7F9; color: #4FA7F9;" href="ubah-data-guru/{{ $u->user_id }}">
                                    Edit
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="button" class="form-control btn btn-md rounded" style="border-color: #FF4D3D; color: #FF4D3D;" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $u->user_id }}">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="deleteModal{{ $u->user_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $u->user_id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $u->user_id }}">Konfirmasi Penghapusan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <a class="btn btn-danger" href="{!! url('admin/delete-data-guru') !!}/{{$u->user_id}}">Hapus</a>
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
