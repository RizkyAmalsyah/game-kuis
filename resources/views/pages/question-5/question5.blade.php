@extends('layouts.app')

@section('title')
  Question-5
@endsection

@section('content')
  <main>
    <audio autoplay>
      <source src="{{ url('wawasan-umum-FE/assets/music/timer.mp3') }}" type="audio/mpeg">
    </audio>
    <div class="container">
      <div class="header-question p-3 mt-5">
        <div class="d-flex justify-content-between">
          <div class="head-soal">5/5</div>
          <progress id="file" value="100" max="100" style="width:1000px; height:70px;"></progress>
        </div>
      </div>
      <div class="image-content">
        @if ($item->photo_path == null)
          <img src="{{ url('images/question.jpg') }}" alt="" width="1300px" height="800px">
        @else
          <img src="{{ url('images/'.$item->photo_path) }}" alt="" width="1300px" height="800px">
        @endif        
      </div>
      <div class="question-content">
        <p class="text-center mb-5">{{ $item->name }}</p>
      </div>
      <div class="answer-content">
        <form action="{{ route('question-5-answer', $quiz->id) }}" method="post">
          @csrf
          <input type="number" name="time" id="timeout" value="10" hidden>
          <input type="number" name="question_id" value="{{ $item->id }}" hidden>
          <div class="row justify-content-center text-center">
            @foreach ($item->answer as $answer)
            <div class="answer col-6 mb-5">
              <button class="btn" name="answer" type="submit" value="{{ $answer->id }}">
                <div class="card justify-content-center">
                  {{ $answer->name }}
                </div>
              </button>
            </div>
            @endforeach
          </div>
        </form>
      </div>
      <div class="notes">
        @if ($data->score > 0)
          <div class="alert alert-danger rounded-4 text-center">
            Soal Terakhir Nih, Ayo Jawab Dengan Benar!
          </div>
        @else
          <div class="alert alert-danger rounded-4 text-center">
            Ayo Kamu Harus Benar di Soal Terakhir!
          </div>
        @endif
      </div>
      <div class="timer">
        <div class="timers"></div>
      </div>
    </div>
  </main>
@endsection

@push('addon-script')
<script>
  let i = 10;

  function countdown() {
    var timeoutInput = document.querySelector('#timeout');
    timeoutInput.value = i;
    
    if (i > 2) {
      i--;
    } else {
      clearInterval(intervalID); // Menghentikan interval saat i mencapai 1
    }
  }
  const intervalID = setInterval(countdown, 1000);
  
  setTimeout(function () {
      window.location.href= '{{ route('question-5-notime', $quiz->id) }}'; // the redirect goes here
    },10000);
</script>
@endpush
