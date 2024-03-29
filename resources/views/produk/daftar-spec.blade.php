@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container mt-2">
    <div class="d-flex align-items-center">
        <img src="{{ asset('img/icons/pencil.svg') }}" alt="" style="width: 2rem">
        <span class="fs-3 ms-2">Komponen Produk: {{ $tipe }}</span>
    </div>
</div>

<div class="container mt-2">
    <div class="d-flex align-items-center">
        <span class="fw-bold">Tambah Komponen Produk: {{ $tipe }}</span>
    </div>
</div>

<div class="container mt-2">
    <form action="{{ route('tambahSpecDB') }}" method="POST">
        @csrf
        <label for="ipt-nama">Nama {{ $tipe }}</label>
        <input id="ipt-nama" type="text" class="form-control" name="nama">
        @if ($tipe==='Bahan')
        <label for="grade_bahan" class="mt-2">Grade {{ $tipe }} (optional)</label>
        <select name="grade_bahan" id="grade_bahan" class="form-select">
            <option value="">-</option>
            <option value="A">A</option>
            <option value="B">B</option>
        </select>
        @endif
        {{-- Tidak semua tipe memiliki Harga --}}
        @if ($tipe=='Varian')
        <label for="ipt-kategori" class="mt-2">Kategori {{ $tipe }}</label>
        <input id="ipt-kategori" type="text" class="form-control" name="kategori">
        @else
        <label for="ipt-harga" class="mt-2">Harga {{ $tipe }}</label>
        <input id="ipt-harga" type="number" class="form-control" name="harga">
        @endif

        {{-- Validation: Penanganan Input Invalid --}}
        <input type="hidden" name="error" class="@error('error') is-invalid @enderror">
        @error('error')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        {{-- End: Pengananan Input Invalid --}}
        <input type="hidden" name="tipe" value="{{ $tipe }}">
        <button class="btn btn-warning mt-3">Tambah {{ $tipe }}</button>
    </form>
</div>

{{-- @php
    dump(session()->all())
@endphp --}}
@if (session()->has('_success') && session('_success')!=='' && session('_success')!==null)
<div class="container alert alert-success mt-2">
    {{ session('_success') }}
</div>
@endif
@if (session()->has('_warning') && session('_warning')!=='' && session('_warning')!==null)
<div class="container alert alert-warning mt-2">
    {{ session('_warning') }}
</div>
@endif
@if (session()->has('_error') && session('_error')!=='' && session('_error')!==null)
<div class="container alert alert-warning mt-2">
    {{ session('_error') }}
</div>
@endif

<div class="container mt-3">
    <h5>Daftar {{ $tipe }}:</h5>
    <table class="table-simple">
        <tr>
            <th>Nama {{ $tipe }}</th>
            <th>
                @if ($tipe==='Varian')
                Kategori
                @else
                Harga
                @endif
            </th>
            <th>Opsi</th>
        </tr>
        @if ($tipe==='Bahan')
        @for ($i = 0; $i < count($bahans); $i++)
        <tr>
            <td>{{ $bahans[$i]['nama'] }}</td>
            <td>@if ($bahan_hargas[$i]!==null){{ $bahan_hargas[$i]['harga'] }}@else-@endif</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $bahans[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$bahans[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Variasi')
        @for ($i = 0; $i < count($variasis); $i++)
        <tr>
            <td>{{ $variasis[$i]['nama'] }}</td>
            <td>@if ($variasi_hargas[$i]!==null){{ $variasi_hargas[$i]['harga'] }}@else-@endif</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $variasis[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$variasis[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Varian')
        @for ($i = 0; $i < count($varians); $i++)
        <tr>
            <td>{{ $varians[$i]['nama'] }}</td><td>{{ $varians[$i]['kategori'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $varians[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$varians[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Ukuran')
        @for ($i = 0; $i < count($ukurans); $i++)
        <tr>
            <td>{{ $ukurans[$i]['nama'] }}</td><td>{{ $ukuran_hargas[$i]['harga'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $ukurans[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$ukurans[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Jahit')
        @for ($i = 0; $i < count($jahits); $i++)
        <tr>
            <td>{{ $jahits[$i]['nama'] }}</td><td>{{ $jahit_hargas[$i]['harga'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $jahits[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$jahits[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Kombinasi')
        @for ($i = 0; $i < count($kombinasis); $i++)
        <tr>
            <td>{{ $kombinasis[$i]['nama'] }}</td>
            <td>
                @if ($kombinasi_hargas[$i]!==null)
                {{ $kombinasi_hargas[$i]['harga'] }}
                @else - @endif
            </td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $kombinasis[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$kombinasis[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Motif')
        @for ($i = 0; $i < count($motifs); $i++)
        <tr>
            <td>{{ $motifs[$i]['nama'] }}</td>
            <td>
                @if ($motif_hargas[$i]!==null)
                {{ $motif_hargas[$i]['harga'] }}
                @else - @endif
            </td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $motifs[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$motifs[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Tsixpack')
        @for ($i = 0; $i < count($tsixpacks); $i++)
        <tr>
            <td>{{ $tsixpacks[$i]['nama'] }}</td><td>{{ $tsixpack_hargas[$i]['harga'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $tsixpacks[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$tsixpacks[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Standar')
        @for ($i = 0; $i < count($standars); $i++)
        <tr>
            <td>{{ $standars[$i]['nama'] }}</td><td>{{ $standars[$i]['harga_dasar'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $standars[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$standars[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Tankpad')
        @for ($i = 0; $i < count($tankpads); $i++)
        <tr>
            <td>{{ $tankpads[$i]['nama'] }}</td>
            <td>@if ($tankpad_hargas[$i]!==null){{ $tankpad_hargas[$i]['harga'] }}@else-@endif</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $tankpads[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$tankpads[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Stiker')
        @for ($i = 0; $i < count($stikers); $i++)
        <tr>
            <td>{{ $stikers[$i]['nama'] }}</td><td>{{ $stiker_hargas[$i]['harga'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $stikers[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$stikers[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Busastang')
        @for ($i = 0; $i < count($busastangs); $i++)
        <tr>
            <td>{{ $busastangs[$i]['nama'] }}</td><td>{{ $busastang_hargas[$i]['harga'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $busastangs[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$busastangs[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='JokAssy')
        @for ($i = 0; $i < count($jokassies); $i++)
        <tr>
            <td>{{ $jokassies[$i]['nama'] }}</td><td>{{ $jokassy_hargas[$i]['harga'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $jokassies[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$jokassies[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Rol')
        @for ($i = 0; $i < count($rols); $i++)
        <tr>
            <td>{{ $rols[$i]['nama'] }}</td><td>{{ $rol_hargas[$i]['harga'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $rols[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$rols[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Rotan')
        @for ($i = 0; $i < count($rotans); $i++)
        <tr>
            <td>{{ $rotans[$i]['nama'] }}</td><td>{{ $rotan_hargas[$i]['harga'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $rotans[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$rotans[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='List')
        @for ($i = 0; $i < count($lists); $i++)
        <tr>
            <td>{{ $lists[$i]['nama'] }}</td><td>{{ $list_hargas[$i]['harga'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $lists[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$lists[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Alas')
        @for ($i = 0; $i < count($alass); $i++)
        <tr>
            <td>{{ $alass[$i]['nama'] }}</td><td>{{ $alas_hargas[$i]['harga'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $alass[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$alass[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='Busa')
        @for ($i = 0; $i < count($busas); $i++)
        <tr>
            <td>{{ $busas[$i]['nama'] }}</td><td>{{ $busa_hargas[$i]['harga'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $busas[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$busas[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @elseif ($tipe==='GradeBahan')
        @for ($i = 0; $i < count($grade_bahans); $i++)
        <tr>
            <td>{{ $grade_bahans[$i]['nama'] }}</td><td>{{ $grade_bahan_hargas[$i]['harga'] }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <form action="{{ route('hapusSpec') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $tipe }} ini?')">
                        @csrf
                        <input type="hidden" name="tipe" value="{{ $tipe }}">
                        <input type="hidden" name="id" value="{{ $grade_bahans[$i]['id'] }}">
                        <button type="submit"><img style="width: 1rem" src="{{ asset('img/icons/delete.svg') }}" alt=""></button>
                    </form>
                    <a class="ms-1" href="{{ route('editSpec',['tipe'=>$tipe,'id'=>$grade_bahans[$i]['id']]) }}">
                        <img style="width: 1rem" src="{{ asset('img/icons/edit.svg') }}" alt="">
                    </a>
                </div>
            </td>
        </tr>
        @endfor
        @endif
    </table>
</div>

<div style="height: 5rem"></div>

<script>

</script>

<style>
    button{
        border:none;
        padding: 0;
    }
    form {
        padding: 0;
        margin: 0;
    }
</style>
@endsection


