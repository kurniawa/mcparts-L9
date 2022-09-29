@extends('layouts.main_layout')
@extends('layouts.navbar_v2')

@section('content')

<div class="grid-2-auto mt-1rem ml-1rem mr-1rem pb-1rem div-cari-filter">
    <div class="justify-self-left grid-2-auto b-1px-solid-grey b-radius-50px mr-1rem pl-1rem pr-0_4rem w-11rem">
        <input class="input-2 mt-0_4rem mb-0_4rem" type="text" placeholder="Cari...">
        <div class="justify-self-right grid-1-auto justify-items-center circle-small bg-color-orange-1">
            <img class="w-0_8rem" src="/img/icons/loupe.svg" alt="">
        </div>
    </div>
    <div class="div-filter-icon">

        <div class="icon-small-circle bg-color-orange-1">
            <img class="icon-img w-1rem" src="/img/icons/sort-by-attributes.svg" alt="sort-icon">
        </div>
    </div>
</div>

<div id="list_pelanggan">
    @for ($i = 0; $i < count($pelanggans); $i++)
    <div class='ml-1rem mr-1rem pb-1rem bb-1px-solid-grey pt-1rem font-size-0_9rem'>
        <div class='grid-3-10_80_10'>
            <div class='initial circle-medium grid-1-auto justify-items-center font-weight-bold' style='background-color:#D1FFCA'>{{ $pelanggans[$i]['initial'] }}</div>
            @if ($alamats[$i]!==null)
            <div class='justify-self-left font-weight-bold'>{{ $pelanggans[$i]['nama'] }} - {{ $alamats[$i]['short'] }}</div>
            @else
            <div class='justify-self-left font-weight-bold'>{{ $pelanggans[$i]['nama'] }}</div>
            @endif
            <div id='divDropdownIcon-{{ $pelanggans[$i]['id'] }}' class='justify-self-right' onclick="showDropdown({{ $pelanggans[$i]['id'] }});"><img class='w-0_7rem' src='{{ asset('img/icons/dropdown.svg') }}'></div>
        </div>

    {{-- DROPDOWN --}}
        <div id='divDetailDropdown-{{ $pelanggans[$i]['id'] }}' class='b-1px-solid-grey p-0_5rem mt-1rem' style='display:none'>
            <div class='grid-2-10_auto'>
                <div><img class='w-2rem' src='{{ asset('img/icons/address.svg') }}'></div>
                <div>
                    @if ($alamats[$i]!==null)
                    @if ($alamats[$i]['long']!==null)
                    @foreach (json_decode($alamats[$i]['long'],true) as $alamat)
                    {{ $alamat }}<br>
                    @endforeach
                    @endif
                    @else
                    -
                    @endif
                </div>
                <div><img class='w-2rem' src='{{ asset('img/icons/call.svg') }}'></div>
                <div>
                    @if ($pelanggan_kontaks[$i]!==null)
                    @if ($pelanggan_kontaks[$i]['kodearea']!==null)
                    {{ $pelanggan_kontaks[$i]['kodearea'] }} {{ $pelanggan_kontaks[$i]['nomor'] }}
                    @else
                    {{ $pelanggan_kontaks[$i]['nomor'] }}
                    @endif
                    @else
                    -
                    @endif
                </div>
            </div>
            <div class='grid-1-auto justify-items-right mt-1rem'>
                <a href="{{ route('pelanggan_detail',['pelanggan_id'=>$pelanggans[$i]['id']]) }}" class='bg-color-orange-1 b-radius-50px pl-1rem pr-1rem'>Lebih Detail >></a>
            </div>
        </div>
    </div>

    {{-- END OF DROPDOWN --}}
    @endfor
</div>

<script>
    // const show_console = true;

    const pelanggans = {!! json_encode($pelanggans, JSON_HEX_TAG) !!};

    if (show_console === true) {
        console.log('pelanggans');console.log(pelanggans);
    }

    $arrayBgColors = ["#FFB08E", "#DEDEDE", "#D1FFCA", "#FFB800"];
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
        width: 2.5em;
        height: 2.5em;
        position: relative;
    }

    .icon-img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* .hr {
        box-shadow: none;
    } */
    .div-cari-filter {
        border-bottom: 0.5px solid #E4E4E4;
    }
</style>

@endsection
