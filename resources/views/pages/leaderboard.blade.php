@extends('layouts.app')

@section('title')
  Home
@endsection

@section('content')
<audio autoplay loop>
  <source src="{{ url('wawasan-umum-FE/assets/music/leaderboard.mp3') }}" type="audio/mpeg">
</audio>
<main class="">
    <div class="header headeer-leader text-center">
      <img class="crown" src="{{ url('wawasan-umum-FE/assets/img/crown.png') }}" width="700px" alt="crown">
      <p class="fw-bold text-center title">PAPAN PERINGKAT</p>
      <p class="sub-title">10 Pemenang Teratas</p>
    </div>
    <div class="content-leader mt-3">
      <div class="row leader text-center">
        @foreach ($ranking2 as $key => $ranking2s)
        <div class="col d-inline p-2 juara2">
            <img src="{{ url('wawasan-umum-FE/assets/img/juara2-removebg.png') }}" class="juara-2 mb-4" alt="juara-1" width="200px">
            <div class="img img-juara2">
              <img class="rounded-circle" src="https://api.multiavatar.com/{{ $ranking2s->name }}.png" alt="juara-2">
            </div>
            {{-- <img class="cup-2" src="{{ url('wawasan-umum-FE/assets/img/cup-2.png') }}" alt="piala-2"> --}}
            <p class="name fw-bold">{{ $ranking2s->name }}</p>
            <p class="score fw-bold">{{ $ranking2s->quiz->sum('score') }}</p>
          </div>
        @endforeach
        @foreach ($ranking1 as $key => $ranking1s)
          <div class="col d-inline p-2 juara1">
            <img src="{{ url('wawasan-umum-FE/assets/img/juara1-removebg.png') }}" class="mb-4" alt="juara-1" width="250px">
            <div class="img img-juara1">
              <img class="rounded-circle" src="https://api.multiavatar.com/{{ $ranking1s->name }}.png" alt="juara-1">
            </div>
            {{-- <img class="cup-1" src="{{ url('wawasan-umum-FE/assets/img/cup-1.png') }}" alt="piala-1"> --}}
            <p class="name fw-bold">{{ $ranking1s->name }}</p>
            <p class="score fw-bold">{{ $ranking1s->quiz->sum('score') }}</p>
          </div>
          @endforeach
          @foreach ($ranking3 as $key => $ranking3s)
          <div class="col d-inline p-2 juara3">
            <img src="{{ url('wawasan-umum-FE/assets/img/juara3-removebg.png') }}" class="juara-3 mb-4" alt="juara-1" width="200px">
            <div class="img img-juara3">
              <img class="rounded-circle" src="https://api.multiavatar.com/{{ $ranking3s->name }}.png" alt="juara-3">
            </div>
            {{-- <img class="cup-3" src="{{ url('wawasan-umum-FE/assets/img/cup-3.png') }}" alt="piala-3"> --}}
            <p class="name fw-bold">{{ $ranking3s->name }}</p>
            <p class="score fw-bold">{{ $ranking3s->quiz->sum('score') }}</p>
          </div>
        @endforeach
      </div>

      <table class="table table-borderless ranking mt-5 mx-5">
        @foreach ($quizs as $key => $quizsa)
          <tr class="d-flex align-items-center mb-5">
            <td class="rank">
              {{ $key + 4 }}
            </td>
            <td class="img"><img src="https://api.multiavatar.com/{{ $quizsa->name }}.png" width="160px" class="rounded-circle"></td>
            <td class="name">{{ $quizsa->name }}</td>
            <td class="score">{{ $quizsa->quiz->sum('score') }}</td>
          </tr>
          @endforeach
      </table>

      <div class="d-grid play mb-5 px-5">
        <button class="btn btn-light btn-lg rounded-5" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">MAIN</button>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-5 p-5">
          <div class="log-reg text-center mt-4 mb-3">
            <button class="btn btn-for-login btn-light btn-lg rounded-pill fw-medium" id="btn-login" type="button">MASUK</button>
            <button class="btn btn-for-login btn-light btn-lg rounded-pill fw-medium" id="btn-register" type="button">DAFTAR</button>
          </div>
          @if ($errors->any())
            <div class="alert alert-danger m-3 rounded-3">
              <ul class="error">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <div class="form-login p-5 px-5">
            @error('title')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror 
            <form action="{{ route('login') }}" method="POST" id="for-login" style="display:block;">
              @csrf
              <div class="mb-4">
                <input type="name" name="name" class="form-control input rounded-pill" id="name-login" placeholder="Nama">
                {{-- <label for="floatingInput">Nama</label> --}}
              </div>
              <div class="mb-3">
                <input type="password" name="password" class="form-control input rounded-pill" id="pin-login" placeholder="PIN">
                {{-- <label for="floatingPassword">PIN</label> --}}
              </div>
              <div class="d-grid gap-2">
                <button class="btn submit btn-light btn-lg rounded-pill px-5 p-4 fw-semibold mt-5" type="submit">MASUK</button>
              </div>
            </form>
            <form action="{{ route('register') }}" method="POST" id="for-register" style="display:none;">
              @csrf
              {{-- <div class="camera text-center mb-5">
                <video id="video" class="video">Video stream tidak ditemukan.</video>
              </div> --}}
              <div class="mb-4">
                <input type="name" name="name" class="form-control input rounded-pill" id="floatingInput" placeholder="Nama">
                {{-- <label for="floatingInput">Nama</label> --}}
              </div>
              <div class="mb-3">
                <input type="password" name="password" class="form-control input rounded-pill" id="floatingPassword" placeholder="PIN">
                {{-- <label for="floatingPassword">PIN</label> --}}
              </div>
              <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control input rounded-pill" id="password_confirmation" placeholder="Ulang PIN" autocomplete="new-password">
                {{-- <label for="floatingPassword">Konfirmasi PIN</label> --}}
              </div>
              {{-- <div class="d-grid gap-2 mt-4">
                <button class="photo rounded-pill p-4" id="startbutton">
                  Ambil Foto
                  <i class="bi bi-camera-fill"></i>
                </button>
              </div>
              <canvas id="canvas" class="canvas d-none"></canvas>
              <div class="output text-center mt-4">
                <input type="hidden" id="photo" name="photo">
                <img id="photo" class="rounded-4" alt="The screen capture will appear in this box.">
              </div> --}}
              <div class="d-grid gap-2">
                <button type="submit" class="btn submit btn-light btn-lg rounded-pill px-5 p-4 fw-semibold mt-5">DAFTAR</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="fixed-bottom-div">
          <div class="simple-keyboard"></div>
      </div>
    </div>
  </main>
@endsection