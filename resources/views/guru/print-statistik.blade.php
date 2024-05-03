<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinar Prestasi | Statistika dan Ranking
    </title>
    <!-- Favicon -->
    <link href="http://127.0.0.1:8000/assets/favicon.png" rel="icon" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
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

            <h2 class="fw-semibold text-center my-4">Statistik Simulasi CAT</h2>

            <div class="col-12 mb-5">
                <table class="table table-bordered">
                    <thead class="text-center" style="background-color: #2F6BB3; color: #DFF8FD">
                        <tr>
                            <th>Rank</th>
                            <th>Tanggal Ujian</th>
                            <th>No. Peserta</th>
                            <th>Nama</th>
                            <th>TKP</th>
                            <th>TIU</th>
                            <th>TWK</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody class="table-light" style="color: #1C4B8F">
                        @foreach ($examData as $key => $data)
                            <tr>
                                <td class="align-middle text-center">{{ $key + 1 }}</td>
                                <td class="align-middle text-center">
                                    {{ \Carbon\Carbon::parse($data->exam_start)->format('d M Y') }}</td>
                                <td class="align-middle">{{ $data->student->student_number }}</td>
                                <td class="align-middle">{{ $data->student->user->full_name }}</td>
                                <td class="align-middle">{{ $data->tkpScore }}</td>
                                <td class="align-middle">{{ $data->tiuScore }}</td>
                                <td class="align-middle">{{ $data->twkScore }}</td>
                                <td class="align-middle text-center">{{ $data->exam_score }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <canvas id="siswaStatistikChart"></canvas>

            <div class="col-12 mt-5 w-50 mx-auto">
                <table class="table table-bordered">
                    <thead class="text-center" style="background-color: #2F6BB3; color: #DFF8FD">
                        <tr>
                            <th>Kategori Soal</th>
                            <th>Jumlah Lulus</th>
                            <th>Jumlah Tidak Lulus</th>
                        </tr>
                    </thead>
                    <tbody class="table-light" style="color: #1C4B8F">
                        <tr>
                            <td class="align-middle text-center">TWK</td>
                            <td class="align-middle text-center">{{ $twkLulus }}</td>
                            <td class="align-middle text-center">{{ $twkTidakLulus }}</td>
                        </tr>
                        <tr>
                            <td class="align-middle text-center">TIU</td>
                            <td class="align-middle text-center">{{ $tiuLulus }}</td>
                            <td class="align-middle text-center">{{ $tiuTidakLulus }}</td>
                        </tr>
                        <tr>
                            <td class="align-middle text-center">TKP</td>
                            <td class="align-middle text-center">{{ $tkpLulus }}</td>
                            <td class="align-middle text-center">{{ $tkpTidakLulus }}</td>
                        </tr>
                    </tbody>
                </table>
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

        // Close window after print dialog is closed
        window.addEventListener('afterprint', function() {
            window.close();
        });
    </script>
</body>

</html>
