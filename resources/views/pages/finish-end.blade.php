@extends('layouts.app')

@section('title')
  Finish-End
@endsection

@section('content')
{{-- <main>
  <p class="title-finish fw-bold text-center px-5">Poin kuiz yang kamu dapatkan di minggu ini sebesar:</p>
  <div class="text-center">
    <button class="div-point text-center fw-bold">{{ $erescore }} + {{ $nowscore}}</br><span class="angka">{{ $totalscore }}</span> Poin</button>
  </div>
  <div class="text-center">
    <form class="" id="logout-form" action="{{ url('logout') }}" method="POST">
      @csrf
      <button class="div-finish text-center rounded-pill fw-bold">Selesai</button>
    </form>
  </div>
</main> --}}

<main>
  <audio autoplay>
    <source src="{{ url('wawasan-umum-FE/assets/music/applause.mp3') }}" type="audio/mpeg">
  </audio>
  <p class="title-finish fw-bold text-center px-5"><span class="title-finish-end">Poin dan Peringkat Kuis Kamu</span><br>Di Minggu Ini</p>
  <div class="content">
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
      @foreach ($rankingu as $key => $rankingyou)
        <tr class="d-flex align-items-center mb-5 your-rank p-4">
          <td class="rank">
            {{ $userranking }}
          </td>
          <td class="img"><img src="https://api.multiavatar.com/{{ $rankingyou->name }}.png" width="160px" class="rounded-circle"></td>
          <td class="name">{{ $rankingyou->name }}</td>
          <td class="score">{{ $rankingyou->quiz->sum('score') }}</td>
        </tr>
      @endforeach
    </table>

    
    <div class="d-grid play mb-5 px-5 text-center">
      <button class="div-finish text-center rounded-5 fw-bold" id="show-sweetalert">Ambil Hadiah</button>
    </div>

    <form id="logout-form" action="{{ url('logout') }}" method="POST" hidden>
      @csrf
      <div class="d-grid play mb-5 px-5 text-center">
        <button class="div-finish text-center rounded-5 fw-bold">Selesai</button>
      </div>
    </form>
  </div>
</main>
@endsection

@push('addon-script')
  <script>
    // function submitFormAndRedirect() {
    //     document.getElementById('logout-form').submit();
    // }
    // setTimeout(submitFormAndRedirect, 60000);

    document.getElementById("show-sweetalert").addEventListener("click", function () {
      Swal.fire({
        title: 'Selamat Telah Mengikuti Kuis',
        text: "Silahkan Klik Lanjut Untuk Ambil Hadiah Kamu",
        imageUrl: '{{ url('wawasan-umum-FE/assets/img/sweetaleert.gif') }}',
        imageWidth: 1000,
        imageHeight: 800,
        imageAlt: 'Custom image',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Keluar',
        confirmButtonText: 'Lanjut'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href= '{{ route('finish', $quiz->id) }}'; // the redirect goes here
        }
        else {
          document.getElementById('logout-form').submit();
        }
      })
    })
  </script>
@endpush