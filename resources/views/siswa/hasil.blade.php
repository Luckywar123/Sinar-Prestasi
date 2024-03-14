@extends('bimbel_layouts.master')

@section('content')
    <div class="mt-3 w-100 h-100">
        <div class="card rounded-5 mx-4">
            <div class="card-body px-5 pt-4">
                @foreach ($questions as $key => $examAnswer)
                    <div class="soal" id="soal-{{ $key }}" style="display: {{ $key === 0 ? 'block' : 'none' }}">
                        <div class="row mb-5">
                            <div class="col-6">
                                <button class="btn btn-md border">
                                    Soal {{ $examAnswer->question->category }}
                                </button>
                            </div>
                            <div class="col-6 text-end">
                                <p>{{ $examAnswer->question->sub_category }}</p>
                            </div>
                            <div class="col-12 mt-4">
                                <p>
                                    <b>
                                        Soal No.{{ $loop->iteration }}
                                    </b>
                                </p>
                            </div>
                            <div class="col-12 mb-3">
                                @if (!empty($examAnswer->question->question_image_url))
                                    <img style="width: 469px; height: 200px" src="{{ asset('storage/' . $examAnswer->question->question_image_url) }}" />
                                @endif
                            </div>
                            <div class="col-12">
                                <p>
                                    {{ $examAnswer->question->question_text }}
                                </p>
                            </div>
                            @foreach ($examAnswer->question->answer as $answerKey => $answer)
                                @if (!empty($answer->answer_image_url))
                                    @if ($examAnswer->answer_id === NULL)
                                        <div class="col-12 d-flex align-items-center my-3" style="@if ($answer->answer_id  == $maxScores[$examAnswer->question_id])  background-color: #5DB6FA; @else background-color: #FF4D3D @endif">
                                            <p>{{ strtoupper(chr(97 + $answerKey)) }}</p>
                                            <img class="ms-3" style="width: 469px; height: 200px" src="{{ asset('storage/' . $answer->answer_image_url) }}" />
                                        </div>
                                    @elseif ($examAnswer->answer_id != NULL)
                                        @if ($examAnswer->is_false === 0)
                                            <div class="col-12 d-flex align-items-center my-3" style="@if ($answer->answer_id == $examAnswer->answer_id) background-color: #5DB6FA; @endif">
                                                <p>{{ strtoupper(chr(97 + $answerKey)) }}</p>
                                            <img class="ms-3" style="width: 469px; height: 200px" src="{{ asset('storage/' . $answer->answer_image_url) }}" />
                                            </div>
                                        @elseif ($examAnswer->is_false === 1)
                                            <div class="col-12 d-flex align-items-center my-3" style="@if ($answer->answer_id == $examAnswer->answer_id) background-color: #FF4D3D; @elseif ($answer->answer_id  == $maxScores[$examAnswer->question_id]) background-color: #5DB6FA @endif">
                                                <p>{{ strtoupper(chr(97 + $answerKey)) }}</p>
                                                <img class="ms-3" style="width: 469px; height: 200px" src="{{ asset('storage/' . $answer->answer_image_url) }}" />
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if ($examAnswer->answer_id === NULL)
                                        <div class="col-12 d-flex align-items-center" style="@if ($answer->answer_id  == $maxScores[$examAnswer->question_id])  background-color: #5DB6FA; @else background-color: #FF4D3D @endif">
                                            <p class="mt-3">{{ strtoupper(chr(97 + $answerKey)) }}. {{ $answer->answer_text }}</p>
                                        </div>
                                    @elseif ($examAnswer->answer_id != NULL)
                                        @if ($examAnswer->is_false === 0)
                                            <div class="col-12 d-flex align-items-center" style="@if ($answer->answer_id == $examAnswer->answer_id) background-color: #5DB6FA; @endif">
                                                <p class="mt-3">{{ strtoupper(chr(97 + $answerKey)) }}. {{ $answer->answer_text }}</p>
                                            </div>
                                        @elseif ($examAnswer->is_false === 1)
                                            <div class="col-12 d-flex align-items-center" style="@if ($answer->answer_id == $examAnswer->answer_id) background-color: #FF4D3D; @elseif ($answer->answer_id  == $maxScores[$examAnswer->question_id]) background-color: #5DB6FA @endif">
                                                <p class="mt-3">{{ strtoupper(chr(97 + $answerKey)) }}. {{ $answer->answer_text }}</p>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @endforeach

                            @if ($key === count($questions) - 1)
                            <div class="d-flex align-items-end flex-column mb-3" style="height: 200px;">
                                <div class="p-2">
                                    <a href="/siswa/dashboard" class="ms-auto ">
                                        <button class="btn btn-md btn-secondary mx-4" style="width:200px; background-color: #A6A6A6; color: #FFFFFF; border-color:#A6A6A6">
                                            Main Menu
                                        </button>
                                    </a>
                                </div>
                            </div>
                            @else
                            <div class="col-12 d-flex my-5">
                                <button class="btn btn-md btn-secondary" style="width: 140px; background-color: #A6A6A6; border-color:#A6A6A6" onclick="previousSoal()">
                                    Back
                                </button>
                                <button class="btn btn-md btn-secondary mx-4" style="width:140px; background-color: #5DB6FA; color: #0F3077; border-color:#5DB6FA" onclick="nextSoal()">
                                    Next
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row mt-5">
                    <div class="col-md-7 mx-auto">
                        <div class="card rounded align-items-center" style="background-color: #DFF8FD">
                            <div class="card-body">
                                @foreach ($questions as $key => $examAnswer)
                                    <button id="navigationBtn{{$key}}" class="btn btn-sm mb-1" style="width: 42px; @if ($examAnswer->is_false === 0) background-color: #5DB6FA; border-color:#5DB6FA  @else background-color: #FF4D3D; border-color:#FF4D3D  @endif " onclick="tampilkanSoal({{ $key }})">{{ $key+1 }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let currentIndex = 0;
    let jumlahSoal = {{ count($questions) }};

    // Objek untuk menyimpan status jawaban
    let selectedAnswers = {};

    // Fungsi untuk menampilkan soal
    function tampilkanSoal(index) {
        let allSoal = document.querySelectorAll('.soal');
        allSoal.forEach(function(soal) {
            soal.style.display = 'none';
        });

        let soal = document.querySelector(`#soal-${index}`);
        soal.style.display = 'block';
        window.scrollTo(0, 0); // Mengatur scroll ke bagian atas halaman
        currentIndex = index;

        // Set gaya jawaban yang dipilih jika ada
        if (selectedAnswers[index] !== undefined) {
            let selectedAnswerIndex = selectedAnswers[index].answerIndex; // Ambil properti answerIndex
            let selectedAnswer = document.querySelector(`#soal-${index} .d-flex:nth-child(${selectedAnswerIndex + 6})`);
            if (selectedAnswer) {
                selectedAnswer.style.backgroundColor = '#4FA7F9'; // Set warna biru pada jawaban yang dipilih
            }
        }
    }

    // Fungsi untuk memilih jawaban (Dihapus)

    // Fungsi untuk menavigasi ke halaman soal sebelumnya
    function previousSoal() {
        if (currentIndex > 0) {
            currentIndex--;
            tampilkanSoal(currentIndex);
        }
    }

    // Fungsi untuk menavigasi ke halaman soal berikutnya
    function nextSoal() {
        if (currentIndex < jumlahSoal - 1) {
            currentIndex++;
            tampilkanSoal(currentIndex);
        }
    }
</script>
@endpush
