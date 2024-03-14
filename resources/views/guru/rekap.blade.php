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
                @foreach ($exams as $key => $exam)
                <tr>
                    <td class="align-middle text-center">{{ $key + 1 }}</td>
                    <td class="align-middle">{{ $exam->student->user->full_name }}</td>
                    @if ($exam->exam_type == "Simulasi")
                        @foreach ($exam->exam_answer as $k => $answer)
                            @if ($k == 34)
                                <td class="align-middle text-center">{{ $answer->question->category }}</td>
                            @endif
                        @endforeach
                    @else
                        <td class="align-middle text-center">{{ $exam->exam_type }}</td>
                    @endif
                    <td>
                        @foreach ($exam->exam_answer as $k => $answer)
                        @if ($answer->is_false === 1)
                            <button class="btn btn-sm btn-danger mb-1" style="width: 36px">{{ $k+1 }}</button>
                        @else
                            <button class="btn btn-sm btn-primary mb-1" style="width: 36px">{{ $k+1 }}</button>
                        @endif
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
