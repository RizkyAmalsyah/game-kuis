@extends('layouts.app')

@section('title')
  Question-2-NoTime
@endsection

@section('content')
  <main>
    <audio autoplay>
      <source src="{{ url('wawasan-umum-FE/assets/music/notime.mp3') }}" type="audio/mpeg">
    </audio>
    <div id="notif" style="">
        <div class="incorrect fixed-top text-center">
          <p class="title text-center">Kamu Kehabisan Waktu!!!</p>
          <button class="btn point text-center rounded-pill fw-bold">
            0+ poin
          </button>
        </div>
    </div>
    <div class="container">
      <div class="header-question p-3 mt-5">
        <div class="d-flex justify-content-between">
          <div class="head-soal">2/5</div>
          <progress id="file" value="40" max="100" style="width:1000px; height:70px;"></progress>
        </div>
      </div>
      <div class="image-content">
        @if ($item->question->photo_path == null)
          <img src="{{ url('images/question.jpg') }}" alt="" width="1300px" height="800px">
        @else
          <img src="{{ url('images/'.$item->question->photo_path) }}" alt="" width="1300px" height="800px">
        @endif      </div>
      <div class="question-content">
        <p class="text-center mb-5">{{ $quiz_name }}</p>
      </div>
      <div class="answer-content-correct">
        <div class="row g-5">
          @foreach ($answers as $answer)
          @if ($answer->is_correct == true)
            <button class="answer right col-6">
              <p class="icon text-end"><i class="bi bi-check-circle-fill"></i></p>
              <p class="name text-center">{{ $answer->name }}</p>
            </button>
          @endif
          @if ($answer->is_correct == false)
          <button class="answer false col-6">
            <p class="icon text-end"><i class="bi bi-x-circle-fill"></i></p>
            <p class="name text-center">{{ $answer->name }}</p>
          </button>
          @endif
          @endforeach
        </div>
      </div>
      <div class="alert alert-danger d-flex align-items-center alert-notime rounded-5" role="alert">
        <div class="text-center">
          <span id="count-down">10 </span> detik otomatis terkeluar dari game </br>
          Klik Lanjut untuk melanjutkan permainan 
        </div>
      </div>
      <div class="next">
        <a class="btn next text-center rounded-pill fw-bold" href="{{ route('question-3', $quiz) }}">
          Lanjut
        </a>
      </div>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
        @csrf
        <button type="submit">Logout</button>
    </form>
    </div>
  </main>

@endsection

@push('addon-script')
  <script>
    setTimeout(function() {
      $('#notif').fadeOut('slow');
    }, 2500);

    let timeLeft = 10;
    function updateTimer() {
        document.getElementById('count-down').textContent = timeLeft;
        timeLeft--;
        if (timeLeft < 0) {
            clearInterval(timerInterval);
            document.getElementById('countdown').textContent = 'Countdown: Time is up!';
        }
    }
    const timerInterval = setInterval(updateTimer, 1000);

    function submitFormAndRedirect() {
        document.getElementById('logout-form').submit();
    }

    setTimeout(submitFormAndRedirect, 12000);
  </script>
@endpush