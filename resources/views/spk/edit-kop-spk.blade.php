@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<form action="/spk/edit-kop-spk-db" method="POST">
    @csrf
    <div class="mt-1rem ml-1rem grid-2-10_auto">
        <div class="">
            <img class="w-2rem" src="/img/icons/pencil.svg" alt="">
        </div>
        <h3>Form Edit Kop SPK</h3>
    </div>

    <div class="ml-0_5rem mr-0_5rem mt-2rem">

        <div class="grid-2-auto grid-column-gap-1rem mt-1rem">
            <div class="pb-1rem">
                <label class="color-grey" for="SPKNo">No. SPK:</label>
                <input id="SPKNo" class="input-1" type="text" placeholder="No." value="{{ $spk['id'] }}" disabled="true">
                <input type="hidden" name="spk_id" value={{ $spk['id'] }}>
            </div>
            <div class="pb-1rem">
                <label for="date" class="color-grey">Tgl.:</label>
                <input type="datetime-local" class="input-select-option-1 @error('created_at') is-invalid @enderror" name="created_at" id="date" value="{{ date('Y-m-d\TH:i:s', strtotime($spk['created_at'])) }}">
                @error('created_at')
                <div class='invalid-feedback'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div id="divInputCustomerName" class="mt-1rem mb-1rem">
            <div class="bb-1px-solid-grey">
                <div class=" pb-1rem">
                    <label class="color-grey" for="inputCustomerName">Nama Pelanggan:</label>
                    <input id="inputCustomerName" class="input-1 bb-none" type="text" value="{{ $pelanggan_nama }}">
                    {{--  onkeyup="findCustomer(this.value);" --}}
                    <input id="inputPelangganID" type="hidden" name="pelanggan_id" class="@error('pelanggan_id') is-invalid @enderror" value={{ $pelanggan['id'] }}>
                    @error('pelanggan_id')
                    <div class='invalid-feedback'>{{ $message }}</div>
                    @enderror
                    <input id="inputResellerID" type="hidden" name="reseller_id" value={{ $reseller_id }}>
                </div>
                <div id="searchResults" class="d-none b-1px-solid-grey bb-none"></div>
            </div>
        </div>

        <div class="mt-1rem">
            <label for="titleDesc" class="color-grey">Keterangan (opt.):</label>
            <input id="titleDesc" class="input-1 pb-1rem" type="text" name="ket_judul" value="{{ $spk['ket_judul'] }}" placeholder="Keterangan Judul (opsional)">
        </div>


    </div>

    <input id="idChosenCustName" type="hidden">

    <br><br>
    <div class="text-center">
        <button id="btnCancel" type="button" class="btn btn-danger btn-sm" onclick="goBack();">Batalkan Perubahan</button>
    </div>

    <div class="text-center mt-1">
        <button id="btnEditSPK" type="submit" class="btn btn-warning">
            Konfirmasi Perubahan
        </button>
    </div>


    <div id="closingAreaPertanyaan" class="d-none position-absolute z-index-2 w-100vw h-100vh bg-color-grey top-0 opacity-0_5">
    </div>

</form>

<script>
    const spk = {!! json_encode($spk, JSON_HEX_TAG) !!};
    const pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
    const label_pelanggans = {!! json_encode($label_pelanggans, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log('spk:');console.log(spk);
        console.log('pelanggan:');console.log(pelanggan);
        console.log('label_pelanggans:');console.log(label_pelanggans);
    }

    $("#inputCustomerName").autocomplete({
        source: label_pelanggans,
        select: function(event, ui) {
            console.log(ui);
            $("#inputPelangganID").val(ui.item.id);
            $("#inputResellerID").val(ui.item.reseller_id);
        }
    });


</script>

@endsection
