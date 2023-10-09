@extends('layouts.admin')

@section('title', 'Review')

@section('content')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Favorite</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Favorite</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
          <div class="row">

            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">List Semua Favorite</h5>
                  <h5 class="card-title">{{ $total->count('id') }} Total Favorite</h5>

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
                        <th scope="col">Kuliner</th>
                        <th scope="col">Tanggal Buat</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($favorites as $item)
                      <tr>
                        <th>{{ $item->id }}</th>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->culinary->name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                          <form action="{{ route('favorite.destroy', $item->id) }}" method="post" class="d-inline">
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
                    <div class="d-flex justify-content-center">
                      {!! $favorites->links() !!}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </section>

  </main><!-- End #main -->
@endsection