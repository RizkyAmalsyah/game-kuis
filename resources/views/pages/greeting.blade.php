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
    <p class="fw-semibold text-center"><span id="waktu"></span>, {{ Auth::user()->name }}!</p>
    <p class="fw-semibold text-center">Apakah kamu sudah siap</br>bermain hari ini?</p>
  </div>
  <div class="content-greeting">
    <div class="header-content">
      <p class="judul-rule text-center fw-bold">Aturan Bermain</p>
    </div>
    <div class="contents">
      <ol>
        <li class="isi">Dalam satu game terdiri dari 5 soal</li>
        <li class="isi">Setiap soal dibatasi waktu selama 10 detik</li>
        <li class="isi">User hanya dapat memainkan game 1 kali dalam sehari</li>
        <li class="isi">Setiap soal memiliki batas waktu, dan jika melebihi waktunya maka jawaban tersebut otomotasi salah</li>
      </ol>
    </div>
  </div>
  <div class="gambar text-center">
    <img src="{{ url('wawasan-umum-FE/assets/img/greeting2.png') }}" alt="foto" width="1500px">
  </div>
  <form action="{{ route('quiz') }}" method="post">
    @csrf
    <div class="d-grid mx-5">
      <button class="start-greeting text-center fw-bold pb-3" type="submit">
        MULAI
      </button>
    </div>
  </form>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
    @csrf
    <button type="submit">Logout</button>
  </form>
</main>
@endsection

@push('addon-script')
  <script>
    $(document).ready(function() {

      var jam = new Date().getHours();
      var pukul = new Date().getHours() + ":" + new Date().getMinutes() + ":" + new Date().getSeconds();;
      var pesan;
      var pagi = ('Selamat Pagi');
      var siang = ('Selamat Siang');
      var sore = ('Selamat Sore');
      var malam = ('Selamat Malam');

      if (jam >= 6 && jam < 10) {
        pesan = pagi; 
      } else if (jam >= 10 && jam < 15) {
        pesan = siang;
      } else if (jam >= 15 && jam < 18) {
        pesan = sore;
      } else if (jam >= 18) {
        pesan = malam;
      }
      $('#waktu').append(pesan);
      $('#pukul').append(pukul);

    });

    function submitFormAndRedirect() {
        document.getElementById('logout-form').submit();
    }
    setTimeout(submitFormAndRedirect, 60000);
  </script>
@endpush
