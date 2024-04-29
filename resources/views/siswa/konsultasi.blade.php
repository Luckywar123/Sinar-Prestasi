@extends('siswa_layouts.master')

@section('style')
    <style>
        .img-opacity {
            opacity: 1; /* Atur nilai opacity sesuai keinginan Anda, 0.0 hingga 1.0 */
        }
        .no-border {
            border: none;
        }
    </style>
@endsection

@section('background')
    <img src="{{ asset('assets/background2.jpeg') }}" alt="Background Image" class="bg-dark img-opacity">
@endsection

@section('content')
    <div class="content w-50" style ="padding-top: 125px;">
        <div class="card rounded-5 mt-3 py-2">
            <div class="card-body px-5 py-3">
                <div class="row justify-content-center">
                    <div class="col-7 mb-5">
                        <img src="{{ asset('assets/logo_full.png') }} "alt="Logo Full" width="50">
                    </div>
                </div>

                <div>
                    <button type="button" class="form-control btn btn-lg rounded-pill px-2 my-2 w-75 shadow no-border" style="background-color: #0F3077; color:#DFF8FD">
                        <i class="fas fa-phone mr-2"></i>
                        +62 822-9556-2910
                    </button>
                    <button type="button" class="form-control btn btn-lg rounded-pill px-2 my-2 w-75 shadow no-border" style="background-color: #0F3077; color:#DFF8FD ">
                        <i class="fas fa-envelope mr-2"></i>
                        <a href="mailto:bimbelsinarprestasi@gmail.com" target="_blank" style="color: #ffffff; text-decoration: none;"> bimbelsinarprestasi@gmail.com</a>
                    </button>

                    <button type="button" class="form-control btn btn-lg rounded-pill px-2 my-2 w-75 shadow no-border" style="background-color: #60D669; color: #ffffff;">
                        <i class="fab fa-whatsapp fa-bounce mr-2"></i>
                        <a style="color: #ffffff; text-decoration: none;" href="https://api.whatsapp.com/send?phone082295562910&text=Halo%20kak%20,%20Saya%20tertarik%20buat%20join%20bimbelnya%20kak." target="_blank">
                            Send Message
                        </a>
                    </button>

                    <button type="button" class="form-control btn btn-lg rounded-pill px-2 my-2 w-75 shadow no-border" style="background-color: #E1306C; color: #ffffff;">
                        <i class="fab fa-instagram fa-bounce mr-2"></i>
                        <a style="color: #ffffff; text-decoration: none;" href="https://www.instagram.com/bimbelsinarprestasi/." target="_blank"> Check Our Instagram</a>
                    </button>


                    <button type="button" class="form-control btn btn-lg rounded-pill px-4 my-4 w-75" style="background-color: #ffffff; color: #0092ff; border: 2px solid black ;">
                        <i class="fab fa-facebook-f fa-shake mr-4"></i><a href="https://www.facebook.com/gaktausiapaya."> Check Our Facebook</a>
                        
                    </button>

                </div>
            </div>
        </div>


    </div>
@endsection


