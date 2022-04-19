@extends('layouts/main_layout')

@section('content')

<h2>{{ $judul }}</h2>

<form action="/spk/inserting-general-db" method="POST" id="form_spk_item" class="m-1em" name="form_spk_item">
@csrf
{{-- ELEMENT UNTUK SJ VARIASI --}}
<div id="container-bahan" class="mb-3 element-sj-variasi" style="display: none">
    <div>Pilih Bahan:</div>
    <input type="text" id="bahan" name="bahan" class="input-normal" style="border-radius:5px;">
    @error('bahan')
    <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
    <input type="hidden" id="bahan_id" name="bahan_id">
    <input type="hidden" id="bahan_harga" name="bahan_harga">
</div>
<div id="container-variasi" class="mb-3 element-sj-variasi" style="display: none">
    <label for="variasi" class="mt-1em">Pilih Variasi:</label>
    <select id="variasi" name="variasi" class="p-0_5em" style="border-radius:5px;">
        @for ($i = 0; $i < count($varias); $i++)
        <option value='{"id":{{ $varias[$i]->id }}, "nama":"{{ $varias[$i]->nama }}", "harga":{{ $varias[$i]->harga }}}'>{{ $varias[$i]->nama }}</option>
        @endfor
    </select>
</div>
<div id="container-ukuran" class="mb-3 element-sj-variasi" style="display: none">
    <label for="select_ukuran">Pilih Ukuran:</label>
    <div class="grid-2-auto_10">
        <select id="select_ukuran" name="ukuran" style="border-radius:5px;padding:0.5em;">
            <option value="" disabled selected>Pilih Jenis Ukuran</option>
            @for ($i = 0; $i < count($ukurans); $i++)
            <option value='{"id":{{ $ukurans[$i]->id }}, "nama":"{{ $ukurans[$i]->nama }}", "harga":{{ $ukurans[$i]->harga }}}'>{{ $ukurans[$i]->nama }}</option>
            @endfor
        </select>
    </div>
</div>
<div id="container-jahit" class="mb-3 element-sj-variasi" style="display: none">
    <label for="">Tambah Jahit Kepala:</label>
    <div class="grid-2-auto_10">
        <select id="sel_jahit" name="jahit" style="border-radius:5px;padding:0.5em;">
            <option value="" disabled selected>Pilih Jenis Jahit</option>
            @for ($i = 0; $i < count($jahits); $i++)
            <option value='{"id":{{ $jahits[$i]->id }}, "nama":"{{ $jahits[$i]->nama }}", "harga":{{ $jahits[$i]->harga }}}'>{{ $jahits[$i]->nama }}</option>
            @endfor
        </select>
    </div>
</div>
{{-- ELEMENT UNTUK SJ KOMBINASI --}}
<div id="container-kombinasi" class="mb-3 element-sj-kombinasi" style="display: none">
    <label>Pilih Kombinasi:</label>
    <input type="text" id="kombi" name="kombi" class="input-normal" style="border-radius:5px;">
    @error('kombi')
    <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
    <input type="hidden" id="kombi_id" name="kombi_id">
    <input type="hidden" id="kombi_harga" name="kombi_harga">
</div>

{{-- ELEMENT UNTUK SJ STANDAR --}}
<div id="container-standar" class="mb-3 element-sj-standar" style="display: none">
    <label>Pilih Standar:</label>
    <input type="text" id="standar" name="standar" class="input-normal" style="border-radius:5px;">
    @error('standar')
    <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
    <input type="hidden" id="standar_id" name="standar_id">
    <input type="hidden" id="standar_harga" name="standar_harga">
</div>

{{-- ELEMENT UNTUK TANKPAD --}}
<div id="container-tankpad" class="mb-3 element-sj-tankpad" style="display: none">

</div>

{{-- ELEMENT UNTUK BUSASTANG --}}
<div id="container-busastang" class="mb-3 element-sj-busastang" style="display: none">

</div>

{{-- ELEMENT UNTUK T.SIXPACK JAPSTYLE --}}
<div id="container-tspjap" class="mb-3 element-sj-tspjap" style="display: none">
    <label for="">Pilih Tipe Bahan:</label>
    <div id='div_pilih_tipe_bahan'>
        <select id='tipe_bahan' name='tipe_bahan' class='form-select' onchange='setAutocomplete_D_Bahan();'>
            <option value='A'>Bahan(A)</option>
            <option value='B'>Bahan(B)</option>
        </select>
    </div>
    <br>
    Pilih Bahan:
    <div id='div_pilih_bahan'>
        <input type='text' id='bahan' name='bahan' class='input-normal' style='border-radius:5px;'>
        <input type='hidden' id='bahan_id' name='bahan_id'>
    </div>
    <br>
    <div>Pilih T.Sixpack/Japstyle:</div>
    <select id='select_tspjap' name='tspjap_id' class='form-select' onchange='assignTspjapIDValue(this.selectedIndex);'></select>
    <input type='hidden' id='tspjap' name='tspjap'>
    <input type='hidden' id='tspjap_harga' name='tspjap_harga'>
</div>

{{-- ELEMENT UNTUK STIKER --}}
<div id="container-stiker" class="mb-3 element-sj-stiker" style="display: none">
</div>

<div id="container-jumlah" class="mb-3">
    <label for="">Jumlah:</label>
    <input id='ipt_jumlah' type="number" name="jumlah" min="0" step="1" placeholder="Jumlah" class="p-0_5em" style="border-radius:5px;">
    @error('jumlah')
    <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
</div>
<div id="container-keterangan">
    <label>Keterangan <span style="color:grey">(opsional)</span>:</label>
    <div class='text-right'><span id="close_ktrg" class='ui-icon ui-icon-closethick' onclick='alternate_show(this.id, ${props_alternate_ktrg});'></span></div>
    <textarea id='ktrg' class="pt-1em pl-1em text-area-mode-1" name="ktrg" id="taDesc" placeholder="Keterangan"></textarea>
</div>

<div style="height: 30vh"></div>
    <br><br>


    <div id="divAvailableOptions" class="position-fixed bottom-5em w-calc-100-1em">
        Available options:
        <div id="container_options">
            {{-- {!! $available_options !!} --}}
        </div>

    </div>



    <div class="position-fixed bottom-0_5em w-calc-100-2em">
        <button type="submit" id="bottomDiv" class="btn-warning-full grid-1-auto">
            <span id="btn_submit" class="justify-self-center font-weight-bold">TAMBAH ITEM KE SPK</span>
        </button>
    </div>
    <input id="tipe" type="hidden" name="tipe" value="{{ $tipe }}">
    <input id="mode" type="hidden" name="mode" value="{{ $mode }}">
    {{-- Pada mode insert baru, spk_id akan bernilai null, sedangkan pada mode inserting from detail, spk_id akan diketahui --}}
    <input id="spk_id" type="hidden" name="spk_id" value="{{ $spk_id }}">
    <div id="container_input_hidden"></div>
</form>

<script>
    const mode = {!! json_encode($mode, JSON_HEX_TAG) !!};
    const tipe = {!! json_encode($tipe, JSON_HEX_TAG) !!};

    if (tipe === 'varia') {
        document.querySelector('.element-sj-variasi').style.display = 'block';

        const bahans = {!! json_encode($bahans, JSON_HEX_TAG) !!};
        const varias = {!! json_encode($varias, JSON_HEX_TAG) !!};
        const ukurans = {!! json_encode($ukurans, JSON_HEX_TAG) !!};
        const jahits = {!! json_encode($jahits, JSON_HEX_TAG) !!};

        if (show_console) {
            console.log('mode:');console.log(mode);
            console.log('tipe:');console.log(tipe);
            console.log('bahans:');console.log(bahans);
            console.log('varias:');console.log(varias);
            console.log('ukurans:');console.log(ukurans);
            console.log('jahits:');console.log(jahits);
        }

        $("#bahan").autocomplete({
            source: bahans,
            select: function(event, ui) {
                // console.log(ui.item);
                $("#bahan_id").val(ui.item.id);
                $("#bahan_harga").val(ui.item.harga);
            }
        });

    } else if (tipe === 'kombinasi') {
        document.querySelector('.element-sj-kombinasi').style.display = 'block';

        const kombis = {!! json_encode($kombis, JSON_HEX_TAG) !!};

        if (show_console) {
            console.log('kombis');
            console.log(kombis);
        }

        $("#kombi").autocomplete({
            source: kombis,
            select: function(event, ui) {
                // console.log(ui.item);
                $("#kombi_id").val(ui.item.id);
                $("#kombi_harga").val(ui.item.harga);
                // show_select_variasi();
                // show_options(available_options);
            }
        });
    } else if (tipe === 'standar') {
        document.querySelector('.element-sj-standar').style.display = 'block';

        const standars = {!! json_encode($standars, JSON_HEX_TAG) !!};

        if (show_console) {
            console.log('standars');
            console.log(standars);
        }

        $("#standar").autocomplete({
            source: standars,
            select: function(event, ui) {
                // console.log(ui.item);
                $("#standar_id").val(ui.item.id);
                $("#standar_harga").val(ui.item.harga);
                // show_select_variasi();
                // show_options(available_options);
            }
        });
    } else if (tipe === 'tankpad') {

    } else if (tipe === 'busastang') {

    } else if (tipe === 'tspjap') {
        setAutocomplete_D_Bahan();
    } else if (tipe === 'stiker') {

    }

    function setAutocomplete_D_Bahan() {
        document.querySelector('.element-sj-tspjap').style.display = 'block';

        const d_bahan_a = {!! json_encode($d_bahan_a, JSON_HEX_TAG) !!};
        const d_bahan_b = {!! json_encode($d_bahan_b, JSON_HEX_TAG) !!};

        const tipe_bahan = document.getElementById('tipe_bahan').value;
        var label_bahan = new Array();
        if (tipe_bahan === 'A') {
            label_bahan = d_bahan_a;
        } else {
            label_bahan = d_bahan_b;
        }
        console.log(tipe_bahan);
        $("#bahan").autocomplete({
        source: label_bahan,
        select: function(event, ui) {
            // console.log(ui.item);
            $("#bahan_id").val(ui.item.id);
            // show_select_variasi();
            // show_options(available_options);
        }
    });
    }
</script>

@endsection


