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

@if (session()->has('_success') && session('_success')!=="")
<div class="container mt-2 alert alert-success">{{ session('_success') }}</div>
@endif
@if (session()->has('_warnings') && session('_warnings')!=="")
<div class="container mt-1 alert alert-warning">{{ session('_warnings') }}</div>
@endif
@if (session()->has('_errors') && session('_errors')!=="")
<div class="container mt-1 alert alert-danger">{{ session('_errors') }}</div>
@endif

<div class="container mt-2">
    <table class="table table-light table-striped">
        @for ($i = 0; $i < count($spks); $i++)
        <tr style="vertical-align: middle">
            <td><div class='rounded-circle d-flex align-items-center justify-content-center font-weight-bold' style='background-color:salmon;width:2rem;height:2rem'>{{ $pelanggans[$i]['initial'] }}</div></td>
            <td>
                <div class="row"><div class="col fw-bold" style="color: blue">{{ $spks[$i]['no_spk'] }}</div></div>
                @if ($resellers[$i] !== null)
                <div class="row"><div class="col">{{ $resellers[$i]['nama'] }}-{{ $pelanggans[$i]['nama'] }}</div></div>
                @else
                <div class="row"><div class="col">{{ $pelanggans[$i]['nama'] }}</div></div>
                @endif
            </td>
            <td><div class="d-inline-block rounded ps-1 pe-1 {{ $bg_color_tgl[$i][0] }}" style="color:white"><div style="font-size:2.5em">{{ date('d',strtotime($spks[$i]['created_at'])) }}</div><div>{{ date('m',strtotime($spks[$i]['created_at'])) }}-{{ date('y',strtotime($spks[$i]['created_at'])) }}</div></div></td>
            <td>-</td>
            <td>
                @if ($spks[$i]['finished_at']!==null)
                <div class="d-inline-block rounded ps-1 pe-1 {{ $bg_color_tgl[$i][1] }}" style="color:white"><div style="font-size:2.5em">{{ date('d',strtotime($spks[$i]['finished_at'])) }}</div><div>{{ date('m',strtotime($spks[$i]['finished_at'])) }}-{{ date('y',strtotime($spks[$i]['finished_at'])) }}</div></div>
                @endif
            </td>
            <td style="color: green">{{ $spks[$i]['jumlah_total'] }}</td>
            <td id='divDropdownIcon-{{ $i }}' onclick='showDropdown({{ $i }});' class="text-center"><img class='w-0_7rem' src='img/icons/dropdown.svg'></td>
        </tr>
        {{-- DropDown --}}
        <tr id='divDetailDropdown-{{ $i }}' style="display: none">
            <td colspan="7">
                <table style="width: 100%">
                    @for ($j = 0; $j < count($arr_spk_produks[$i]); $j++)
                    <tr><td>{{ $arr_produks[$i][$j]['nama'] }}</td><td>{{ $arr_spk_produks[$i][$j]['jml_t'] }}</td></tr>
                    @endfor
                    <tr>
                        <td colspan="2">
                            <div class='d-flex justify-content-end'>
                                <form action="{{ route('spkFixData') }}" method="POST" style="margin:0">
                                    @csrf
                                    <input type="hidden" name="spk_id" value="{{ $spks[$i]['id'] }}">
                                    <button type="submit" class="btn btn-dd btn-sm">Fix</button>
                                </form>
                                <button id="btn-edit-tgl-pembuatan-spk-{{ $spks[$i]['id'] }}" href="{{ route('spkEditTglPembuatan',['spk_id'=>$spks[$i]['id']]) }}" class="ms-1 btn btn-outline-info btn-sm" onclick="showHideActive(this.id,'div-edit-tgl-pembuatan-spk-{{ $spks[$i]['id'] }}')">Tgl.P</button>
                                <a href="{{ route('spkSelesai',['spk_id'=>$spks[$i]['id']]) }}" class="ms-1 btn btn-primary btn-sm">Tgl.S</a>
                                <a href="{{ route('SPK-Detail',['spk_id'=>$spks[$i]['id']]) }}" class="ms-1 btn btn-warning btn-sm">Detail</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        {{-- <td></td> --}}
                        <td colspan="2">
                            <div id="div-edit-tgl-pembuatan-spk-{{ $spks[$i]['id'] }}" class='d-flex justify-content-end mt-1 d-none'>
                                <form action="{{ route('spkEditTglPembuatan') }}" method="POST">
                                    @csrf
                                    <label for="">Edit Tgl.Pembuatan:</label>
                                    <input type="datetime-local" class="form-control" value="{{ date("Y-m-d\TH:i:s") }}" name="tgl_pembuatan">
                                    <input type="hidden" name="spk_id" value="{{ $spks[$i]['id'] }}">
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

function showHideActive(btn_id,div_id) {
    var button=document.getElementById(btn_id);
    var element=document.getElementById(div_id);
    if (element.classList.contains('d-none')) {
        element.classList.remove('d-none');
        button.classList.add('active');
    } else {
        element.classList.add('d-none');
        button.classList.remove('active');
    }
}

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
