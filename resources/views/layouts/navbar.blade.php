<nav class="navbar navbar-expand-lg navbar-dark fw-bold bg-danger">
    <div class="container">
        @if (isset($title))
        <div class="navbar-brand">{{ $title }}</div>
        @else
        <a class="navbar-brand" href="{{ route('Home') }}">MC-Parts SS</a>
        @endif
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('Home') }}">Home</a>
          </li>

          @if (isset($menus))
              @foreach ($menus as $menu)
              @if (isset($menu['params']))
              @if (isset($menu['alert']))
              <li class="nav-item">
                <form action="{{ route($menu['route']) }}" method="{{ $menu['method'] }}" onsubmit="return alert('{{ $menu['alert'] }}')">@csrf<button type="submit" class="nav-link btn" name="{{ $menu['params']['name'] }}" value="{{ $menu['params']['value'] }}">{{ $menu['nama'] }}</button></form>
              </li>
              @else
              <li class="nav-item">
                <form action="{{ route($menu['route']) }}" method="{{ $menu['method'] }}">@csrf<button type="submit" class="nav-link btn" name="{{ $menu['params']['name'] }}" value="{{ $menu['params']['value'] }}">{{ $menu['nama'] }}</button></form>
              </li>
              @endif
              @else
              <li class="nav-item">
                <a href="{{ route($menu['route']) }}" class="nav-link">{{ $menu['nama'] }}</a>
              </li>
              @endif
              @endforeach
          @endif
        </ul>
        {{-- <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> --}}
        <ul class="navbar-nav">
        @guest
          <li class="nav-item">
            <a href="/login" class="nav-link"><i class="bi bi-box-arrow-in-right"></i> Login</a>
          </li>

          @endguest
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Welcome, {{ auth()->user()->nama }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              {{-- <li><a class="dropdown-item" href="#">Action</a></li> --}}
              <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-window-reverse"></i> My Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">
                    <i class="bi bi-box-arrow-right"></i> Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
