@extends('layouts.admin')

@section('title', 'Kuliner')

@section('content')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Pertanyaan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item">Pertanyaan</li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section-edit-kuliner">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Edit Pertanyaan</h5>
          @if (session('status'))
            <div class="alert alert-primary mb-3">
                {{ session('status') }}
            </div>
          @endif
          <form action="{{ route('question.update', $question->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group mb-3">
              <label for="name">Pertanyaan</label>
              <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $question->name }}">
            </div>
            <div class="row">
              @foreach ($question->answer as $item)
                <div class="col-6 form-group mb-3">
                  <label for="answer1">Jawaban 1</label>
                  <input type="text" name="answer1" class="form-control @error('answer1') is-invalid @enderror" value="{{ $item->name }}" disabled>
                </div>
              @endforeach
            </div>
            <img src="{{ url('images/'.$question->photo_path) }}" alt="" style="width: 250px" class="img-thumbnail"/>
          </div>
          <div class="ms-4 mb-4">
            {{-- <button type="submit" class="btn btn-primary" type="submit">Save changes</button> --}}
          </div>
        </form>
      </div>
    </section>
  </main><!-- End #main -->
@endsection

@push('addon-script')
<script>

  $(document).ready(function () {

  $('#province-dropdown-modal').on('change', function () {
      var idProvince = this.value;
      $("#city-dropdown-modal").html('');
      $.ajax({
          url: "{{url('api/fetch-cities')}}",
          type: "POST",
          data: {
              province_id: idProvince,
              _token: '{{csrf_token()}}'
          },
          dataType: 'json',
          success: function (res) {
              $('#city-dropdown-modal').html('<option value="">Kota Kuliner</option>');
              $.each(res.cities, function (key, value) {
                  $("#city-dropdown-modal").append('<option value="' + value.id + '">' + value.name + '</option>');
              });
          }
      });
  });

});
</script>
@endpush