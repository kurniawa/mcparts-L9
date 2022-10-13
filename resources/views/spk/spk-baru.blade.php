@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<form action="{{ route('SPKBaruDB') }}" method="POST" id="SPKBaru">
    {{-- diputuskan untuk memakai get, supaya tidak pusing ketika berpindah-pindah halaman --}}
    {{-- diputuskan untuk memakai post, caranya adalah langsung input ke database temp_spks --}}
    @csrf

    <div class="mt-1rem ml-1rem grid-2-10_auto">
        <div class="">
            <img class="w-2rem" src="/img/icons/pencil.svg" alt="">
        </div>
        <div class="font-weight-bold">
            Untuk siapa SPK ini?
        </div>
    </div>

    <div class="ml-0_5rem mr-0_5rem mt-2rem">

        <div class="grid-2-auto grid-column-gap-1rem mt-1rem">
            <input id="SPKNo" class="input-1 pb-1rem" type="text" placeholder="No." disabled>
            {{-- <input type="datetime-local" class="input-select-option-1 pb-1rem" name="tanggal" id="date"> --}}
            <input type="datetime-local" class="input-select-option-1 pb-1rem" name="tanggal" id="date" value="{{ date('Y-m-d\TH:i:s') }}">
        </div>

        <div id="divInputCustomerName" class="containerInputEkspedisi mt-1rem mb-1rem">
            <div class="bb-1px-solid-grey">
                <input id="inputCustomerName" class="input-1 pb-1rem bb-none" name="nama_pelanggan" type="text" placeholder="Pelanggan">
                <div id="searchResults" class="d-none b-1px-solid-grey bb-none"></div>
                <input id="inputIDCust" type="hidden" name="pelanggan_id">
                <input id="inputIDReseller" type="hidden" name="reseller_id">
            </div>
        </div>

        <input name="judul" id="titleDesc" class="input-1 mt-1rem pb-1rem" type="text" placeholder="Keterangan (opsional)">


    </div>

    <div class="container mt-3">
        <button type="submit" class="btn btn-warning w-100 pb-4 pt-4">
            Input Item SPK >>
        </button>
    </div>


</form>
@if (count($temp_spks)!==0)
<div class="container">
    <div class="fw-bold">Cart:</div>
    <form action="{{ route('SPK-Review') }}">
        <table class="table table-success table-striped">
            @for ($i = 0; $i < count($temp_spks); $i++)
            <tr>
                @if ($resellers[$i]!==null)
                <td style="vertical-align: middle">{{ $resellers[$i]['nama'] }}-{{ $pelanggans[$i]['nama'] }}</td>
                @else
                <td style="vertical-align: middle">{{ $pelanggans[$i]['nama'] }}</td>
                @endif
                <td class="text-end"><button class="btn btn-warning btn-sm" type="submit" name="temp_spk_id" value={{ $temp_spks[$i]['id'] }}>Lanjut >></button></td>
            </tr>
            @endfor
        </table>
    </form>

</div>

@endif


<script>
    const label_pelanggans = {!! json_encode($label_pelanggans, JSON_HEX_TAG) !!}
    const pelanggans = {!! json_encode($pelanggans, JSON_HEX_TAG) !!}
    console.log('pelanggans', pelanggans);
    // const pelanggan_resellers = {-!! json_encode($pelanggan_resellers, JSON_HEX_TAG) !!}

    if (show_console) {
        console.log("label_pelanggans");
        console.log(label_pelanggans);
        // console.log("pelanggan_resellers");
        // console.log(pelanggan_resellers);
    }

    $("#inputCustomerName").autocomplete({
    source: label_pelanggans,
    select: function(event, ui) {
        console.log(ui);
        $("#inputIDCust").val(ui.item.id);
        $("#inputIDReseller").val(ui.item.reseller_id);
        // console.log(event);
        // alert(ui.item.name);
    }
});

</script>

<style>

</style>
@endsection
