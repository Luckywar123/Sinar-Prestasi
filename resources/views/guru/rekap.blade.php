@extends('admin_layouts.master')

@section('page_title')
    Rekap Siswa
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
    <div class="col-12">
        <table class="table table-bordered">
            <thead class="text-center" style="background-color: #2F6BB3; color: #DFF8FD">
                <th>No</th>
                <th>Nama</th>
                <th>Test</th>
                <th style="width: 50%">Nilai</th>
            </thead>
            <tbody class="table-light" style="color: #1C4B8F">
                <tr>
                    <td class="align-middle text-center">1</td>
                    <td class="align-middle">Nama Siswa</td>
                    <td class="align-middle text-center">TKP</td>
                    <td>
                        <?php
                            for ($i=0; $i < 35; $i++) {
                        ?>
                        @if ($i%2 == 0)
                            <button class="btn btn-sm btn-danger mb-1" style="width: 36px">{{ $i+1 }}</button>
                        @else
                            <button class="btn btn-sm btn-primary mb-1" style="width: 36px">{{ $i+1 }}</button>
                        @endif
                        <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="align-middle text-center">2</td>
                    <td class="align-middle">Nama Siswa</td>
                    <td class="align-middle text-center">TKP</td>
                    <td>
                        <?php
                            for ($i=0; $i < 35; $i++) {
                        ?>
                        @if ($i%2 == 0)
                            <button class="btn btn-sm btn-danger mb-1" style="width: 36px">{{ $i+1 }}</button>
                        @else
                            <button class="btn btn-sm btn-primary mb-1" style="width: 36px">{{ $i+1 }}</button>
                        @endif
                        <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="align-middle text-center">3</td>
                    <td class="align-middle">Nama Siswa</td>
                    <td class="align-middle text-center">TKP</td>
                    <td>
                        <?php
                            for ($i=0; $i < 35; $i++) {
                        ?>
                        @if ($i%2 == 0)
                            <button class="btn btn-sm btn-danger mb-1" style="width: 36px">{{ $i+1 }}</button>
                        @else
                            <button class="btn btn-sm btn-primary mb-1" style="width: 36px">{{ $i+1 }}</button>
                        @endif
                        <?php
                            }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
