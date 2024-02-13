@extends('admin_layouts.master')

@section('page_title')
    Statistika dan Ranking
@endsection

@section('content')
<div class="row">
    <div class="col-2 mb-3 ms-auto">
        <button type="button" class="btn btn-md w-100" style="background-color: #4FA7F9; color: #000000;">Download</button>
    </div>

    <div class="col-12">
        <table class="table table-bordered">
            <thead class="text-center" style="background-color: #2F6BB3; color: #DFF8FD">
                <th>Rank</th>
                <th>No. Peserta</th>
                <th>Nama</th>
                <th>Nilai</th>
            </thead>
            <tbody class="table-light" style="color: #1C4B8F">
                <tr>
                    <td class="align-middle text-center">1</td>
                    <td class="align-middle">1324543435363</td>
                    <td class="align-middle">Nama Siswa</td>
                    <td class="align-middle text-center">268</td>
                </tr>
                <tr>
                    <td class="align-middle text-center">2</td>
                    <td class="align-middle">1324543435363</td>
                    <td class="align-middle">Nama Siswa</td>
                    <td class="align-middle text-center">268</td>
                </tr>
                <tr>
                    <td class="align-middle text-center">3</td>
                    <td class="align-middle">1324543435363</td>
                    <td class="align-middle">Nama Siswa</td>
                    <td class="align-middle text-center">266</td>
                </tr>
                <tr>
                    <td class="align-middle text-center">4</td>
                    <td class="align-middle">1324543435363</td>
                    <td class="align-middle">Nama Siswa</td>
                    <td class="align-middle text-center">266</td>
                </tr>
                <tr>
                    <td class="align-middle text-center">5</td>
                    <td class="align-middle">1324543435363</td>
                    <td class="align-middle">Nama Siswa</td>
                    <td class="align-middle text-center">265</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-8">
        <div class="card">
            Test
        </div>
    </div>
    <div class="col-4">
        <div class="card mt-3 py-2" style="border-radius: 1rem">
            <div class="card-body px-5 py-3">
                <h5 class="card-title fw-semibold">Hasil Ujian Siswa</h5>
            </div>
        </div>
    </div>
</div>
@endsection
