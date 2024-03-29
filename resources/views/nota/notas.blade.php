@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="grid-2-auto mt-1rem ml-1rem mr-1rem pb-1rem bb-0_5px-solid-grey">
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

<div class="container">
    <table class="table table-warning table-striped" class="mt-1">
    @for ($i = 0; $i < count($notas); $i++)
        <tr style="vertical-align: middle">
            <td><div class='rounded-circle d-flex align-items-center justify-content-center font-weight-bold' style='background-color:salmon;width:2rem;height:2rem'>{{ $pelanggans[$i]['initial'] }}</div></td>
            <td>
                <div>
                    <div class="d-flex">
                        <div class="fw-bold" style="color: blue">{{ $notas[$i]['no_nota'] }}</div>
                        <a href="{{ route('SPK-Detail',['spk_id'=>$spks[$i]]) }}" class="ms-2 fw-bold" style="color:brown">SPK-{{ $spks[$i] }}</a>
                    </div>

                </div>
                @if ($resellers[$i] !== null)
                <div class="row"><div class="col">{{ $resellers[$i]['nama'] }}-{{ $pelanggans[$i]['nama'] }}</div></div>
                @else
                <div class="row"><div class="col">{{ $pelanggans[$i]['nama'] }}</div></div>
                @endif
            </td>
            <td><div class="d-inline-block rounded ps-1 pe-1 {{ $bg_color_tgl[$i][0] }}" style="color:white"><div style="font-size:2.5em">{{ date('d',strtotime($notas[$i]['created_at'])) }}</div><div>{{ date('m',strtotime($notas[$i]['created_at'])) }}-{{ date('y',strtotime($notas[$i]['created_at'])) }}</div></div></td>
            <td>-</td>
            <td>
                @if ($notas[$i]['finished_at']!==null)
                <div class="d-inline-block rounded ps-1 pe-1 {{ $bg_color_tgl[$i][1] }}" style="color:white"><div style="font-size:2.5em">{{ date('d',strtotime($notas[$i]['finished_at'])) }}</div><div>{{ date('m',strtotime($notas[$i]['finished_at'])) }}-{{ date('y',strtotime($notas[$i]['finished_at'])) }}</div></div>
                @endif
            </td>
            <td style="color: green" class="harga_total">{{ $notas[$i]['harga_total'] }}</td>
            <td id='divDropdownIcon-{{ $i }}' onclick='showDropdown({{ $i }});' class="text-center"><img class='w-0_7rem' src='img/icons/dropdown.svg'></td>
        </tr>
        {{-- DropDown --}}
        <tr id='divDetailDropdown-{{ $i }}' style="display: none">
            <td colspan="7">
                <table style="width: 100%">
                    @for ($j = 0; $j < count($arr_spk_produks[$i]); $j++)
                    <tr>
                        <td>{{ $arr_nama_notas[$i][$j] }}</td>
                        <td>{{ $arr_spk_produk_notas[$i][$j]['jumlah'] }}</td>
                        <td class="harga_item">{{ $arr_spk_produk_notas[$i][$j]['harga'] }}</td>
                        <td class="harga_t">{{ $arr_spk_produk_notas[$i][$j]['harga_t'] }}</td>
                    </tr>
                    @endfor
                    <tr>
                        <td colspan="4">
                            <div class='d-flex align-items-center justify-content-end'>
                                <form action="{{ route('hapusNota') }}" class="m-0" onclick="return confirm('Anda yakin ingin menghapus Nota ini? Warning: Sr. Jalan yang berkaitan juga akan dihapus!');">
                                    <input type="hidden" name="nota_id" value="{{ $notas[$i]['id'] }}">
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                <button id="btn-edit-tgl-pembuatan-nota-{{ $notas[$i]['id'] }}" class="ms-1 btn btn-outline-info btn-sm" onclick="showHideActive(this.id,'div-edit-tgl-pembuatan-nota-{{ $notas[$i]['id'] }}')">Tgl.P</button>
                                <form action="{{ route('notaFix') }}" class="m-0" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin melakukan update/fix keseluruhan data Nota?')">
                                    @csrf
                                    <input type="hidden" name="nota_id" value="{{ $notas[$i]['id'] }}">
                                    <button type="submit" class="btn btn-dd btn-sm ms-1">Fix</button>
                                </form>
                                <a href="{{ route('PrintOutNota',['nota_id'=>$notas[$i]['id']]) }}" class="btn btn-primary btn-sm ms-1">PrintOut</a>
                                <a href="{{ route('notaSelesai',['nota_id'=>$notas[$i]['id']]) }}" class="btn btn-success btn-sm ms-1">Tgl.S</a>
                                <a href="{{ route('Nota-Detail',['nota_id'=>$notas[$i]['id']]) }}" class="btn btn-warning btn-sm ms-1">Detail</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div id="div-edit-tgl-pembuatan-nota-{{ $notas[$i]['id'] }}" class='d-flex justify-content-end mt-1 d-none'>
                                <form action="{{ route('notaEditTglPembuatan') }}" method="POST">
                                    @csrf
                                    <label for="">Edit Tgl.Pembuatan:</label>
                                    <input type="datetime-local" class="form-control" value="{{ date("Y-m-d\TH:i:s") }}" name="tgl_pembuatan">
                                    <input type="hidden" name="nota_id" value="{{ $notas[$i]['id'] }}">
                                    <div class="text-end mt-1">
                                        <button type="submit" class="btn btn-warning">Konfirmasi</button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    @endfor
    </table>
</div>

<script>
    var all_elem_harga_total=document.querySelectorAll('.harga_total');
    // console.log('all_elem_harga_total');console.log(all_elem_harga_total);
    all_elem_harga_total.forEach(element => {
        // console.log('element.textContent');console.log(parseInt(element.textContent));
        formatNumberK(parseInt(element.textContent), element);
    });

    var all_harga_item=document.querySelectorAll('.harga_item');
    // console.log('all_harga_item');console.log(all_harga_item);
    all_harga_item.forEach(element => {
        // console.log('element.textContent');console.log(parseInt(element.textContent));
        formatNumberK(parseInt(element.textContent), element);
    });

    var all_harga_t=document.querySelectorAll('.harga_t');
    all_harga_t.forEach(element => {
        formatNumberK(parseInt(element.textContent), element);
    });
</script>

<style>
    .input-cari {
        border: none;
        width: 10em;
        border-radius: 25px;
        padding: 0.5em 1em 0.5em 1em;
        box-shadow: 0 0 2px gray;
    }

    .input-cari:focus {
        box-shadow: 0 0 6px #23FFAD;
    }

    .field {
        margin: 1em;
    }

    .div-filter-icon {
        justify-self: end;
    }

    .icon-small-circle {
        border-radius: 100%;
        width: 2em;
        height: 2em;
    }

    .icon-img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
@endsection
