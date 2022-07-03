@extends('layouts/main_layout')

@section('content')

<div class="container">
    <h2>SPK Baru: Input Nama Item</h2>
</div>

<form action="/spk/inserting-general-db" method="POST" id="form_spk_item" class="m-1em" name="form_spk_item">
<div class="container">
    @csrf
    <input id="produk" type="text" name="nama_lengkap" class="form-control">


    <div style="height: 30vh"></div>
        <br><br>


        <div id="divAvailableOptions" class="position-fixed bottom-5em w-calc-100-1em">
            Available options:
            <div id="container_options">
                {{-- {!! $available_options !!} --}}
            </div>

        </div>



    </div>
    <div class="position-fixed bottom-0_5em w-calc-100-2em">
        <button type="submit" id="bottomDiv" class="btn-warning-full grid-1-auto">
            <span id="btn_submit" class="justify-self-center font-weight-bold">TAMBAH ITEM KE SPK</span>
        </button>
    </div>
    <input id="mode" type="hidden" name="mode" value="{{ $mode }}">
    {{-- Pada mode insert baru, spk_id akan bernilai null, sedangkan pada mode inserting from detail, spk_id akan diketahui --}}
    <input id="spk_id" type="hidden" name="spk_id" value="{{ $spk_id }}">
    <div id="container_input_hidden"></div>
</form>

<script>
    const produks = {!! json_encode($produks, JSON_HEX_TAG) !!};
    console.log('produks');console.log(produks);

    $("#produk").autocomplete({
        source: produks,
        select: function(event, ui) {
            // console.log(ui.item);
            if (ui.item.tipe === 'varia') {

            }
            $("#produk_id").val(ui.item.id);
            $("#produk_harga").val(ui.item.harga);
        }
    });
</script>

@endsection


