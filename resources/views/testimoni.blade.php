<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <title>Bimbingan Belajar Sinar Prestasi</title>

  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light py-3 px-5" style="background-color: #5DB6FA;">
        <div class="container-fluid">
            <a class="navbar-brand ml-auto" href="#">
                <img src="{{ asset('assets/logo.png') }}" width="36" height="36" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-light" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/testimoni">Testimoni</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-light" href="/login">Login</a> <!-- Tampilkan tautan login jika pengguna belum diautentikasi -->
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid full-screen-image" style="background-image: url('/assets/background.png'); background-size: cover;">
      <!-- judul -->
      <div
        class="row"
        style="
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 2rem;
        "
      >
        <div style="width: 24rem; text-align: center">
          <h style="font-size: 26px"
            ><strong>Respon Positif</strong> pengguna Bimbel Sinar Prestasi</h>
        </div>
      </div>
      <!-- cardGuru -->
      <div style="overflow: auto; padding-left: 5rem; scrollbar-width: none">
        <div style="width: 120%">
          <div class="row">
            <div
              class="card"
              style="
                width: 328px;
                height: 256px;
                border-radius: 15px;
                padding: 5px;
                margin-right: 2rem;
              "
            >
              <div class="card-body">
                <div class="row justify-content-start align-items-center">
                  <div class="col-4">
                    <img
                      src="assets/unsplash_pg_WCHWSdT8.png"
                      style="width: 80px; height: 80px"
                      class="rounded-circle"
                    />
                  </div>
                  <div class="col-8">
                    <h
                      class="card-title"
                      style="font-size: 18px; font-weight: bold"
                      >Ria Lestari</h
                    ><br />
                    <h
                      class="card-title"
                      style="
                        font-size: 12px;
                        font-weight: 500;
                        color: #00000087;
                      "
                    >
                      PNS Guru DKI Jakarta </h
                    ><br />
                    <h
                      class="card-title"
                      style="font-size: 12px; color: #565656"
                    >
                      Lulus CPNS 2020
                    </h>
                  </div>
                </div>
                <p></p>
                <p style="font-size: 12px; color: #565656; text-align: justify">
                  Alhamdulillah sempat down ketika melihat nilai hasil SKD yang
                  berada di urutan kedua dan selisi cukup besar dengan urutan
                  pertama, namun saya tetap berikhtiar dan ikut bimbel SKB di
                  Sukses CPNS, Alhamdulillah saya bisa menyalip pesaing saya,
                  menjadi urutan nomer pertama.
                </p>
              </div>
            </div>
            <div
              class="card"
              style="
                width: 328px;
                height: 256px;
                border-radius: 15px;
                padding: 5px;
                margin-right: 2rem;
              "
            >
              <div class="card-body">
                <div class="row justify-content-start align-items-center">
                  <div class="col-4">
                    <img
                      src="assets/unsplash_pg_WCHWSdT8 (1).png"
                      style="width: 80px; height: 80px"
                      class="rounded-circle"
                    />
                  </div>
                  <div class="col-8">
                    <h
                      class="card-title"
                      style="font-size: 18px; font-weight: bold"
                      >Refal Fadly</h
                    ><br />
                    <h
                      class="card-title"
                      style="
                        font-size: 12px;
                        font-weight: 500;
                        color: #00000087;
                      "
                    >
                      PNS Bandung </h
                    ><br />
                    <h
                      class="card-title"
                      style="font-size: 12px; color: #565656"
                    >
                      Lulus CPNS 2020
                    </h>
                  </div>
                </div>
                <p></p>
                <p style="font-size: 12px; color: #565656; text-align: justify">
                  Alhamdulillah sempat down ketika melihat nilai hasil SKD yang
                  berada di urutan kedua dan selisi cukup besar dengan urutan
                  pertama, namun saya tetap berikhtiar dan ikut bimbel SKB di
                  Sukses CPNS, Alhamdulillah saya bisa menyalip pesaing saya,
                  menjadi urutan nomer pertama.
                </p>
              </div>
            </div>
            <div
              class="card"
              style="
                width: 328px;
                height: 256px;
                border-radius: 15px;
                padding: 5px;
                margin-right: 2rem;
              "
            >
              <div class="card-body">
                <div class="row justify-content-start align-items-center">
                  <div class="col-4">
                    <img
                      src="assets/unsplash_pg_WCHWSdT8.png"
                      style="width: 80px; height: 80px"
                      class="rounded-circle"
                    />
                  </div>
                  <div class="col-8">
                    <h
                      class="card-title"
                      style="font-size: 18px; font-weight: bold"
                      >Ria Lestari</h
                    ><br />
                    <h
                      class="card-title"
                      style="
                        font-size: 12px;
                        font-weight: 500;
                        color: #00000087;
                      "
                    >
                      PNS Guru DKI Jakarta </h
                    ><br />
                    <h
                      class="card-title"
                      style="font-size: 12px; color: #565656"
                    >
                      Lulus CPNS 2020
                    </h>
                  </div>
                </div>
                <p></p>
                <p style="font-size: 12px; color: #565656; text-align: justify">
                  Alhamdulillah sempat down ketika melihat nilai hasil SKD yang
                  berada di urutan kedua dan selisi cukup besar dengan urutan
                  pertama, namun saya tetap berikhtiar dan ikut bimbel SKB di
                  Sukses CPNS, Alhamdulillah saya bisa menyalip pesaing saya,
                  menjadi urutan nomer pertama.
                </p>
              </div>
            </div>
            <div
              class="card"
              style="
                width: 328px;
                height: 256px;
                border-radius: 15px;
                padding: 5px;
                margin-right: 2rem;
              "
            >
              <div class="card-body">
                <div class="row justify-content-start align-items-center">
                  <div class="col-4">
                    <img
                      src="assets/unsplash_pg_WCHWSdT8 (1).png"
                      style="width: 80px; height: 80px"
                      class="rounded-circle"
                    />
                  </div>
                  <div class="col-8">
                    <h
                      class="card-title"
                      style="font-size: 18px; font-weight: bold"
                      >Refal Fadly</h
                    ><br />
                    <h
                      class="card-title"
                      style="
                        font-size: 12px;
                        font-weight: 500;
                        color: #00000087;
                      "
                    >
                      PNS Bandung </h
                    ><br />
                    <h
                      class="card-title"
                      style="font-size: 12px; color: #565656"
                    >
                      Lulus CPNS 2020
                    </h>
                  </div>
                </div>
                <p></p>
                <p style="font-size: 12px; color: #565656; text-align: justify">
                  Alhamdulillah sempat down ketika melihat nilai hasil SKD yang
                  berada di urutan kedua dan selisi cukup besar dengan urutan
                  pertama, namun saya tetap berikhtiar dan ikut bimbel SKB di
                  Sukses CPNS, Alhamdulillah saya bisa menyalip pesaing saya,
                  menjadi urutan nomer pertama.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- iklan -->
      <div class="row" style="padding-top: 2rem; padding-left: 5rem; padding-right: 5rem">
        <div>
          <h style="font-size: 28px">Daftar sekarang untuk meraih masa depan yang bersinar dengan
            belajar intensif bersama
            <strong style="color: #0f3077"
              >Bimbingan Belajar Sinar Prestasi</strong
            ></h
          >
          <br />
        <a href="index.html" style="color: #1c4b8f; font-size: 20px; text-decoration: none; margin-top:2px">
            Klik untuk konsultasi
        </a>
        </div>
      </div>
      <!-- daftar -->
      <div
        class="row"
        style="
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 1rem;
        "
      >
        <div style="width: 28rem; text-align: center">
            <button
                type="button"
                class="btn btn-primary"
                style="font-size: 24px; width: 252px; border-radius: 20px; background-color: #2F6BB3">
                Daftar
            </button><br />
          <h class="fw-normal" style="font-size: 24px">Get Free Simulasi Test</h>
        </div>
      </div>
    </div>
    <!-- judul -->
    <div
      class="container-fluid"
      style="background-color: #d9d9d980; width: 100%; height: 4rem"
    >
      <!-- judul -->
      <div style="display: flex; justify-content: center">
        <div style="width: 24rem; text-align: center">
          <h style="font-size: 24px; color: #0f3077">Alumni Sinar Prestasi</h>
        </div>
      </div>
    </div>
    <!-- daftar alumni -->
    <div class="container-fluid" style="background-color: #d9d9d950">
      <div
        class="row"
        style="
          width: 100%;
          height: 200px;
          display: flex;
          justify-content: center;
          align-items: center;
        "
      >
        <div style="width: 150px; height: 200px">
          <img
            src="https://via.placeholder.com/155x155"
            style="
              width: 100%;
              height: 155px;
              object-fit: unset;
              background-color: #5db6fa;
            "
          />
          <div
            style="
              padding-left: 5px;
              background-color: #5db6fa;
              width: 100%;
              height: 45px;
            "
          >
            <h style="font-size: 16px; font-weight: 500">Refal Fadly</h>
            <p style="font-size: 12px">PNS Guru Semarang</p>
          </div>
        </div>
        <div style="width: 150px; height: 200px">
          <img
            src="https://via.placeholder.com/155x155"
            style="
              width: 100%;
              height: 155px;
              object-fit: unset;
              background-color: #5db6fa;
            "
          />
          <div
            style="
              padding-left: 5px;
              background-color: #5db6fa;
              width: 100%;
              height: 45px;
            "
          >
            <h style="font-size: 16px; font-weight: 500">Lucy Irta</h>
            <p style="font-size: 12px">PNS Bandung</p>
          </div>
        </div>
        <div style="width: 150px; height: 200px">
          <img
            src="https://via.placeholder.com/155x155"
            style="
              width: 100%;
              height: 155px;
              object-fit: unset;
              background-color: #5db6fa;
            "
          />
          <div
            style="
              padding-left: 5px;
              background-color: #5db6fa;
              width: 100%;
              height: 45px;
            "
          >
            <h style="font-size: 16px; font-weight: 500">Refal Fadly</h>
            <p style="font-size: 12px">PNS Guru Semarang</p>
          </div>
        </div>
        <div style="width: 150px; height: 200px">
          <img
            src="https://via.placeholder.com/155x155"
            style="
              width: 100%;
              height: 155px;
              object-fit: unset;
              background-color: #5db6fa;
            "
          />
          <div
            style="
              padding-left: 5px;
              background-color: #5db6fa;
              width: 100%;
              height: 45px;
            "
          >
            <h style="font-size: 16px; font-weight: 500">Refal Fadly</h>
            <p style="font-size: 12px">PNS Guru Semarang</p>
          </div>
        </div>
        <div style="width: 150px; height: 200px">
          <img
            src="https://via.placeholder.com/155x155"
            style="
              width: 100%;
              height: 155px;
              object-fit: unset;
              background-color: #5db6fa;
            "
          />
          <div
            style="
              padding-left: 5px;
              background-color: #5db6fa;
              width: 100%;
              height: 45px;
            "
          >
            <h style="font-size: 16px; font-weight: 500">Refal Fadly</h>
            <p style="font-size: 12px">PNS Guru Semarang</p>
          </div>
        </div>
      </div>
      <br />
      <div
        class="row"
        style="
          width: 100%;
          height: 200px;
          display: flex;
          justify-content: center;
          align-items: center;
        "
      >
        <div style="width: 150px; height: 200px">
          <img
            src="https://via.placeholder.com/155x155"
            style="
              width: 100%;
              height: 155px;
              object-fit: unset;
              background-color: #5db6fa;
            "
          />
          <div
            style="
              padding-left: 5px;
              background-color: #5db6fa;
              width: 100%;
              height: 45px;
            "
          >
            <h style="font-size: 16px; font-weight: 500">Refal Fadly</h>
            <p style="font-size: 12px">PNS Guru Semarang</p>
          </div>
        </div>
        <div style="width: 150px; height: 200px">
          <img
            src="https://via.placeholder.com/155x155"
            style="
              width: 100%;
              height: 155px;
              object-fit: unset;
              background-color: #5db6fa;
            "
          />
          <div
            style="
              padding-left: 5px;
              background-color: #5db6fa;
              width: 100%;
              height: 45px;
            "
          >
            <h style="font-size: 16px; font-weight: 500">Refal Fadly</h>
            <p style="font-size: 12px">PNS Guru Semarang</p>
          </div>
        </div>
        <div style="width: 150px; height: 200px">
          <img
            src="https://via.placeholder.com/155x155"
            style="
              width: 100%;
              height: 155px;
              object-fit: unset;
              background-color: #5db6fa;
            "
          />
          <div
            style="
              padding-left: 5px;
              background-color: #5db6fa;
              width: 100%;
              height: 45px;
            "
          >
            <h style="font-size: 16px; font-weight: 500">Refal Fadly</h>
            <p style="font-size: 12px">PNS Guru Semarang</p>
          </div>
        </div>
        <div style="width: 150px; height: 200px">
          <img
            src="https://via.placeholder.com/155x155"
            style="
              width: 100%;
              height: 155px;
              object-fit: unset;
              background-color: #5db6fa;
            "
          />
          <div
            style="
              padding-left: 5px;
              background-color: #5db6fa;
              width: 100%;
              height: 45px;
            "
          >
            <h style="font-size: 16px; font-weight: 500">Refal Fadly</h>
            <p style="font-size: 12px">PNS Guru Semarang</p>
          </div>
        </div>
        <div style="width: 150px; height: 200px">
          <img
            src="https://via.placeholder.com/155x155"
            style="
              width: 100%;
              height: 155px;
              object-fit: unset;
              background-color: #5db6fa;
            "
          />
          <div
            style="
              padding-left: 5px;
              background-color: #5db6fa;
              width: 100%;
              height: 45px;
            "
          >
            <h style="font-size: 16px; font-weight: 500">Refal Fadly</h>
            <p style="font-size: 12px">PNS Guru Semarang</p>
          </div>
        </div>
      </div>
      <br />
    </div>
  </body>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"
  ></script>
</html>
