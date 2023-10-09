@extends('layouts.app')

@section('title')
  Question-1-Result
@endsection

@section('content')
  <main>
    <div id="notif" style="">
      @if ($item->score > 0)
        <audio autoplay>
          <source src="{{ url('wawasan-umum-FE/assets/music/correct.mp3') }}" type="audio/mpeg">
        </audio>
        <div class="correct fixed-top text-center">
          <p class="title text-center">Benar!!!</p>
          <button class="btn point text-center rounded-pill fw-bold">
            {{ $item->score }}+ poin
          </button>
        </div>
      @endif
      @if ($item->score == 0)
        <audio autoplay>
          <source src="{{ url('wawasan-umum-FE/assets/music/false.mp3') }}" type="audio/mpeg">
        </audio>
        <div class="incorrect fixed-top text-center">
          <p class="title text-center">Salah!!!</p>
          <button class="btn point text-center rounded-pill fw-bold">
            {{ $item->score }}+ poin
          </button>
        </div>
      @endif
    </div>
    <div class="container">
      <div class="header-question p-3 mt-5">
        <div class="d-flex justify-content-between">
          <div class="head-soal">1/5</div>
          <progress id="file" value="20" max="100" style="width:1000px; height:70px;"></progress>
        </div>
      </div>
      <div class="image-content">
        @if ($item->question->photo_path == null)
          <img src="{{ url('images/question.jpg') }}" alt="" width="1300px" height="800px">
        @else
          <img src="{{ url('images/'.$item->question->photo_path) }}" alt="" width="1300px" height="800px">
        @endif
      </div>
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
      <div class="next">
        <a class="btn next text-center rounded-pill fw-bold" href="{{ route('question-2', $item->quiz->id) }}">
          Lanjut
        </a>
      </div>
    </div>
  </main>

@endsection

@push('addon-script')
  <script>
    setTimeout(function() {
      $('#notif').fadeOut('slow');
    }, 2500);

    setTimeout(function () {
      window.location.href= '{{ route('question-2', $item->quiz->id) }}'; // the redirect goes here
    },10000);
  </script>
@endpush