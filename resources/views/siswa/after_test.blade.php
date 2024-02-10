@extends('siswa_layouts.master')

@section('style')
    <style>
        body{
            background-color: #D9D9D9;
        }
    </style>
@endsection

@section('content')
    <div class="content w-50">
        <div class="card rounded-5 mt-3 py-2">
            <div class="card-body px-5 py-3">
                <h3 class="card-title font-weight-bold my-3" style="color: #0F3077">Refal Purnama Putra</h5>

                <div>
                    <button type="button" class="form-control btn btn-md rounded px-4 my-4 w-75" style="background-color: #2F6BB3; color:#FFFFFF">
                        Repeat
                    </button>
                    <button type="button" class="form-control btn btn-md rounded px-4 w-75" style="background-color: #2F6BB3; color:#FFFFFF">
                        See Score
                    </button>
                    <button type="button" class="form-control btn btn-md rounded px-4 my-4 w-75" style="background-color: #2F6BB3; color: #FFFFFF;">
                        View Answer
                    </button>
                    <p style="color: #2F6BB3;">Score 300</p>
                    <button type="button" class="mt-5 form-control btn btn-md rounded px-4 my-4 w-75" style="border-color: #FF4D3D; color: #FF4D3D;">
                        Exit
                    </button>
                </div>
            </div>
        </div>


    </div>
@endsection


