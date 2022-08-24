@extends('layouts.main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8rem ml-1_5rem" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div class="justify-self-right pr-0_5rem">
        <!-- <a href="06-02-produk-baru.php" id="btnNewProduct" class="btn-atas-kanan2">
            + Tambah Produk Baru
        </a> -->
    </div>
</header>
<form action="{{ route('SPK-Review') }}" method="GET" id="SPKBaru">
    {{-- diputuskan untuk memakai get, supaya tidak pusing ketika berpindah-pindah halaman --}}
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


    <br><br>

    <div id="warning" class="d-none"></div>

    <div class="m-1rem">
        <button type="submit" class="btn btn-warning w-100 pb-4 pt-4">
            Input Item SPK >>
        </button>
    </div>

    <div id="closingAreaPertanyaan" class="d-none position-absolute z-index-2 w-100vw h-100vh bg-color-grey top-0 opacity-0_5">
    </div>

</form>


<script>
    const label_pelanggans = {!! json_encode($label_pelanggans, JSON_HEX_TAG) !!}
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
