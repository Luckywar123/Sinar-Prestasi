@extends('bimbel_layouts.master')

@section('content')
    <div class="content w-50">
        <div class="card rounded-5 mt-3 py-2" style="border-radius: 1.5rem">
            <div class="card-body px-5 py-3">
                <h3 class="card-title font-weight-bold my-3" style="color: #0F3077"><?php echo auth()->user()->full_name ?></h5>

                <div>
                    <a href="/siswa/simulasi/{{$category}}">
                        <button type="button" class="form-control btn btn-md rounded px-4 my-4 w-75" style="background-color: #2F6BB3; color:#FFFFFF">
                            Repeat
                        </button>
                    </a>
                    <a href="/siswa/score/{{ $exam->exam_id }}">
                        <button type="button" class="form-control btn btn-md rounded px-4 w-75" style="background-color: #2F6BB3; color:#FFFFFF">
                            See Score
                        </button>
                    </a>
                    <a href="/siswa/hasil-test/{{ $exam->exam_id }}">
                        <button type="button" class="form-control btn btn-md rounded px-4 my-4 w-75" style="background-color: #2F6BB3; color: #FFFFFF;">
                            View Answer
                        </button>
                    </a>
                    <p style="color: #2F6BB3;" class="fw-semibold">Score {{ $exam->exam_score }}</p>
                    <a href="/siswa/dashboard">
                        <button type="button" class="mt-5 form-control btn btn-md rounded px-4 my-4 w-75" style="border-color: #FF4D3D; color: #FF4D3D;">
                            Exit
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection


