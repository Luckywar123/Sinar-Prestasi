@extends('siswa_layouts.master')

@section('style')
    <style>
        body{
            background-color: #D9D9D9;
        }

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
        <h4 class="card-title font-weight-bold my-3 text-left" style="color: #0F3077">Score</h5>

        <table class="table table-bordered">
            <thead class="table-light" style="background-color: #2F6BB3; color: #DFF8FD">
                <th>Tes</th>
                <th>Soal</th>
                <th>Jumlah Soal Benar</th>
                <th>Nilai</th>
            </thead>
            <tbody style="background-color: #FFFFFF">
                <tr>
                    <td style="color: #1C4B8F">Tes Karakteristik Pribadi (TKP)</td>
                    <td>35</td>
                    <td>30</td>
                    <td>70</td>
                </tr>
                <tr>
                    <td style="color: #1C4B8F">Tes Intelegensi Umum (TIU)</td>
                    <td>36</td>
                    <td>23</td>
                    <td>35</td>
                </tr>
                <tr>
                    <td style="color: #1C4B8F">Tes Wawasan Kebangsaan (TWK)</td>
                    <td>71</td>
                    <td>55</td>
                    <td>163</td>
                </tr>
                <tr>
                    <td colspan="3" style="background-color: #D9D9D9"></td>
                    <td>268</td>
                </tr>
            </tbody>
        </table>

    </div>
@endsection


