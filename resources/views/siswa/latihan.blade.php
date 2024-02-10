@extends('siswa_layouts.master')

@section('style')
    <style>
        body{
            background-color: #D9D9D9;
        }
    </style>
@endsection

@section('content')
    <div class="mt-3 w-100 h-100">
        <div class="card rounded-5 mx-4">
            <div class="card-body px-5 pt-4">
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-md border">
                            Soal TKP
                        </button>
                    </div>
                    <div class="col-6 mb-5">
                        <p class="text-right">Sub Soal</p>
                    </div>
                    <div class="col-12">
                        <p>
                            <b>
                                Soal No.31
                            </b>
                        </p>
                    </div>
                    <div class="col-12 mb-3">
                        <img style="width: 469px; height: 200px" src="https://via.placeholder.com/469x200" />
                    </div>
                    <div class="col-12">
                        <p>
                            Pada suatu malam ketika Anda sedang sibuk bekerja, anak Anda sedang belajar di kamarnya, dan istri Anda sedang memasak untuk hidangan malam keluarga. Tiba-tiba listrik di rumah Anda padam sehingga membuat anak dan istri Anda panik, yang akan Anda lakukan adalah ....
                        </p>
                    </div>
                    <div class="col-12 d-flex align-items-center" style="background: #4FA7F9;">
                        <p class="mt-3">A. Berinisiatif mencari penerangan agar anak saya tetap bisa belajar dan istri saya juga bisa melanjutkan masak dengan tenang</p>
                    </div>
                    <div class="col-12 d-flex align-items-center">
                        <p class="mt-3">B. Mengkhawatirkan anak dan istri yang ketakutan karena gelap, dan mencari penerangan agar mereka tidak ketakutan</p>
                    </div>
                    <div class="col-12 d-flex align-items-center">
                        <p class="mt-3">C. Diam saja dan langsung tidur di kamar bila anak dan istri saya tetap tenang, namun bila mereka ketakutan saya akan segera
                            mencari penerangan</p>
                    </div>
                    <div class="col-12 d-flex align-items-center">
                        <p class="mt-3">D. Tetap tenang dan menyuruh istri untuk menyalakan penerangan alternatif. Istri yang sedang berada di dapur tentu akan lebih dekat
                            dengan penerangan alternatif</p>
                    </div>
                    <div class="col-12 d-flex align-items-center mb-5">
                        <p class="mt-3">E.  Saya akan mencari penerangan bila tidak ada satupun yang berusaha mencari penerangan alternatif</p>
                    </div>
                    <div class="col-12 d-flex mb-5">
                        <button class="btn btn-md btn-secondary mr-2" style="width: 140px; background-color: #A6A6A6">
                            Back
                        </button>
                        <button class="btn btn-md btn-secondary" style="width:140px; background-color: #5DB6FA; color: #0F3077">
                            Next
                        </button>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-7 mx-auto">
                        <div class="card rounded align-items-center" style="background-color: #DFF8FD">
                            <div class="card-body">
                                <?php
                                    for ($i=0; $i < 35; $i++) {
                                ?>
                                    <button class="btn btn-sm btn-primary mb-1" style="width: 36px">{{ $i+1 }}</button>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
