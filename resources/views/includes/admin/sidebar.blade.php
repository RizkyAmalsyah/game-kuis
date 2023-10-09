  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <div class="header-sidebar">
      <h5 class="text-center fw-bold">{{ Auth::user()->role }}</h5>
      <h5 class="text-center">{{ Auth::user()->unit }}</h5>
      <hr>
    </div>

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ (request()->is('admin')) ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
          <i class="bi bi-speedometer2"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ (request()->is('admin/question')) ? '' : 'collapsed' }}" href="{{ route('question.index') }}">
          <i class="bi bi-grid"></i><span>Pertanyaan</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link {{ (request()->is('admin/quiz')) ? '' : 'collapsed' }}" href="{{ route('quiz.index') }}">
          <i class="bi bi-list-task"></i><span>Kuis</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ (request()->is('admin/user')) ? '' : 'collapsed' }}" href="{{ route('user.index') }}">
          <i class="bi bi-chat-left-quote"></i></i></i><span>Ranking Akun</span>
        </a>
      </li>

      {{-- <li class="nav-item">
        <a class="nav-link {{ (request()->is('')) ? '' : 'collapsed' }}" href="">
          <i class="bi bi-box2-heart"></i></i><span>Favorite</span>
        </a>
      </li> --}}

      <hr>

      <li class="nav-item">
        <form class="" action="{{ url('logout') }}" method="POST">
          @csrf
          <div class="text-center d-grid">
            <button class="btn btn-light collapsed" href="#">
              <i class="bi bi-box-arrow-left"></i>
              <span>Logout</span>
            </button>
          </div>
        </form>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->