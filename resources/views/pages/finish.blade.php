@extends('layouts.app')

@section('title')
  Finish
@endsection

@section('content')
<main>
  <audio autoplay>
    <source src="{{ url('wawasan-umum-FE/assets/music/finish.mp3') }}" type="audio/mpeg">
  </audio>
  <div class="header-greet text-center">
    <p class="head-title fw-bold">QuickPlay</p>
    <p class="fw-semibold text-center">Selamat {{ Auth::user()->name }}, poin kamu bertambah🎉</p>
  </div>
  <div class="content-greeting">
    <div class="header-content">
      <p class="judul-rule text-center fw-bold">Poin kamu hari ini</p>
    </div>
    <div class="contents text-center">
      <p class="text-black header-finish fw-medium"><span class="head-finish-title fw-bold">+{{ $poin }} </span> poin</p>
    </div>
  </div>
  <div class="gambar-finish text-center">
    <img src="{{ url('wawasan-umum-FE/assets/img/finish.png') }}" alt="foto" width="1300px">
  </div>
  <div class="text-center d-grid gap-2 mx-5">
      <a href="{{ route('finish-end', $quiz->id) }}" class="start-greeting text-center fw-bold pt-4">Selesai</a>
  </div>
</main>
@endsection

@push('addon-script')
  <script>
    setTimeout(function () {
      window.location.href= '{{ route('finish-end', $quiz->id) }}'; // the redirect goes here
    },10000);
  </script>
@endpush