@extends('layouts/main_layout')

@section('content')


<header class="header grid-2-auto">
    <img class="w-0_8rem ml-1_5rem" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div class="text-end pe-3">
        <a href="{{ route('tambah-produk') }}" class="btn btn-danger btn-sm">+Tambah Produk</a>
    </div>
</header>

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

<form action="" class="container" method="GET">
    <div id="div-var" class="items">
        <div class="fw-bold border border-primary border-2 p-1 text-center">SJ-Variasi</div>
        <table style="width: 100%">
            @foreach ($sjvariasis as $sjvariasi)
            <tr>
                <td>{{ $sjvariasi['nama'] }}</td>
                <td class="text-end"><button name="id" type="submit" class="btn btn-warning btn-sm" value={{ $sjvariasi['id'] }}>>></button></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="div-komb" class="items">
        <div class="fw-bold border border-primary border-2 p-1 text-center">SJ-Kombinasi</div>
        <table style="width: 100%">
            @foreach ($sjkombinasis as $sjkombinasi)
            <tr>
                <td>{{ $sjkombinasi['nama'] }}</td>
                <td class="text-end"><button name="id" type="submit" class="btn btn-warning btn-sm" value={{ $sjkombinasi['id'] }}>>></button></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="div-mot" class="items">
        <div class="fw-bold border border-primary border-2 p-1 text-center">SJ-Motif</div>
        <table style="width: 100%">
            @foreach ($sjmotifs as $sjmotif)
            <tr>
                <td>{{ $sjmotif['nama'] }}</td>
                <td class="text-end"><button name="id" type="submit" class="btn btn-warning btn-sm" value={{ $sjmotif['id'] }}>>></button></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="div-t-sp" class="items">
        <div class="fw-bold border border-primary border-2 p-1 text-center">SJ-T.Sixpack</div>
        <table style="width: 100%">
            @foreach ($sjtsixpacks as $sjtsixpack)
            <tr>
                <td>{{ $sjtsixpack['nama'] }}</td>
                <td class="text-end"><button name="id" type="submit" class="btn btn-warning btn-sm" value={{ $sjtsixpack['id'] }}>>></button></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="div-std" class="items">
        <div class="fw-bold border border-primary border-2 p-1 text-center">SJ-Standar</div>
        <table style="width: 100%">
            @foreach ($sjstandars as $sjstandar)
            <tr>
                <td>{{ $sjstandar['nama'] }}</td>
                <td class="text-end"><button name="id" type="submit" class="btn btn-warning btn-sm" value={{ $sjstandar['id'] }}>>></button></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="div-jap" class="items">
        <div class="fw-bold border border-primary border-2 p-1 text-center">SJ-Japstyle</div>
        <table style="width: 100%">
            @foreach ($sjjapstyles as $sjjapstyle)
            <tr>
                <td>{{ $sjjapstyle['nama'] }}</td>
                <td class="text-end"><button name="id" type="submit" class="btn btn-warning btn-sm" value={{ $sjjapstyle['id'] }}>>></button></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="div-ass" class="items">
        <div class="fw-bold border border-primary border-2 p-1 text-center">Jok Assy</div>
        <table style="width: 100%">
            @foreach ($jokassies as $jokassy)
            <tr>
                <td>{{ $jokassy['nama'] }}</td>
                <td class="text-end"><button name="id" type="submit" class="btn btn-warning btn-sm" value={{ $jokassy['id'] }}>>></button></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="div-tp" class="items">
        <div class="fw-bold border border-primary border-2 p-1 text-center">Tankpad</div>
        <table style="width: 100%">
            @foreach ($tankpads as $tankpad)
            <tr>
                <td>{{ $tankpad['nama'] }}</td>
                <td class="text-end"><button name="id" type="submit" class="btn btn-warning btn-sm" value={{ $tankpad['id'] }}>>></button></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="div-sti" class="items">
        <div class="fw-bold border border-primary border-2 p-1 text-center">Stiker</div>
        <table style="width: 100%">
            @foreach ($stikers as $stiker)
            <tr>
                <td>{{ $stiker['nama'] }}</td>
                <td class="text-end"><button name="id" type="submit" class="btn btn-warning btn-sm" value={{ $stiker['id'] }}>>></button></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="div-bs" class="items">
        <div class="fw-bold border border-primary border-2 p-1 text-center">Busa Stang</div>
        <table style="width: 100%">
            @foreach ($busastangs as $busastang)
            <tr>
                <td>{{ $busastang['nama'] }}</td>
                <td class="text-end"><button name="id" type="submit" class="btn btn-warning btn-sm" value={{ $busastang['id'] }}>>></button></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="div-rol" class="items">
        <div class="fw-bold border border-primary border-2 p-1 text-center">Rol</div>
        <table style="width: 100%">
            @foreach ($rols as $rol)
            <tr>
                <td>{{ $rol['nama'] }}</td>
                <td class="text-end"><button name="id" type="submit" class="btn btn-warning btn-sm" value={{ $rol['id'] }}>>></button></td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="div-rot" class="items">
        <div class="fw-bold border border-primary border-2 p-1 text-center">Rotan</div>
        <table style="width: 100%">
            @foreach ($rotans as $rotan)
            <tr>
                <td>{{ $rotan['nama'] }}</td>
                <td class="text-end"><button name="id" type="submit" class="btn btn-warning btn-sm" value={{ $rotan['id'] }}>>></button></td>
            </tr>
            @endforeach
        </table>
    </div>
</form>

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
