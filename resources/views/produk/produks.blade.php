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


<!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
{{-- Validation Feedback --}}
@if (session()->has('_success') && session('_success')!=="")
<div class="container mt-1 alert alert-success">{{ session('_success') }}</div>
@endif
@if (session()->has('_warnings') && session('_warnings')!=="")
<div class="container mt-1 alert alert-warning">{{ session('_warnings') }}</div>
@endif
@if (session()->has('_errors') && session('_errors')!=="")
<div class="container mt-1 alert alert-danger">{{ session('_errors') }}</div>
@endif


@foreach ($btn_tipe as $tipe)
@if ($tipe['short']!=='all')
<div id="div-{{ $tipe['short'] }}" class="items container">
    <div class="fw-bold border border-primary border-2 p-1 text-center">{{ $tipe['tipe'] }}</div>
    <table style="width: 100%">
        @foreach ($produk_hargas->where('tipe',$tipe['tipe']) as $produk_harga)
        <tr class="border">
            <td>{{ $produk_harga['nama'] }}</td>
            <td class="toFormatCurrencyRp">{{ $produk_harga['harga'] }}</td>
            <td>
                <div>
                    <div class="d-flex justify-content-end">
                        <button id="btn-edit-harga-produk-{{ $produk_harga['harga_id'] }}" class="btn btn-sm btn-outline-success" onclick="showHideActive(this.id,'tr-edit-harga-produk-{{ $produk_harga['harga_id'] }}')">E.Harga</button>
                        <button id="btn-edit-nama-produk-{{ $produk_harga['produk_id'] }}" class="ms-1 btn btn-sm btn-outline-primary" onclick="showHideActive(this.id,'tr-edit-nama-produk-{{ $produk_harga['produk_id'] }}')">E.Nama</button>
                        <a href="{{ route('produk_detail',['produk_id'=>$produk_harga['produk_id']]) }}" class="ms-1 btn btn-warning btn-sm">>></a>
                    </div>
                </div>

            </td>
        </tr>
        <tr id="tr-edit-harga-produk-{{ $produk_harga['harga_id'] }}" class="d-none">
            <td colspan="3">
                <div class="row">
                    <div class="col-sm"></div>
                    <div class="col-sm">
                        <form action="{{ route('produkHargaEdit') }}" method="POST">
                            @csrf
                            <div>
                                <label for="harga">Harga:</label>
                                <input type="number" name="harga" id="harga" class="form-control" placeholder="Harga" value="{{ $produk_harga['harga'] }}">
                            </div>
                            <div class="text-end mt-1">
                                <input type="hidden" name="produk_id" value="{{ $produk_harga['produk_id'] }}">
                                <input type="hidden" name="produk_harga_id" value="{{ $produk_harga['harga_id'] }}">
                                <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
        <tr id="tr-edit-nama-produk-{{ $produk_harga['produk_id'] }}" class="d-none">
            <td colspan="2">
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <form action="{{ route('produkEditNama') }}" method="POST">
                            @csrf
                            <div>
                                <label for="nama">Nama:</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" value="{{ $produk_harga['nama'] }}">
                                <label for="nama_nota">Nama Nota:</label>
                                <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota" value="{{ $produk_harga['nama_nota'] }}">
                            </div>
                            <div class="text-end mt-1">
                                <input type="hidden" name="produk_id" value="{{ $produk_harga['produk_id'] }}">
                                <button type="submit" class="btn btn-sm btn-warning">Konfirmasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endif
@endforeach


<script>

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
