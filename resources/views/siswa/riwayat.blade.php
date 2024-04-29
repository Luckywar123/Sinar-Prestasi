@extends('bimbel_layouts.master')

@section('style')
    <style>
        table tr:last-child td:first-child {
            border-bottom-left-radius: 1rem !important;
        }
        table tr:last-child td:last-child {
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
                                <a class="form-control btn btn-sm rounded" style="border-color: #4FA7F9; color: #4FA7F9;" href="#" data-bs-toggle="modal" data-bs-target="#tokenModal{{ $k }}">
                                    <i class="fa fa-download"></i>
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @foreach ($exams as $k => $exam)
    <div class="modal fade" id="tokenModal{{ $k }}" tabindex="-1" aria-labelledby="tokenModalLabel{{ $k }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="submit-token-form" action="{{route('downloadSoal')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tokenModalLabel{{ $k }}">Masukkan Token</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="exam_id" value="{{ $exam->exam_id }}">
                        <input type="text" class="form-control" id="tokenInput{{ $k }}" name="token" placeholder="Masukkan Token" maxlength="6" value="{{ old('token') }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="kirimBtn{{ $k }}">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    @if(session('error'))
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Validasi Token</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ session('error') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
            $(document).ready(function(){
                $('#errorModal').modal('show');
            });
        </script>
        @endpush
    @endif

@endsection

