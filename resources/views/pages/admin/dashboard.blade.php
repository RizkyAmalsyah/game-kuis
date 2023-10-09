@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <div class="col-lg-6 col-md-6">
                <a href="">
                <div class="card info-card icon-card">
                  <div class="card-body">
                    <h5 class="card-title">Total Kuis Diambil</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-bookmark-plus"></i>
                      </div>
                      <div class="ps-3">
                        <h6 class="title-card-dashboard">{{ $quiz }} Kuis</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-6 col-md-6">
              <a href="">
                <div class="card info-card icon-card">
                  <div class="card-body">
                    <h5 class="card-title">Total Registrasi Akun</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                      </div>
                      <div class="ps-3">
                        <h6 class="title-card-dashboard"> {{ $user }} Pengguna</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-6 col-md-6">
              <a href="">
                <div class="card info-card icon-card">
                  <div class="card-body">
                    <h5 class="card-title">Total Pertanyaan</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-list-task"></i>
                      </div>
                      <div class="ps-3">
                        <h6 class="title-card-dashboard">{{ $question }} Pertanyaan</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-6 col-md-6">
              <a href="">
                <div class="card info-card icon-card">
                  <div class="card-body">
                    <h5 class="card-title">Total Kuis Diambil Minggu Ini</h5>
                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-bookmark-plus"></i>
                      </div>
                      <div class="ps-3">
                        <h6 class="title-card-dashboard">{{ $quiz_week }} Kuis</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

          </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->
@endsection