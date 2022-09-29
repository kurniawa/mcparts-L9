@extends('layouts.main_layout')
@extends('layouts.navbar')

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

<div class="container">
    <table id="list_ekspedisi" style="width:100%;border-collapse:collapse;">
        @for ($i = 0; $i < count($ekspedisis); $i++)
        <tr style="border-top: 1px solid gray">
            <td class="fw-bold pt-2 pb-2">
            @if ($ekspedisis[$i]['bentuk']!==null)
            {{ $ekspedisis[$i]['nama'] }} - {{ $ekspedisis[$i]['bentuk'] }}</td>
            @else
            {{ $ekspedisis[$i]['nama'] }}</td>
            @endif
            @if ($ekspedisi_kontaks[$i]!==null)
            <td class="fw-bold color-blue-purple">
            @if ($ekspedisi_kontaks[$i]['kodearea']!==null)
            ({{ $ekspedisi_kontaks[$i]['kodearea'] }}) {{ $ekspedisi_kontaks[$i]['nomor'] }}
            @else
            {{ $ekspedisi_kontaks[$i]['nomor'] }}
            @endif
            </td>
            @else
            <td>-</td>
            @endif
            <td id='divDropdownIcon-{{ $i }}' onclick='showDropdown({{ $i }});'><img src='{{ asset('img/icons/dropdown.svg') }}' style='width:0.7rem'></td>
            <tr id="divDetailDropdown-{{ $i }}" class='b-1px-solid-grey p-0_5rem mt-1rem' style='display:none'>
                <td colspan=3>
                    <table style="width:100%">
                        <tr>
                            <td><img class='w-2rem' src='{{ asset('img/icons/address.svg') }}'></td>
                            <td style="width:50%;">
                                @if ($alamats[$i]!==null)
                                @foreach (json_decode($alamats[$i]['long'],true) as $alamat)
                                <div>{{ $alamat }}</div>
                                @endforeach
                                @endif
                            </td>
                            <td valign="bottom" align="right">
                                <form action='{{ route('DetailEkspedisi') }}' method='GET'>
                                    <input type="hidden" name="ekspedisi_id" value={{ $ekspedisis[$i]['id'] }}>
                                    <button class="btn btn-warning">Detail</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
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
        padding: 0.5em 1rem 0.5em 1rem;
        box-shadow: 0 0 2px gray;
    }

    .input-cari:focus {
        box-shadow: 0 0 6px #23FFAD;
    }

    .field {
        margin: 1rem;
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
