@extends('layouts.main_layout')
@extends('layouts.navbar_v2')

@section('content')

<div class="mt-1rem ml-1rem mr-1rem pb-1rem bb-0_5px-solid-grey">
    <div class="grid-2-auto mb-1">
        <div class="justify-self-left grid-2-auto b-1px-solid-grey b-radius-50px mr-1rem pl-1rem pr-0_4rem w-11rem">
            <input class="input-2 mt-0_4rem mb-0_4rem" type="text" placeholder="Cari...">
            <div class="justify-self-right grid-1-auto justify-items-center circle-small bg-color-orange-1">
                <img class="w-0_8rem" src="img/icons/loupe.svg" alt="">
            </div>
        </div>
        <div class="div-filter-icon">
            <div class="icon-small-circle grid-1-auto justify-items-center bg-color-orange-1">
                <img class="w-0_9rem" src="img/icons/sort-by-attributes.svg" alt="sort-icon">
            </div>
        </div>
    </div>
    <div class="mb-1">
        @for ($i = 0; $i < count($btn_tipe); $i++)
        <button id="{{ $btn_tipe[$i]['short'] }}" class="filter-tipe btn btn-outline-{{ $btn_tipe[$i]['color'] }} btn-sm @if ($i===0) active @endif" onclick="showHideFilter(this.id)">{{ $btn_tipe[$i]['short'] }}</button>
        @endfor
        <small>Jumlah: {{ $jumlah }}</small>
    </div>
</div>

{{-- Penampilan Alert Success --}}
@if (session()->has('_success') && session('_success')!=="")
<div class="container mt-2 alert alert-success">{{ session('_success') }}</div>
@endif
@if (session()->has('_warnings') && session('_warnings')!=="")
<div class="container mt-1 alert alert-warning">{{ session('_warnings') }}</div>
@endif
@if (session()->has('_errors') && session('_errors')!=="")
<div class="container mt-1 alert alert-danger">{{ session('_errors') }}</div>
@endif

<div id="div-var" class="items container">
    <div class="fw-bold border border-primary border-2 p-1 text-center">SJ-Variasi</div>
    <table style="width: 100%">
        @foreach ($sjvariasis as $sjvariasi)
        <tr class="border">
            <td>{{ $sjvariasi['nama'] }}</td>
            <td>
                <div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-edit-nama-produk-{{ $sjvariasi['id'] }}" class="btn btn-sm btn-outline-primary" onclick="showHideActive(this.id,'tr-edit-nama-produk-{{ $sjvariasi['id'] }}')">E.Nama</button>
                        <a href="{{ route('produk_detail',['produk_id'=>$sjvariasi['id']]) }}" class="ms-1 btn btn-warning btn-sm">>></a>
                    </div>
                </div>

            </td>
        </tr>
        <tr id="tr-edit-nama-produk-{{ $sjvariasi['id'] }}" class="d-none">
            <td>
                <form action="{{ route('produkEditNama') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ $sjvariasi['nama'] }}">
                        <label for="nama_nota">Nama Nota:</label>
                        <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota" value="{{ $sjvariasi['nama_nota'] }}">
                    </div>
                    <div class="text-end mt-1">
                        <input type="hidden" name="produk_id" value="{{ $sjvariasi['id'] }}">
                        <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div id="div-komb" class="items container">
    <div class="fw-bold border border-primary border-2 p-1 text-center">SJ-Kombinasi</div>
    <table style="width: 100%">
        @foreach ($sjkombinasis as $sjkombinasi)
        <tr>
            <td>{{ $sjkombinasi['nama'] }}</td>
            <td>
                <div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-edit-nama-produk-{{ $sjkombinasi['id'] }}" class="btn btn-sm btn-outline-primary" onclick="showHideActive(this.id,'tr-edit-nama-produk-{{ $sjkombinasi['id'] }}')">E.Nama</button>
                        <a href="{{ route('produk_detail',['produk_id'=>$sjkombinasi['id']]) }}" class="ms-1 btn btn-warning btn-sm">>></a>
                    </div>
                </div>

            </td>
        </tr>
        <tr id="tr-edit-nama-produk-{{ $sjkombinasi['id'] }}" class="d-none">
            <td>
                <form action="{{ route('produkEditNama') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ $sjkombinasi['nama'] }}">
                        <label for="nama_nota">Nama Nota:</label>
                        <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota" value="{{ $sjkombinasi['nama_nota'] }}">
                    </div>
                    <div class="text-end mt-1">
                        <input type="hidden" name="produk_id" value="{{ $sjkombinasi['id'] }}">
                        <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div id="div-mot" class="items container">
    <div class="fw-bold border border-primary border-2 p-1 text-center">SJ-Motif</div>
    <table style="width: 100%">
        @foreach ($sjmotifs as $sjmotif)
        <tr>
            <td>{{ $sjmotif['nama'] }}</td>
            <td>
                <div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-edit-nama-produk-{{ $sjmotif['id'] }}" onclick="showHideActive(this.id,'tr-edit-nama-produk-{{ $sjmotif['id'] }}')" class="btn btn-sm btn-outline-primary">E.Nama</button>
                        <a href="{{ route('produk_detail',['produk_id'=>$sjmotif['id']]) }}" class="ms-1 btn btn-warning btn-sm">>></a>
                    </div>
                </div>

            </td>
        </tr>
        <tr id="tr-edit-nama-produk-{{ $sjmotif['id'] }}" class="d-none">
            <td>
                <form action="{{ route('produkEditNama') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ $sjmotif['nama'] }}">
                        <label for="nama_nota">Nama Nota:</label>
                        <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota" value="{{ $sjmotif['nama_nota'] }}">
                    </div>
                    <div class="text-end mt-1">
                        <input type="hidden" name="produk_id" value="{{ $sjmotif['id'] }}">
                        <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div id="div-t-sp" class="items container">
    <div class="fw-bold border border-primary border-2 p-1 text-center">SJ-T.Sixpack</div>
    <table style="width: 100%">
        @foreach ($sjtsixpacks as $sjtsixpack)
        <tr>
            <td>{{ $sjtsixpack['nama'] }}</td>
            <td>
                <div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-edit-nama-produk-{{ $sjtsixpack['id'] }}" onclick="showHideActive(this.id,'tr-edit-nama-produk-{{ $sjtsixpack['id'] }}')" class="btn btn-sm btn-outline-primary">E.Nama</button>
                        <a href="{{ route('produk_detail',['produk_id'=>$sjtsixpack['id']]) }}" class="ms-1 btn btn-warning btn-sm">>></a>
                    </div>
                </div>

            </td>
        </tr>
        <tr id="tr-edit-nama-produk-{{ $sjtsixpack['id'] }}" class="d-none">
            <td>
                <form action="{{ route('produkEditNama') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ $sjtsixpack['nama'] }}">
                        <label for="nama_nota">Nama Nota:</label>
                        <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota" value="{{ $sjtsixpack['nama_nota'] }}">
                    </div>
                    <div class="text-end mt-1">
                        <input type="hidden" name="produk_id" value="{{ $sjtsixpack['id'] }}">
                        <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div id="div-std" class="items container">
    <div class="fw-bold border border-primary border-2 p-1 text-center">SJ-Standar</div>
    <table style="width: 100%">
        @foreach ($sjstandars as $sjstandar)
        <tr>
            <td>{{ $sjstandar['nama'] }}</td>
            <td>
                <div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-edit-nama-produk-{{ $sjstandar['id'] }}" onclick="showHideActive(this.id,'tr-edit-nama-produk-{{ $sjstandar['id'] }}')" class="btn btn-sm btn-outline-primary">E.Nama</button>
                        <a href="{{ route('produk_detail',['produk_id'=>$sjstandar['id']]) }}" class="ms-1 btn btn-warning btn-sm">>></a>
                    </div>
                </div>

            </td>
        </tr>
        <tr id="tr-edit-nama-produk-{{ $sjstandar['id'] }}" class="d-none">
            <td>
                <form action="{{ route('produkEditNama') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ $sjstandar['nama'] }}">
                        <label for="nama_nota">Nama Nota:</label>
                        <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota" value="{{ $sjstandar['nama_nota'] }}">
                    </div>
                    <div class="text-end mt-1">
                        <input type="hidden" name="produk_id" value="{{ $sjstandar['id'] }}">
                        <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div id="div-jap" class="items container">
    <div class="fw-bold border border-primary border-2 p-1 text-center">SJ-Japstyle</div>
    <table style="width: 100%">
        @foreach ($sjjapstyles as $sjjapstyle)
        <tr>
            <td>{{ $sjjapstyle['nama'] }}</td>
            <td>
                <div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-edit-nama-produk-{{ $sjjapstyle['id'] }}" onclick="showHideActive(this.id,'tr-edit-nama-produk-{{ $sjjapstyle['id'] }}')" class="btn btn-sm btn-outline-primary">E.Nama</button>
                        <a href="{{ route('produk_detail',['produk_id'=>$sjjapstyle['id']]) }}" class="ms-1 btn btn-warning btn-sm">>></a>
                    </div>
                </div>

            </td>
        </tr>
        <tr id="tr-edit-nama-produk-{{ $sjjapstyle['id'] }}" class="d-none">
            <td>
                <form action="{{ route('produkEditNama') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ $sjjapstyle['nama'] }}">
                        <label for="nama_nota">Nama Nota:</label>
                        <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota" value="{{ $sjjapstyle['nama_nota'] }}">
                    </div>
                    <div class="text-end mt-1">
                        <input type="hidden" name="produk_id" value="{{ $sjjapstyle['id'] }}">
                        <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div id="div-ass" class="items container">
    <div class="fw-bold border border-primary border-2 p-1 text-center">Jok Assy</div>
    <table style="width: 100%">
        @foreach ($jokassies as $jokassy)
        <tr>
            <td>{{ $jokassy['nama'] }}</td>
            <td>
                <div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-edit-nama-produk-{{ $jokassy['id'] }}" onclick="showHideActive(this.id,'tr-edit-nama-produk-{{ $jokassy['id'] }}')" class="btn btn-sm btn-outline-primary">E.Nama</button>
                        <a href="{{ route('produk_detail',['produk_id'=>$jokassy['id']]) }}" class="ms-1 btn btn-warning btn-sm">>></a>
                    </div>
                </div>

            </td>
        </tr>
        <tr id="tr-edit-nama-produk-{{ $jokassy['id'] }}" class="d-none">
            <td>
                <form action="{{ route('produkEditNama') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ $jokassy['nama'] }}">
                        <label for="nama_nota">Nama Nota:</label>
                        <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota" value="{{ $jokassy['nama_nota'] }}">
                    </div>
                    <div class="text-end mt-1">
                        <input type="hidden" name="produk_id" value="{{ $jokassy['id'] }}">
                        <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div id="div-tp" class="items container">
    <div class="fw-bold border border-primary border-2 p-1 text-center">Tankpad</div>
    <table style="width: 100%">
        @foreach ($tankpads as $tankpad)
        <tr>
            <td>{{ $tankpad['nama'] }}</td>
            <td>
                <div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-edit-nama-produk-{{ $tankpad['id'] }}" onclick="showHideActive(this.id,'tr-edit-nama-produk-{{ $tankpad['id'] }}')" class="btn btn-sm btn-outline-primary">E.Nama</button>
                        <a href="{{ route('produk_detail',['produk_id'=>$tankpad['id']]) }}" class="ms-1 btn btn-warning btn-sm">>></a>
                    </div>
                </div>

            </td>
        </tr>
        <tr id="tr-edit-nama-produk-{{ $tankpad['id'] }}" class="d-none">
            <td>
                <form action="{{ route('produkEditNama') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ $tankpad['nama'] }}">
                        <label for="nama_nota">Nama Nota:</label>
                        <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota" value="{{ $tankpad['nama_nota'] }}">
                    </div>
                    <div class="text-end mt-1">
                        <input type="hidden" name="produk_id" value="{{ $tankpad['id'] }}">
                        <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div id="div-sti" class="items container">
    <div class="fw-bold border border-primary border-2 p-1 text-center">Stiker</div>
    <table style="width: 100%">
        @foreach ($stikers as $stiker)
        <tr>
            <td>{{ $stiker['nama'] }}</td>
            <td>
                <div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-edit-nama-produk-{{ $stiker['id'] }}" onclick="showHideActive(this.id,'tr-edit-nama-produk-{{ $stiker['id'] }}')" class="btn btn-sm btn-outline-primary">E.Nama</button>
                        <a href="{{ route('produk_detail',['produk_id'=>$stiker['id']]) }}" class="ms-1 btn btn-warning btn-sm">>></a>
                    </div>
                </div>

            </td>
        </tr>
        <tr id="tr-edit-nama-produk-{{ $stiker['id'] }}" class="d-none">
            <td>
                <form action="{{ route('produkEditNama') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ $stiker['nama'] }}">
                        <label for="nama_nota">Nama Nota:</label>
                        <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota" value="{{ $stiker['nama_nota'] }}">
                    </div>
                    <div class="text-end mt-1">
                        <input type="hidden" name="produk_id" value="{{ $stiker['id'] }}">
                        <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div id="div-bs" class="items container">
    <div class="fw-bold border border-primary border-2 p-1 text-center">Busa Stang</div>
    <table style="width: 100%">
        @foreach ($busastangs as $busastang)
        <tr>
            <td>{{ $busastang['nama'] }}</td>
            <td>
                <div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-edit-nama-produk-{{ $busastang['id'] }}" onclick="showHideActive(this.id,'tr-edit-nama-produk-{{ $busastang['id'] }}')" class="btn btn-sm btn-outline-primary">E.Nama</button>
                        <a href="{{ route('produk_detail',['produk_id'=>$busastang['id']]) }}" class="ms-1 btn btn-warning btn-sm">>></a>
                    </div>
                </div>

            </td>
        </tr>
        <tr id="tr-edit-nama-produk-{{ $busastang['id'] }}" class="d-none">
            <td>
                <form action="{{ route('produkEditNama') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ $busastang['nama'] }}">
                        <label for="nama_nota">Nama Nota:</label>
                        <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota" value="{{ $busastang['nama_nota'] }}">
                    </div>
                    <div class="text-end mt-1">
                        <input type="hidden" name="produk_id" value="{{ $busastang['id'] }}">
                        <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div id="div-rol" class="items container">
    <div class="fw-bold border border-primary border-2 p-1 text-center">Rol</div>
    <table style="width: 100%">
        @foreach ($rols as $rol)
        <tr>
            <td>{{ $rol['nama'] }}</td>
            <td>
                <div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-edit-nama-produk-{{ $rol['id'] }}" onclick="showHideActive(this.id,'tr-edit-nama-produk-{{ $rol['id'] }}')" class="btn btn-sm btn-outline-primary">E.Nama</button>
                        <a href="{{ route('produk_detail',['produk_id'=>$rol['id']]) }}" class="ms-1 btn btn-warning btn-sm">>></a>
                    </div>
                </div>

            </td>
        </tr>
        <tr id="tr-edit-nama-produk-{{ $rol['id'] }}" class="d-none">
            <td>
                <form action="{{ route('produkEditNama') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ $rol['nama'] }}">
                        <label for="nama_nota">Nama Nota:</label>
                        <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota" value="{{ $rol['nama_nota'] }}">
                    </div>
                    <div class="text-end mt-1">
                        <input type="hidden" name="produk_id" value="{{ $rol['id'] }}">
                        <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div id="div-rot" class="items container">
    <div class="fw-bold border border-primary border-2 p-1 text-center">Rotan</div>
    <table style="width: 100%">
        @foreach ($rotans as $rotan)
        <tr>
            <td>{{ $rotan['nama'] }}</td>
            <td>
                <div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-edit-nama-produk-{{ $rotan['id'] }}" onclick="showHideActive(this.id,'tr-edit-nama-produk-{{ $rotan['id'] }}')" class="btn btn-sm btn-outline-primary">E.Nama</button>
                        <a href="{{ route('produk_detail',['produk_id'=>$rotan['id']]) }}" class="ms-1 btn btn-warning btn-sm">>></a>
                    </div>
                </div>

            </td>
        </tr>
        <tr id="tr-edit-nama-produk-{{ $rotan['id'] }}" class="d-none">
            <td>
                <form action="{{ route('produkEditNama') }}" method="POST">
                    @csrf
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ $rotan['nama'] }}">
                        <label for="nama_nota">Nama Nota:</label>
                        <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota" value="{{ $rotan['nama_nota'] }}">
                    </div>
                    <div class="text-end mt-1">
                        <input type="hidden" name="produk_id" value="{{ $rotan['id'] }}">
                        <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

<script>
// document.querySelectorAll('.filter-tipe').forEach(element => {
//     element.addEventListener('click', event=>{
//         if (this.id==='all') {
//             document.querySelectorAll('.items').forEach(el=>{
//                 el.style.removeProperty('display');
//             });
//         } else {
//             document.querySelectorAll('.items').forEach(el=>{
//                 el.style.display = 'none';
//             });
//             document.getElementById(`div-${this.id}`).style.removeProperty('display');
//         }
//     });
// });

function showHideFilter(id) {
    if(id==='all'){
        document.querySelectorAll('.items').forEach(element => {
            element.style.removeProperty('display');
        });
    } else {
        document.querySelectorAll('.items').forEach(element => {
            element.style.display = 'none';
        });
        document.getElementById(`div-${id}`).style.removeProperty('display');
    }
    document.querySelectorAll('.filter-tipe').forEach(element => {
        element.classList.remove('active');
    });
    document.getElementById(id).classList.add('active');
}
</script>
@endsection
