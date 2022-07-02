@extends('layouts/main_layout')

@section('content')

<h2>{{ $judul }}</h2>

<form action="/spk/inserting-general-db" method="POST" id="form_spk_item" class="m-1em" name="form_spk_item">
@csrf
<input type="text" name="nama_lengkap" class="form-control">
{{-- ELEMENT UNTUK SJ VARIASI --}}
<div id="container-bahan" class="mb-3 element-sj-variasi" style="display: none">
    <div>Pilih Bahan:</div>
    <input type="text" id="bahan" name="bahan" class="input-normal @error('bahan') is-invalid @enderror" style="border-radius:5px;">
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
            <option value='{"id":{{ $ukurans[$i]->id }}, "nama":"{{ $ukurans[$i]->nama }}", "nama_nota":"{{ $ukurans[$i]->nama_nota }}", "harga":{{ $ukurans[$i]->harga }}}'>{{ $ukurans[$i]->nama }}</option>
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
    <input type="text" id="kombi" name="kombi" class="input-normal @error('kombi') is-invalid @enderror" style="border-radius:5px;">
    @error('kombi')
    <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
    <input type="hidden" id="kombi_id" name="kombi_id">
    <input type="hidden" id="kombi_harga" name="kombi_harga">
</div>

{{-- ELEMENT UNTUK SJ STANDAR --}}
<div id="container-standar" class="mb-3 element-sj-standar" style="display: none">
    <label>Pilih Standar:</label>
    <input type="text" id="standar" name="standar" class="input-normal @error('standar') is-invalid @enderror" style="border-radius:5px;">
    @error('standar')
    <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
    <input type="hidden" id="standar_id" name="standar_id">
    <input type="hidden" id="standar_harga" name="standar_harga">
</div>

{{-- ELEMENT UNTUK TANKPAD --}}
<div id="container-tankpad" class="mb-3 element-sj-tankpad" style="display: none">
    <label for="">Pilih Tankpad:</label>
    <div>
    <input type='text' id='tankpad' name='tankpad' class='input-normal @error('tankpad') is-invalid @enderror' style='border-radius:5px;'>
    @error('tankpad')
    <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
    <input type='hidden' id='tankpad_id' name='tankpad_id'>
    <input type='hidden' id='tankpad_harga' name='tankpad_harga'>
    </div>
</div>

{{-- ELEMENT UNTUK BUSASTANG --}}
<div id="container-busastang" class="mb-3 element-sj-busastang" style="display: none">
    <br>
    <div id='div_input_busastang'>
    <input type='text' id='busastang' name='busastang' class='input-normal @error('busastang') is-invalid @enderror' style='border-radius:5px;' value='Busa-Stang'>
    @error('busastang')
    <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
    <input type='hidden' id='busastang_id' name='busastang_id'>
    <input type='hidden' id='busastang_harga' name='busastang_harga'>
    </div>
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
    <div id='div_pilih_bahan_tspjap'>
        <input type='text' id='bahan_tspjap' name='bahan_tspjap' class='input-normal @error('bahan_tspjap') is-invalid @enderror' style='border-radius:5px;'>
        @error('bahan_tspjap')
        <div class='invalid-feedback'>{{ $message }}</div>
        @enderror
        <input type='hidden' id='bahan_tspjap_id' name='bahan_tspjap_id'>
    </div>
    <br>
    <div>Pilih T.Sixpack/Japstyle:</div>
    <select id='select_tspjap' name='tspjap_id' class='form-select' onchange='assignTspjapIDValue(this.selectedIndex);'></select>
    <input type='hidden' id='tspjap' name='tspjap'>
    <input type='hidden' id='tspjap_harga' name='tspjap_harga'>
</div>

{{-- ELEMENT UNTUK STIKER --}}
<div id="container-stiker" class="mb-3 element-sj-stiker" style="display: none">
    <label for="">Pilih Stiker:</label>
    <div id='div_input_stiker'>
    <input type='text' id='stiker' name='stiker' class='input-normal @error('stiker') is-invalid @enderror' style='border-radius:5px;'>
    @error('stiker')
    <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
    <input type='hidden' id='stiker_id' name='stiker_id'>
    <input type='hidden' id='stiker_harga' name='stiker_harga'>
    </div>
</div>

{{-- ELEMENT UNTUK MOTIF --}}
<div id="container-motif" class="mb-3 element-sj-motif" style="display: none">
    <label for="">Pilih motif:</label>
    <div id='div_input_motif'>
    <input type='text' id='motif' name='motif' class='input-normal @error('motif') is-invalid @enderror' style='border-radius:5px;'>
    @error('motif')
    <div class='invalid-feedback'>{{ $message }}</div>
    @enderror
    <input type='hidden' id='motif_id' name='motif_id'>
    <input type='hidden' id='motif_harga' name='motif_harga'>
    </div>
</div>

<div id="container-jumlah" class="mb-3">
    <label for="">Jumlah:</label>
    <input id='ipt_jumlah' type="number" name="jumlah" min="0" step="1" placeholder="Jumlah" class="p-0_5em @error('jumlah') is-invalid @enderror" style="border-radius:5px;">
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

    const tspjaps = {!! json_encode($tspjaps, JSON_HEX_TAG) !!};
    const label_tspjap_a = {!! json_encode($label_tspjap_a, JSON_HEX_TAG) !!};
    const label_tspjap_b = {!! json_encode($label_tspjap_b, JSON_HEX_TAG) !!};
    const d_bahan_a = {!! json_encode($d_bahan_a, JSON_HEX_TAG) !!};
    const d_bahan_b = {!! json_encode($d_bahan_b, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log('tspjaps:'); console.log(tspjaps);
        console.log('mode:'); console.log(mode);
        console.log('tipe:'); console.log(tipe);
        console.log('label_tspjap_a:'); console.log(label_tspjap_a);
        console.log('label_tspjap_b:'); console.log(label_tspjap_b);
        console.log('d_bahan_a:'); console.log(d_bahan_a);
        console.log('d_bahan_b:'); console.log(d_bahan_b);
    }

    if (tipe === 'varia') {
        const element_sj_variasi = document.querySelectorAll('.element-sj-variasi');

        element_sj_variasi.forEach(element => {
            element.style.display = 'block';
        });

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
        document.querySelector('.element-sj-tankpad').style.display = 'block';

        const tankpads = {!! json_encode($tankpads, JSON_HEX_TAG) !!};

        if (show_console) {
            console.log('tankpads');
            console.log(tankpads);
        }

        $("#tankpad").autocomplete({
            source: tankpads,
            select: function(event, ui) {
                // console.log(ui.item);
                $("#tankpad_id").val(ui.item.id);
                $("#tankpad_harga").val(ui.item.harga);
                // show_select_variasi();
                // show_options(available_options);
            }
        });

    } else if (tipe === 'busastang') {
        document.querySelector('.element-sj-busastang').style.display = 'block';

        const busastangs = {!! json_encode($busastangs, JSON_HEX_TAG) !!};

        if (show_console) {
            console.log('busastangs');
            console.log(busastangs);
        }

        $("#busastang").autocomplete({
            source: busastangs,
            select: function(event, ui) {
                // console.log(ui.item);
                $("#busastang_id").val(ui.item.id);
                $("#busastang_harga").val(ui.item.harga);
                // show_select_variasi();
                // show_options(available_options);
            }
        });

        if (busastangs.length === 1) {
            document.getElementById('busastang').value = busastangs[0].value;
            document.getElementById('busastang').readOnly = true;
            document.getElementById('busastang_id').value = busastangs[0].id;
            document.getElementById('busastang_harga').value = busastangs[0].harga;
        }

    } else if (tipe === 'tspjap') {
        document.querySelector('.element-sj-tspjap').style.display = 'block';
        setAutocomplete_D_Bahan();
    } else if (tipe === 'stiker') {
        document.querySelector('.element-sj-stiker').style.display = 'block';

        const stikers = {!! json_encode($stikers, JSON_HEX_TAG) !!};

        if (show_console) {
            console.log('stikers');
            console.log(stikers);
        }

        $("#stiker").autocomplete({
            source: stikers,
            select: function(event, ui) {
                // console.log(ui.item);
                $("#stiker_id").val(ui.item.id);
                $("#stiker_harga").val(ui.item.harga);
                // show_select_variasi();
                // show_options(available_options);
            }
        });
    } else if (tipe === 'motif') {
        document.querySelector('.element-sj-motif').style.display = 'block';

        const motifs = {!! json_encode($motifs, JSON_HEX_TAG) !!};

        if (show_console) {
            console.log('motifs');
            console.log(motifs);
        }

        $("#motif").autocomplete({
            source: motifs,
            select: function(event, ui) {
                // console.log(ui.item);
                $("#motif_id").val(ui.item.id);
                $("#motif_harga").val(ui.item.harga);
                // show_select_variasi();
                // show_options(available_options);
            }
        });
    }

    function setAutocomplete_D_Bahan() {
        const tipe_bahan = document.getElementById('tipe_bahan').value;
        var label_tspjap = null;
        var label_bahan = new Array();
        if (tipe_bahan === 'A') {
            label_bahan = d_bahan_a;
            label_tspjap = label_tspjap_a;
        } else {
            label_bahan = d_bahan_b;
            label_tspjap = label_tspjap_b;
        }
        console.log(tipe_bahan);
        $("#bahan_tspjap").autocomplete({
            source: label_bahan,
            select: function(event, ui) {
                // console.log(ui.item);
                $("#bahan_tspjap_id").val(ui.item.id);
                // show_select_variasi();
                // show_options(available_options);
            }
        });

        var optionTspjap = '';

        label_tspjap.forEach(l_tspjap => {
            optionTspjap += `<option value=${l_tspjap.id}>${l_tspjap.label}</option>`;
        });

        document.getElementById('select_tspjap').innerHTML = optionTspjap;

        assignTspjapIDValue(0);
    }

    function assignTspjapIDValue(selectedIndex) {
        // console.log(selectedIndex);
        const tipe_bahan = document.getElementById('tipe_bahan').value;
        var label_tspjap = null;
        if (tipe_bahan === 'A') {
            label_tspjap = label_tspjap_a;
        } else {
            label_tspjap = label_tspjap_b;
        }
        document.getElementById('tspjap').value = label_tspjap[selectedIndex].value;
        document.getElementById('tspjap_harga').value = label_tspjap[selectedIndex].harga;

        if (show_console) {
            console.log('selectedIndex:');console.log(selectedIndex);
            console.log('tipe_bahan:');console.log(tipe_bahan);
        }
    }
</script>

@endsection


