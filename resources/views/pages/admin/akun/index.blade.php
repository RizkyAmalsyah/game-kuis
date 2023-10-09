@extends('layouts.admin')

@section('title', 'Review')

@section('content')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Akun</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Akun</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
          <div class="row">

            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">List Semua Akun</h5>
                  <h5 class="card-title">{{ $items->count('id') }} Total Akun</h5>

                  @if (session('status'))
                    <div class="alert alert-primary mb-3">
                        {{ session('status') }}
                    </div>
                  @endif
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Tanggal Buat Akun</th>
                        <th scope="col">Skor</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($items as $key => $item)
                      <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $item->name }}</td>
                        <td><img src="https://api.multiavatar.com/{{ $item->name }}.png" width="60px" class="rounded-circle"></td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->quiz->sum('score') }}</td>
                        <td>
                          <form action="{{ route('user.destroy', $item->id) }}" method="post" class="d-inline">
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

  </main><!-- End #main -->
@endsection
