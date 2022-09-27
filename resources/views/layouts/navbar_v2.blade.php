<header class="header d-flex justify-content-between pt-3 pb-3">
    <div>
        <img class="w-0_8rem ml-1_5rem" src="{{ asset('img/icons/back-button-white.svg') }}" alt="" onclick="goBack();">
        <a class="fw-bold ms-3" href="{{ route('Home') }}" style="color: white">Home</a>
    </div>
    <div>
        @if (isset($menus))
            @foreach ($menus as $menu)
            @if (isset($menu['params']))
            @if (isset($menu['confirm']))
            <form action="{{ route($menu['route']) }}" method="{{ $menu['method'] }}" onsubmit="return confirm('{{ $menu['confirm'] }}')">
                @csrf
                @foreach ($menu['params'] as $param)
                <input type="hidden" name="{{ $param['name'] }}" value="{{ $param['value'] }}">
                @endforeach
                <button type="submit" class="btn-lonjong-kuning">{{ $menu['nama'] }}</button>
            </form>
            @else
            <form action="{{ route($menu['route']) }}" method="{{ $menu['method'] }}">
                @csrf
                @foreach ($menu['params'] as $param)
                <input type="hidden" name="{{ $param['name'] }}" value="{{ $param['value'] }}">
                @endforeach
                <button type="submit" class="btn-lonjong-kuning">{{ $menu['nama'] }}</button>
            </form>
            @endif
            @else
            <a href="{{ route($menu['route']) }}" class="btn-lonjong-kuning">{{ $menu['nama'] }}</a>
            @endif
            @endforeach
        @endif
    </div>
</header>

@if (isset($judul))
<h2>{{ $judul }}</h2>
@endif
