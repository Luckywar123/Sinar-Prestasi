@extends('admin_layouts.master')

@section('page_title')
    Rekap Siswa
@endsection

@section('content')
<div class="row">
    <div class="col-3 mb-5" style="border: 1px solid #0F3077;">
        <h4 class="text-center my-2" style="color: #0F3077">Daftar Peserta Ujian</h4>
    </div>

    <div class="col-12 mb-5">
        <form action="{{ route('filter-by-month') }}" method="GET">
            @csrf
            <div class="form-group">
                <div class="col-12">
                    <p>
                        <label for="month_filter" class="fw-bold">Pilih Bulan:</label>
                    </p>
                </div>

                <select name="month_filter" id="month_filter" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Pilih Bulan --</option>
                    @foreach($months as $key => $month)
                        <option value="{{ $key }}" {{ request()->input('month_filter') == $key ? 'selected' : '' }}>
                            {{ $month }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <div class="col-12">
        <p>
            <b>Kelas/Ruangan</b>
        </p>
    </div>
    <div class="col-12">
        <table class="table table-bordered">
            <thead class="text-center" style="background-color: #2F6BB3; color: #DFF8FD">
                <th style="width: 5%">No</th>
                <th style="width: 10%">Tanggal Ujian</th>
                <th style="width: 25%"">Nama</th>
                <th style="width: 10%">Test</th>
                <th style="width: 50%">Nilai</th>
            </thead>
            <tbody class="table-light" style="color: #1C4B8F">
                @if(isset($exams) && $exams->count() > 0)
                    @foreach ($exams as $key => $exam)
                        <tr>
                            <td class="align-middle text-center">{{ $key + 1 }}</td>
                            <td class="align-middle text-center">{{ \Carbon\Carbon::parse($exam->exam_start)->format('d M Y') }}</td>
                            <td class="align-middle">{{ $exam->student->user->full_name }}</td>
                            @if ($exam->exam_type == "Simulasi")
                                @foreach ($exam->exam_answer as $k => $answer)
                                    @if ($k == 0)
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
                @else
                    <td colspan="5" class="text-center">Tidak ada data yang tersedia pada Bulan yang dipilih.</td>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
