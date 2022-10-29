<nav class="navbar navbar-expand-lg navbar-dark fw-bold @if (isset($navbar_bg)){{ $navbar_bg }}@else bg-danger @endif">
    <div class="container">
        @if (isset($go_back))
        <img class="w-0_8rem me-3" src="{{ asset('img/icons/back-button-white.svg') }}" alt="" onclick="goBack();">
        @endif
        @if (isset($title))
        <div class="navbar-brand">{{ $title }}</div>
        @else
        {{-- <a class="navbar-brand" href="{{ route('Home') }}">MC-Parts SS</a> --}}
        @endif
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            {{-- <a class="nav-link" aria-current="page" href="{{ route('Home') }}">Home</a> --}}
            <a class="nav-link" href="{{ route('Home') }}" style="color: white">Home</a>
          </li>

          @if (isset($menus))
              @foreach ($menus as $menu)
              @if (isset($menu['params']))
              @if (isset($menu['confirm']))
              <li class="nav-item ms-1">
                @if (isset($menu['parameters']))
                <form action="{{ route($menu['route'],$menu['parameters']) }}" method="{{ $menu['method'] }}" onsubmit="return confirm('{{ $menu['confirm'] }}')">
                @else
                <form action="{{ route($menu['route']) }}" method="{{ $menu['method'] }}" onsubmit="return confirm('{{ $menu['confirm'] }}')">
                @endif
                    @csrf
                    @foreach ($menu['params'] as $param)
                    <input type="hidden" name="{{ $param['name'] }}" value="{{ $param['value'] }}">
                    @endforeach
                    <button type="submit" class="nav-link btn btn-danger fw-bold" style="color: white">{{ $menu['nama'] }}</button>
                </form>
              </li>
              @else
              <li class="nav-item ms-1">
                @if (isset($menu['parameters']))
                <form action="{{ route($menu['route'],$menu['parameters']) }}" method="{{ $menu['method'] }}">
                @else
                <form action="{{ route($menu['route']) }}" method="{{ $menu['method'] }}">
                @endif
                    @foreach ($menu['params'] as $param)
                    <input type="hidden" name="{{ $param['name'] }}" value="{{ $param['value'] }}">
                    @endforeach
                    <button type="submit" class="nav-link btn btn-danger fw-bold" style="color: white">{{ $menu['nama'] }}</button>
                </form>
              </li>
              @endif
              @else
              <li class="nav-item ms-1">
                <a href="{{ route($menu['route']) }}" class="nav-link btn btn-danger fw-bold" style="color: white">{{ $menu['nama'] }}</a>
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

      {{-- <div class="nav-item dropdown">
          <div class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="dot"></div>
              <div class="dot mt-1"></div>
              <div class="dot mt-1"></div>
          </div>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <form class="dropdown-item" action="/nota/nota-print-out" method="GET">
                    <button id="downloadExcel" type="submit" class="threeDotMenuItem">
                        <img src="/img/icons/download.svg" style="width: 1rem" alt=""><span>Print Out Nota</span>
                    </button>
                    <input type="hidden" name="nota_id" value={{ $nota['id'] }}>
                </form>
                <form class="dropdown-item" action="/nota/nota-hapus" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Nota ini?');">
                    @csrf
                    <button type="submit" class="threeDotMenuItem" style="width: 100%">
                        <img src="/img/icons/trash-can.svg" alt="" style="width: 1rem"><span>Hapus Nota</span>
                    </button>
                    <input type="hidden" name="nota_id" value={{ $nota['id'] }}>
                </form>
            </div>
      </div> --}}
        {{-- <div class="threeDotMenu" style="z-index:200">
            <div class="threeDot">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
            <div class="divThreeDotMenuContent">
                <form action="/nota/nota-print-out" method="GET">
                    <button id="downloadExcel" type="submit" class="threeDotMenuItem">
                        <img src="/img/icons/download.svg" style="width: 1rem" alt=""><span>Print Out Nota</span>
                    </button>
                    <input type="hidden" name="nota_id" value={{ $nota['id'] }}>
                </form>
                <form action="/nota/nota-hapus" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Nota ini?');">
                    @csrf
                    <button type="submit" class="threeDotMenuItem" style="width: 100%">
                        <img src="/img/icons/trash-can.svg" alt="" style="width: 1rem"><span>Hapus Nota</span>
                    </button>
                    <input type="hidden" name="nota_id" value={{ $nota['id'] }}>
                </form>
            </div>
        </div> --}}
    </div>
  </nav>
