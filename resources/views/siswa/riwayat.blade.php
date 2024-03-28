@extends('bimbel_layouts.master')

@section('style')
    <style>
        table tr:last-child td:first-child{
            border-bottom-left-radius: 1rem !important;
        }
        table tr:last-child td:last-child{
            border-bottom-right-radius: 1rem !important;
        }
    </style>
@endsection

@section('content')
<div class="content w-50">
    <table class="table table-bordered table-rounded">
        <thead class="text-center" style="background-color: #2F6BB3; color: #DFF8FD">
            <tr>
                <th style="border-top-left-radius: 1rem">No</th>
                <th>Tanggal Ujian</th>
                <th>Waktu Ujian</th>
                <th>Kategori</th>
                <th>Nilai</th>
                <th style="border-top-right-radius: 1rem">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-light" style="color: #1C4B8F">
            @foreach ($exams as $k => $exam)
                <tr class="align-middle">
                    <td>{{ $k +1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($exam->exam_start)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($exam->exam_start)->format('H:m:s') }}</td>
                    <td>
                        @if ($exam->exam_type == "Simulasi")
                            Latihan Soal
                        @elseif($exam->exam_type == "Test")
                            Simulasi CAT
                        @else
                            Uncategorized
                        @endif
                    </td>
                    <td>{{ $exam -> exam_score }}</td>
                    <td>
                        @if ($exam->exam_type == "Test")
                            <a class="form-control btn btn-sm rounded" style="border-color: #4FA7F9; color: #4FA7F9;" href="">
                                <i class="fa fa-download"></i>
                            </a>
                        @else

                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
