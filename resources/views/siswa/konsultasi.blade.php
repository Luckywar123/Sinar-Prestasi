@extends('siswa_layouts.master')

@section('style')
    <style>
        .img-opacity {
            opacity: 1; /* Atur nilai opacity sesuai keinginan Anda, 0.0 hingga 1.0 */
        }
        .no-border {
            border: none;
        }
        .bg-image {
            /* Mengatur gambar latar belakang untuk memenuhi lebar dan tinggi layar */
            background-size: cover;
            background-position: center;
            /* Set tinggi layar sesuai dengan perangkat */
            height: 100vh;
        }
    </style>
@endsection

@section('background')
    <img src="{{ asset('assets/background2.jpeg') }}" alt="Background Image" class="bg-image bg-dark img-fluid img-opacity">
@endsection

@section('content')
    <div class="content container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-sm-10">
                <div class="card rounded-5 mt-3 py-2">
                    <div class="card-body px-5 py-3">
                        <div class="text-center mb-5">
                            <img src="{{ asset('assets/logo_full.png') }}" alt="Logo Full" width="250">
                        </div>

                        <div>
                            <button type="button" class="form-control btn btn-lg rounded-pill px-2 my-2 shadow no-border" style="background-color: #0F3077; color:#DFF8FD">
                                <i class="fas fa-phone mr-2"></i>
                                +62 822-9556-2910
                            </button>
                            <button type="button" class="form-control btn btn-lg rounded-pill px-2 my-2 shadow no-border" style="background-color: #0F3077; color:#DFF8FD ">
                                <i class="fas fa-envelope mr-2"></i>
                                <a href="mailto:bimbelsinarprestasi@gmail.com" target="_blank" style="color: #ffffff; text-decoration: none;"> bimbelsinarprestasi@gmail.com</a>
                            </button>

                            <button type="button" class="form-control btn btn-lg rounded-pill px-2 my-2 shadow no-border" style="background-color: #60D669; color: #ffffff;">
                                <i class="fab fa-whatsapp fa-bounce mr-2"></i>
                                <a style="color: #ffffff; text-decoration: none;" href="https://wa.me/6282295562910?text=Halo%20kak%20,%20Saya%20tertarik%20buat%20join%20bimbelnya%20kak" target="_blank">
                                    Send Message
                                </a>
                            </button>

                            <button type="button" class="form-control btn btn-lg rounded-pill px-2 my-2 shadow no-border" style="background-color: #E1306C; color: #ffffff;">
                                <i class="fab fa-instagram fa-bounce mr-2"></i>
                                <a style="color: #ffffff; text-decoration: none;" href="https://www.instagram.com/bimbelsinarprestasi/." target="_blank"> Check Our Instagram</a>
                            </button>

                            <button type="button" class="form-control btn btn-lg rounded-pill px-2 my-2 shadow no-border" style="background-color: #0092ff; color: #ffffff;">
                                <i class="fab fa-facebook fa-bounce mr-2"></i>
                                <a style="color: #ffffff; text-decoration: none;" href="https://www.facebook.com/gaktausiapaya." target="_blank"> Check Our Facebook</a>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
