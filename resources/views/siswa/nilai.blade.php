@extends('bimbel_layouts.master')

@section('style')
    <style>
        table tr:first-child th:first-child {
            border-top-left-radius: 1rem !important;
        }

        table tr:first-child th:last-child {
            border-top-right-radius: 1rem !important;
        }

        table tr:last-child td:last-child {
            border-bottom-right-radius: 1rem !important;
            border-bottom-left-radius: 1rem !important;
        }
    </style>
@endsection

@section('content')
    <div class="content w-50">
        <h4 class="card-title fw-semibold my-3 text-start">Score</h5>

        <table class="table">
            <thead class="table" style="background-color: #2F6BB3; color: #DFF8FD">
                <th>Tes</th>
                <th>Soal</th>
                <th>Jumlah Soal Benar</th>
                <th>Nilai</th>
            </thead>
            <tbody style="background-color: #FFFFFF">
                @php
                    $scoresArray = is_array($data) ? $data : [$data];
                @endphp

                @if(count($scoresArray) > 1)
                    @foreach($data as $key => $value)
                        @if(is_array($value))
                            <tr>
                                <td style="color: #1C4B8F">{{ $key }}</td>
                                <td>{{ $value['Total_Soal'] }}</td>
                                <td>{{ $value['Jawaban_Benar'] }}</td>
                                <td>{{ $value['Nilai'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td style="color: #1C4B8F">{{ $data->Category }}</td>
                        <td>{{ $data->Total_Soal }}</td>
                        <td>{{ $data->Jawaban_Benar }}</td>
                        <td>{{ $data->Nilai }}</td>
                    </tr>
                @endif

                <tr>
                    <td colspan="3" style="background-color: #D9D9D9; border: none"></td>
                    <td>{{ $overall_score }}</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-5">&nbsp;</div>


        <div class="col-12 d-flex mt-5">

            @if(count($scoresArray) == 1)
                <a href="/siswa/simulasi/{{ $data->Type }}">
                    <button class="btn btn-md btn-secondary fw-semibold" style="width:180px; background-color: #5DB6FA; color: #0F3077; border-color:#5DB6FA">
                        Ulang Simulasi
                    </button>
                </a>
            @endif
            <a href="/siswa/dashboard" class="ms-auto ">
                <button class="btn btn-md btn-secondary fw-semibold" style="width:180px; background-color: #5DB6FA; color: #0F3077; border-color:#5DB6FA">
                    Main Menu
                </button>
            </a>
        </div>


    </div>
@endsection
