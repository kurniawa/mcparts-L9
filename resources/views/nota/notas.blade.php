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
    <form method='GET' action="{{ route('Nota-Detail') }}" class="mt-1">
    <table class="table table-success table-striped">
    @for ($i = 0; $i < count($notas); $i++)
        <tr style="vertical-align: middle">
            <td><div class='rounded-circle d-flex align-items-center justify-content-center font-weight-bold' style='background-color:salmon;width:2rem;height:2rem'>{{ $pelanggans[$i]['initial'] }}</div></td>
            <td>
                <div class="row"><div class="col fw-bold" style="color: blue">{{ $notas[$i]['no_nota'] }}</div></div>
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
                        <td>{{ $arr_produks[$i][$j]['nama'] }}</td>
                        <td>{{ $arr_spk_produks[$i][$j]['jml_t'] }}</td>
                        <td class="harga_item">{{ $arr_spk_produk_notas[$i][$j]['harga'] }}</td>
                        <td class="harga_t">{{ $arr_spk_produk_notas[$i][$j]['harga_t'] }}</td>
                    </tr>
                    @endfor
                    <tr><td colspan="4" class='text-end'><button type="submit" name='nota_id' value="{{ $notas[$i]['id'] }}" class="btn btn-warning btn-sm">Detail</button></td></tr>
                </table>
            </td>
        </tr>
    @endfor
    </table>
    </form>
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
