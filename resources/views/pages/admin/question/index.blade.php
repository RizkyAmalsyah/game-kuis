@extends('layouts.admin')

@section('title', 'Kuliner')

@section('content')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Pertanyaan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Pertanyaan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
          <div class="row">
            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">List Semua Pertanyaan</h5>
                  <div class="d-flex justify-content-end mt-3 mb-3">
                    <button class="btn btn-primary inti" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-circle-fill"></i> Tambah Pertanyaan</button>
                  </div>
                  @if (session('status'))
                    <div class="alert alert-primary mb-3">
                        {{ session('status') }}
                    </div>
                  @endif
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Pertanyaan</th>
                        <th scope="col">Jawaban</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($items as $item)
                      <tr>
                        <th>{{ $item->id }}</th>
                        <td>
                          <img src="{{ url('images/'.$item->photo_path) }}" alt="" style="width: 250px" class="img-thumbnail"/>
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>
                          @foreach($item->answer->where('is_correct', 1) as $answer)
                          {{ $answer->name }}
                          @endforeach
                        </td>
                        <td>
                          <a href="{{ route('question.show', $item->id) }}" class="btn btn-warning text-white rounded"><i class="bi bi-pencil-fill"></i> Edit</a>
                          <form action="{{ route('question.destroy', $item->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                              <button class="btn btn-danger text-white rounded"><i class="bi bi-trash-fill"></i> Hapus</button>
                          </form>
                        </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </section>

    <!-- Modal -->
    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Input Pertanyaan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('question.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group mb-3">
                <label for="name">Pertanyaan</label>
                <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
              </div>
              <div class="mb-3">
                <label for="formFile" class="form-label">Gambar Pertanyaan</label>
                <input name="photo_path" class="form-control @error('photo_path') is-invalid @enderror" type="file" id="formFile" value="{{ old('photo_path') }}">
              </div>
              <div class="row">
                <div class="col-6 form-group mb-3">
                  <label for="answer1">Jawaban 1</label>
                  <input type="text" name="answer1" class="form-control @error('answer1') is-invalid @enderror" value="{{ old('answer1') }}">
                </div>
                <div class="col-6 form-group mb-3">
                  <label for="inputGroupSelect04">Jawaban Benar</label>
                  <select name="is_correct1" class="form-select @error('is_correct1') is-invalid @enderror">
                    <option value="0" selected>Salah</option>
                    <option value="1">Benar</option>
                  </select>
                </div>
                <div class="col-6 form-group mb-3">
                  <label for="answer2">Jawaban 2</label>
                  <input type="text" name="answer2" class="form-control @error('answer2') is-invalid @enderror" value="{{ old('answer2') }}">
                </div>
                <div class="col-6 form-group mb-3">
                  <label for="inputGroupSelect04">Jawaban Benar</label>
                  <select name="is_correct2" class="form-select @error('is_correct2') is-invalid @enderror">
                    <option value="0" selected>Salah</option>
                    <option value="1">Benar</option>
                  </select>
                </div>
                <div class="col-6 form-group mb-3">
                  <label for="answer3">Jawaban 3</label>
                  <input type="text" name="answer3" class="form-control @error('answer3') is-invalid @enderror" value="{{ old('answer3') }}">
                </div>
                <div class="col-6 form-group mb-3">
                  <label for="inputGroupSelect04">Jawaban Benar</label>
                  <select name="is_correct3" class="form-select @error('is_correct3') is-invalid @enderror">
                    <option value="0" selected>Salah</option>
                    <option value="1">Benar</option>
                  </select>
                </div>
                <div class="col-6 form-group mb-3">
                  <label for="answer4">Jawaban 4</label>
                  <input type="text" name="answer4" class="form-control @error('answer4') is-invalid @enderror" value="{{ old('answer4') }}">
                </div>
                <div class="col-6 form-group mb-3">
                  <label for="inputGroupSelect04">Jawaban Benar</label>
                  <select name="is_correct4" class="form-select @error('is_correct4') is-invalid @enderror">
                    <option value="0" selected>Salah</option>
                    <option value="1">Benar</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" type="submit">Save changes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main><!-- End #main -->
@endsection