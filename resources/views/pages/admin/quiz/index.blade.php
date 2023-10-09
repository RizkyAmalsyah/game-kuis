@extends('layouts.admin')

@section('title', 'Review')

@section('content')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Kuis</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Kuis</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section search" data-aos="fade-down" data-aos-duration="800">
      <div class="card info-card">
        <div class="card-body">
          <h5 class="card-title">Hapus Kuis Berdasarkan Tanggal</h5>

          <form action="{{ route('quiz.destroys') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-lg-5 col-md-6">
                  <div class="input-group mb-3">
                    <input type="date" class="form-control" placeholder="Semua Makanan" name="firstdate"/>
                  </div>
              </div>
              <div class="col-lg-5 col-md-6">
                <div class="input-group mb-3">
                  <input type="date" class="form-control" placeholder="Semua Makanan" name="lastdate"/>
                </div>
            </div>
              <div class="col-lg-2 d-grid">
                <button class="btn btn-danger tombol" type="submit">HAPUS</button>
              </div>
            </div>
          </form>
            
        </div>
      </div>
    </section>

    <section class="section dashboard">
          <div class="row">

            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">List Semua Kuis Diambil</h5>
                  <h5 class="card-title">{{ $items->count('id') }} Total Kuis</h5>

                  @if (session('status'))
                    <div class="alert alert-primary mb-3">
                        {{ session('status') }}
                    </div>
                  @endif
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">User</th>
                        <th scope="col">Skor</th>
                        <th scope="col">Tanggal Ambil Kuis</th>
                        <th scope="col">Jam Ambil Kuis</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($items as $key => $item)
                      <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->score }}</td>
                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                        <td>{{ $item->created_at->format('H:i:s') }}</td>
                        <td>
                          <form action="{{ route('quiz.destroy', $item->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                              <button class="btn btn-danger text-white rounded"><i class="bi bi-trash-fill"></i> Hapus</button>
                          </form>
                        </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="mb-3">
                  </div>
                </div>
              </div>
            </div>
          </div>
    </section>

  </main><!-- End #main -->
@endsection