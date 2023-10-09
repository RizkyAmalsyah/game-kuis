@extends('layouts.app')

@section('title')
  Greeting
@endsection

@section('content')
<main>
  <audio autoplay>
    <source src="{{ url('wawasan-umum-FE/assets/music/greeting.mp3') }}" type="audio/mpeg">
  </audio>
  <div class="header-greet text-center">
    <p class="head-title fw-bold">QuickPlay</p>
    <p class="fw-semibold text-center">Maaf, {{ Auth::user()->name }}!</p>
    <p class="fw-semibold text-center">Kamu sudah bermain hari ini</br>Silahkan coba lagi besok</p>
  </div>
  <div class="content-greeting">
    <div class="header-content">
      <p class="judul-rule text-center fw-bold">Aturan Bermain</p>
    </div>
    <div class="contents">
      <ol>
        <li class="isi">Dalam satu game terdiri dari 5 soal</li>
        <li class="isi">Setiap soal dibatasi waktu selama 10 detik</li>
        <li class="isi fw-bold">User hanya dapat memainkan game 1 kali dalam sehari</li>
        <li class="isi">Setiap soal memiliki batas waktu, dan jika melebihi waktunya maka jawaban tersebut otomotasi salah</li>
      </ol>
    </div>
  </div>
  <div class="gambar text-center">
    <img src="{{ url('wawasan-umum-FE/assets/img/greeting2.png') }}" alt="foto" width="1500px">
  </div>
  <form id="logout-form" action="{{ route('logout') }}" method="post">
    @csrf
    <div class="d-grid">
      <button class="start-greeting rounded-5 text-center fw-bold pb-3" type="submit">
        KELUAR
      </button>
    </div>
  </form>
</main>
@endsection

@push('addon-script')
  <script>
    function submitFormAndRedirect() {
        document.getElementById('logout-form').submit();
    }

    setTimeout(submitFormAndRedirect, 12000);
  </script>
@endpush
