@extends('layouts.admin')

@section('title', 'Review')

@section('content')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Feedback</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Feedback</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
          <div class="row">

            <div class="col-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">List Semua Feedback</h5>
                  <h5 class="card-title">{{ $items->count('id') }} Total Feedback & <i class="bi bi-star-fill star"></i> {{round($items->avg('rating'), 2)}}/5.0 Rating Feedback</h5>

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
                        <th scope="col">Quiz ID</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Tanggal Kasih Feedback</th>
                        <th scope="col">Jam Kasih Feedback</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($items as $key => $item)
                      <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->quiz_id }}</td>
                        <td>{{ $item->rating }}</td>
                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                        <td>{{ $item->created_at->format('H:i:s') }}</td>
                        <td>
                          <form action="{{ route('feedback.destroy', $item->id) }}" method="post" class="d-inline">
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