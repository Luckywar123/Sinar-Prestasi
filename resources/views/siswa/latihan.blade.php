@extends('bimbel_layouts.master')

@section('style')
<style>
    body {
    -webkit-user-select: none; /* Safari */
    -moz-user-select: none; /* Firefox */
    -ms-user-select: none; /* IE 10+/Edge */
    user-select: none; /* Standard */
}
</style>
@endsection

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
                                @if (!empty($answer->answer_text))
                                    <div class="col-12 d-flex align-items-center" onclick="selectAnswer({{ $key }}, {{ $answerKey }}, {{ $answer->answer_id }}, {{ $examAnswer->exam_answer_id }})" @if($examAnswer->answer_id == $answer->answer_id) style="background-color: #4FA7F9;" @endif>
                                        <p class="mt-3">{{ strtoupper(chr(97 + $answerKey)) }}. {{ $answer->answer_text }}</p>
                                    </div>
                                @endif
                                @if (!empty($answer->answer_image_url))
                                    <div class="col-12 d-flex align-items-center my-3" onclick="selectAnswer({{ $key }}, {{ $answerKey }}, {{ $answer->id }}, {{ $examAnswer->id }})" @if($examAnswer->answer_id == $answer->answer_id) style="background-color: #4FA7F9;" @endif>
                                        <p>{{ strtoupper(chr(97 + $answerKey)) }}</p>
                                        <img class="ms-3" style="width: 469px; height: 200px" src="{{ asset('storage/' . $answer->answer_image_url) }}" />
                                    </div>
                                @endif
                            @endforeach

                            <div class="col-12 d-flex my-5">
                                <button class="btn btn-md btn-secondary" style="width: 140px; background-color: #A6A6A6; border-color:#A6A6A6" onclick="previousSoal()">
                                    Back
                                </button>
                                @if ($key === count($questions) - 1)
                                    <form id="formSelesaiSimulasi" action="/siswa/selesai-simulasi" method="POST">
                                        @csrf
                                        <button type="Submit" class="btn btn-md btn-secondary mx-4" style="width:140px; background-color: #5DB6FA; color: #0F3077; border-color:#5DB6FA">
                                            Selesai
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-md btn-secondary mx-4" style="width:140px; background-color: #5DB6FA; color: #0F3077; border-color:#5DB6FA" onclick="nextSoal()">
                                        Next
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row mt-5">
                    <div class="col-md-7 mx-auto align-items-center">
                        <div class="card rounded align-items-center" style="background-color: #DFF8FD">
                            <div class="card-body">
                                @foreach ($questions as $key => $examAnswer)
                                    <button id="navigationBtn{{$key}}" @if (!empty($examAnswer->answer_id)) class="btn btn-sm btn-primary mb-1" @else class="btn btn-sm btn-secondary mb-1" @endif style="width: 42px" onclick="tampilkanSoal({{ $key }})">{{ $key+1 }}</button>
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

    // Fungsi untuk memilih jawaban
    function selectAnswer(soalIndex, answerIndex, answerId, examAnswerId) {
        // Reset style jawaban sebelumnya jika ada
        let allAnswers = document.querySelectorAll(`#soal-${soalIndex} .d-flex`);
        allAnswers.forEach(function(answer) {
            answer.style.backgroundColor = 'inherit';
            answer.style.border = 'none'; // Hapus border dari semua jawaban
        });

        // Set style untuk jawaban yang dipilih
        let selectedAnswer = document.querySelector(`#soal-${soalIndex} .d-flex:nth-child(${answerIndex + 6})`);
        if (selectedAnswer) {
            selectedAnswer.style.backgroundColor = '#4FA7F9';
            console.log(`navigationBtn${soalIndex}`);
            document.getElementById(`navigationBtn${soalIndex}`).classList.remove("btn-secondary");
            document.getElementById(`navigationBtn${soalIndex}`).classList.add("btn-primary");
        }

        // Simpan jawaban yang dipilih ke dalam objek status
        selectedAnswers[soalIndex] = {
            answerIndex: answerIndex,
            answerId: answerId,
            examAnswerId: examAnswerId
        };

        // Kirim data jawaban yang dipilih ke controller menggunakan AJAX
        let formData = new FormData();
        formData.append('soalIndex', soalIndex);
        formData.append('answerIndex', answerIndex);
        formData.append('answerId', answerId);

        // Menggunakan URL dengan exam_answer_id sebagai bagian dari rute
        fetch('{{ route("simpanJawabanSimulasi", ":exam_answer_id") }}'.replace(':exam_answer_id', examAnswerId), {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Tampilkan respons dari server dalam konsol
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

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

    // Fungsi untuk menampilkan timer
    function displayTimer(remainingTime) {
        let timerElement = document.getElementById('timer');
        let hours = Math.floor(remainingTime / 3600); // Menghitung jumlah jam
        let minutes = Math.floor((remainingTime % 3600) / 60); // Menghitung jumlah menit
        let seconds = remainingTime % 60; // Menghitung jumlah detik

        // Format waktu dengan menambahkan nol di depan angka jika hanya satu digit
        let formattedTime = hours.toString().padStart(2, '0') + ':' +
                            minutes.toString().padStart(2, '0') + ':' +
                            seconds.toString().padStart(2, '0');

        timerElement.textContent = formattedTime;

        // Jika waktu habis, lakukan tindakan yang sesuai
        if (remainingTime <= 0) {
            // Tampilkan pesan atau lakukan tindakan yang sesuai
            timerElement.textContent = '00:00:00';
            document.getElementById("formSelesaiSimulasi").submit(); // Kirim formulir saat waktu habis
        }
    }

    // Fungsi untuk mengupdate timer setiap detik
    function updateTimer() {
        let remainingTime = {{ $remainingTime }}; // Ganti dengan cara yang sesuai dengan implementasi Anda

        // Tampilkan timer awal
        displayTimer(remainingTime);

        // Perbarui timer setiap detik
        let intervalId = setInterval(function() {
            remainingTime--;
            displayTimer(remainingTime);

            // Hentikan interval jika waktu habis
            if (remainingTime <= 0) {
                clearInterval(intervalId);
            }
        }, 1000);
    }

    // Panggil fungsi updateTimer saat halaman dimuat
    window.onload = function() {
        updateTimer();
    };

    window.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });
</script>
@endpush
