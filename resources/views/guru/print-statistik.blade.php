<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinar Prestasi |     Statistika dan Ranking
</title>
    <!-- Favicon -->
    <link href="http://127.0.0.1:8000/assets/favicon.png" rel="icon" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
    body{
        font-family: "Montserrat", sans-serif;
        background-color: #D9D9D9;
    }
    table tr:first-child th:first-child {
        border-top-left-radius: 1rem !important;
    }
    table tr:first-child th:last-child {
        border-top-right-radius: 1rem !important;
    }
</style>
    </head>
<body>
    <!-- Content -->
    <div class="container-wrapper pt-4 px-5 content">
        <div class="row">

            <h2 class="fw-semibold text-center my-4">Statistik Data Test Siswa</h2>

            <div class="col-12">
                <table class="table table-bordered">
                    <thead class="text-center" style="background-color: #2F6BB3; color: #DFF8FD">
                        <tr><th>Rank</th>
                        <th>No. Peserta</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                    </tr></thead>
                    <tbody class="table-light" style="color: #1C4B8F">
                        @foreach ($topExams as $key => $data)
                        <tr>
                            <td class="align-middle text-center">{{ $key + 1 }}</td>
                            <td class="align-middle">{{ $data->student->student_number }}</td>
                            <td class="align-middle">{{ $data->student->user->full_name }}</td>
                            <td class="align-middle text-center">{{ $data->exam_score }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="col-8">
                <div class="card p-4" style="border-radius: 0.7rem">
                    <canvas id="siswaStatistikChart" width="400" height="200"></canvas>
                </div>
            </div>
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
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

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
</body></html>
