<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sinar Prestasi | Data Soal</title>
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
            }
        </style>
    </head>
    <body>
        <div class="container-wrapper pt-4 px-5 content">
            @foreach ($questions as $key => $examAnswer)
                <div class="soal">
                    <div class="row mb-5">
                        <div class="col-12 mt-4">
                            <p>
                                <b>
                                    Soal No.{{ $loop->iteration }} ( {{ $examAnswer->question->category }} - {{ $examAnswer->question->sub_category }} )
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
                                {!! $examAnswer->question->question_text !!}
                            </p>
                        </div>
                        @foreach ($examAnswer->question->answer as $answerKey => $answer)
                            @if (!empty($answer->answer_text))
                                <div class="col-12 d-flex align-items-center">
                                    <p class="mt-3">{{ strtoupper(chr(97 + $answerKey)) }}. {{ $answer->answer_text }}</p>
                                </div>
                            @endif
                            @if (!empty($answer->answer_image_url))
                                <div class="col-12 d-flex align-items-center my-3" >
                                    <p>{{ strtoupper(chr(97 + $answerKey)) }}</p>
                                    <img class="ms-3" style="width: 469px; height: 200px" src="{{ asset('storage/' . $answer->answer_image_url) }}" />
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Custom JavaScript -->
        <script>
            // Function to handle window print when the page loads
            window.onload = function () {
                window.print();
            };

            // Function to handle going back when print dialog is closed
            window.onafterprint = function () {
                window.history.back();
            };
        </script>
    </body>
</html>
