@extends('admin_layouts.master')

@section('page_title')
    Statistika dan Ranking
@endsection

@section('content')
<div class="row">
    @if(isset($examData) && $examData->count() > 0)
    <div class="col-2 mb-3 ms-auto">
        <button onclick="printPage('{{ route('printStatistik') }}')" class="btn btn-md w-100" style="background-color: #4FA7F9; color: #000000;">Download</button>
    </div>
    @endif


    <div class="col-12">
        <table class="table table-bordered">
            <thead class="text-center" style="background-color: #2F6BB3; color: #DFF8FD">
                <th>Rank</th>
                <th>Mulai Ujian</th>
                <th>Selesai Ujian</th>
                <th>No. Peserta</th>
                <th>Nama</th>
                <th>TKP</th>
                <th>TIU</th>
                <th>TWK</th>
                <th>Score</th>
            </thead>
            <tbody class="table-light" style="color: #1C4B8F">
                @if(isset($examData) && $examData->count() > 0)
                    @foreach ($examData as $key => $data)
                    <tr>
                        <td class="align-middle text-center">{{ $key + 1 }}</td>
                        <td class="align-middle text-center">{{ \Carbon\Carbon::parse($data->exam_start)->format('d M Y H:m:s') }}</td>
                        <td class="align-middle text-center">{{ \Carbon\Carbon::parse($data->exam_finish)->format('d M Y H:m:s') }}</td>
                        <td class="align-middle">{{ $data->student->student_number }}</td>
                        <td class="align-middle">{{ $data->student->user->full_name }}</td>
                        <td class="align-middle">{{ $data->tkpScore }}</td>
                        <td class="align-middle">{{ $data->tiuScore }}</td>
                        <td class="align-middle">{{ $data->twkScore }}</td>
                        <td class="align-middle text-center">{{ $data->exam_score }}</td>
                    </tr>
                    @endforeach
                @else
                    <td colspan="9" class="text-center">Tidak ada data yang tersedia untuk token aktif.</td>
                @endif
            </tbody>
        </table>
    </div>

    @if(isset($examData) && $examData->count() > 0)
        <div class="col-8">
            <div class="card p-4" style="border-radius: 0.7rem">
                <canvas id="siswaStatistikChart" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="col-4">
            <div class="card p-4" style="height: 424px;" style="border-radius: 0.7rem">
                    <h4 class="card-title fw-semibold mb-4">Hasil Ujian Siswa</h4>
                    <div class="row mt-2 fs-5">
                        <div class="col-3">
                            TKP &nbsp;:
                        </div>
                        <div class="col-9">
                            {{ $tkpTidakLulus }} Siswa tidak lulus
                        </div>
                        <div class="col-3"></div>
                        <div class="col-9">
                            {{ $tkpLulus }} Siswa Lulus
                        </div>
                    </div>
                    <div class="row mt-2 fs-5">
                        <div class="col-3">
                            TIU &nbsp;&nbsp;:
                        </div>
                        <div class="col-9">
                            {{ $tiuTidakLulus }} Siswa tidak lulus
                        </div>
                        <div class="col-3"></div>
                        <div class="col-9">
                            {{ $tiuLulus }} Siswa Lulus
                        </div>
                    </div>
                    <div class="row mt-2 fs-5">
                        <div class="col-3">
                            TWK :
                        </div>
                        <div class="col-9">
                            {{ $twkTidakLulus }} Siswa tidak lulus
                        </div>
                        <div class="col-3"></div>
                        <div class="col-9">
                            {{ $twkLulus }} Siswa Lulus
                        </div>
                    </div>
                    <div class="row mt-2 mx-1 mt-5 fs-5">
                        <div class="col-2" style="background-color: #2F6BB3">.</div>
                        <div class="col-3">Lulus</div>
                        <div class="col-2" style="background-color: #FF4D3D">.</div>
                        <div class="col-5">Tidak Lulus</div>
                    </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('siswaStatistikChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['TKP', 'TIU', 'TWK'],
            datasets: [{
                label: 'Lulus',
                data: [{{ $tkpLulus }}, {{ $tiuLulus }}, {{ $twkLulus }}],
                backgroundColor: 'rgba(47, 107, 179, 1)',

                borderWidth: 1
            }, {
                label: 'Tidak Lulus',
                data: [{{ $tkpTidakLulus }}, {{ $tiuTidakLulus }}, {{ $twkTidakLulus }}],
                backgroundColor: 'rgba(255, 77, 61, 1)',

                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    function printPage(url) {
        // Buka halaman dalam tab baru
        var newWindow = window.open(url, '_blank');

        // Tunggu sebentar untuk memastikan halaman terbuka sebelum melakukan pencetakan
        setTimeout(function() {
            // Lakukan pencetakan
            newWindow.print();
        }, 1000); // Tunggu 1 detik sebelum melakukan pencetakan
    }
</script>

@endpush
