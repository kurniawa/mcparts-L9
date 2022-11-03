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

<div class="container">
    <table class="table table-danger table-striped">
        @for ($i = 0; $i < count($srjalans); $i++)
        <tr style="vertical-align: middle">
            <td><div class='rounded-circle d-flex align-items-center justify-content-center font-weight-bold' style='background-color:salmon;width:2rem;height:2rem'>{{ $pelanggans[$i]['initial'] }}</div></td>
            <td>
                <div>
                    <div class="d-flex">
                        <div class="fw-bold" style="color: darkgreen">{{ $srjalans[$i]['no_srjalan'] }}</div>
                        <a class="ms-2 fw-bold" style="color: darkred" href="{{ route('SPK-Detail',['spk_id'=>$spks[$i]]) }}">SPK-{{ $spks[$i] }}</a>
                        <a class="ms-2 fw-bold" style="color:darkviolet" href="{{ route('Nota-Detail',['nota_id'=>$notas[$i]]) }}">Nota-{{ $notas[$i] }}</a>
                    </div>
                </div>
                @if ($resellers[$i] !== null)
                <div class="row"><div class="col">{{ $resellers[$i]['nama'] }}-{{ $pelanggans[$i]['nama'] }}</div></div>
                @else
                <div class="row"><div class="col">{{ $pelanggans[$i]['nama'] }}</div></div>
                @endif
            </td>
            <td><div class="d-inline-block rounded ps-1 pe-1 {{ $bg_color_tgl[$i][0] }}" style="color:white"><div style="font-size:2.5em">{{ date('d',strtotime($srjalans[$i]['created_at'])) }}</div><div>{{ date('m',strtotime($srjalans[$i]['created_at'])) }}-{{ date('y',strtotime($srjalans[$i]['created_at'])) }}</div></div></td>
            <td>-</td>
            <td>
                @if ($srjalans[$i]['finished_at']!==null)
                <div class="d-inline-block rounded ps-1 pe-1 {{ $bg_color_tgl[$i][1] }}" style="color:white"><div style="font-size:2.5em">{{ date('d',strtotime($srjalans[$i]['finished_at'])) }}</div><div>{{ date('m',strtotime($srjalans[$i]['finished_at'])) }}-{{ date('y',strtotime($srjalans[$i]['finished_at'])) }}</div></div>
                @endif
            </td>
            <td style="color: green">
                {{ $srjalans[$i]['jml_colly'] }} Koli
                @if ($srjalans[$i]['jml_dus']!==null && $srjalans[$i]['jml_dus']!==0)
                + {{ $srjalans[$i]['jml_dus'] }} Dus
                @endif
            </td>
            <td id='divDropdownIcon-{{ $i }}' onclick='showDropdown({{ $i }});' class="text-center"><img class='w-0_7rem' src='img/icons/dropdown.svg'></td>
        </tr>
        {{-- DropDown --}}
        <tr id='divDetailDropdown-{{ $i }}' style="display: none">
            <td colspan="7">
                <table style="width: 100%">
                    @for ($j = 0; $j < count($arr_spk_produks[$i]); $j++)
                    <tr>
                        <td>{{ $arr_produks[$i][$j]['nama'] }}</td><td>{{ $arr_spk_produk_nota_srjalans[$i][$j]['jumlah'] }}</td>
                        <td>
                            {{ $arr_spk_produk_nota_srjalans[$i][$j]['jml_packing'] }}
                            @if ($arr_spk_produk_nota_srjalans[$i][$j]['tipe_packing']==='colly')
                            koli
                            @else
                            {{ $arr_spk_produk_nota_srjalans[$i][$j]['tipe_packing'] }}
                            @endif
                        </td>
                    </tr>
                    @endfor
                    <tr>
                        <td colspan="3">
                            <div class='d-flex align-items-center justify-content-end'>
                                <form action="{{ route('sj_hapus') }}" class="m-0" onclick="return confirm('Apakah Anda yakin ingin menghapus Sr. Jalan ini? (Jumlah sudah Sr. Jalan pada Tree akan disesuaikan kembali.)');">
                                    <input type="hidden" name="srjalan_id" value="{{ $srjalans[$i]['id'] }}">
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                <a href="{{ route('editColly',['srjalan_id'=>$srjalans[$i]['id']]) }}" class="btn btn-primary btn-sm ms-1">E.Col</a>
                                <a href="{{ route('sjSelesai',['srjalan_id'=>$srjalans[$i]['id']]) }}" class="btn btn-success btn-sm ms-1">Sj.Sls</a>
                                <a href="{{ route('SJ-PrintOut',['srjalan_id'=>$srjalans[$i]['id']]) }}" class="btn btn-dd btn-sm ms-1">PrintOut</a>
                                <a href="{{ route('SJ-Detail',['srjalan_id'=>$srjalans[$i]['id']]) }}" class="btn btn-warning btn-sm ms-1">Detail</a>
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
