@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <h2>Produk Baru</h2>
    <h6>Tipe: {{ $tipe }}</h6>
    <form id="formAddProduk" action="{{ route('tambahProdukDB') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="tipe" value="{{ $tipe }}">
        <div class="row mb-2">
            <div class="col" id="div-bahan" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" id="btn-close-bahan" onclick="showHide('btn-bahan', 'div-bahan')" style="display: none">X</button>
                <div class="form-floating">
                    <input type="text" name="bahan" id="bahan" placeholder="Bahan" class="form-control autoname">
                    <label for="bahan">Bahan</label>
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-kombinasi" style="display: none">
                <div class="form-floating">
                    <input type="text" id="kombinasi" name="kombinasi" class="form-control autoname" style="border-radius:5px;" placeholder="Kombinasi">
                    <label for="kombinasi">Kombinasi</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-motif" style="display: none">
                <div class="form-floating">
                    <input type="text" id="motif" name="motif" class="form-control autoname" style="border-radius:5px;" placeholder="Motif">
                    <label for="motif">Motif</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-tsixpack" style="display: none">
                <div class="form-floating">
                    <input type="text" id="tsixpack" name="tsixpack" class="form-control autoname" style="border-radius:5px;" placeholder="T.Sixpack" value="T.Sixpack" readonly>
                    <label for="tsixpack">T.Sixpack</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-japstyle" style="display: none">
                <div class="form-floating">
                    <input type="text" id="japstyle" name="japstyle" class="form-control autoname" style="border-radius:5px;" placeholder="Japstyle" value="Japstyle" readonly>
                    <label for="japstyle">Japstyle</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-standar" style="display: none">
                <div class="form-floating">
                    <input type="text" id="standar" name="standar" class="form-control autoname" style="border-radius:5px;" placeholder="Standar">
                    <label for="standar">Standar</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-jokassy" style="display: none">
                <div class="form-floating">
                    <input type="text" id="jokassy" name="jokassy" class="form-control autoname" style="border-radius:5px;" placeholder="Jok Assy">
                    <label for="jokassy">Jok Assy</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-tankpad" style="display: none">
                <div class="form-floating">
                    <input type="text" id="tankpad" name="tankpad" class="form-control autoname" style="border-radius:5px;" placeholder="Tankpad">
                    <label for="tankpad">Tankpad</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-stiker" style="display: none">
                <div class="form-floating">
                    <input type="text" id="stiker" name="stiker" class="form-control autoname" style="border-radius:5px;" placeholder="Stiker">
                    <label for="stiker">Stiker</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-busastang" style="display: none">
                <div class="form-floating">
                    <input type="text" id="busastang" name="busastang" class="form-control autoname" style="border-radius:5px;" placeholder="Busa Stang">
                    <label for="busastang">Busa Stang</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-rotan" style="display: none">
                <div class="form-floating">
                    <input type="text" id="rotan" name="rotan" class="form-control autoname" style="border-radius:5px;" placeholder="Rotan">
                    <label for="rotan">Rotan</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-rol" style="display: none">
                <div class="form-floating">
                    <input type="text" id="rol" name="rol" class="form-control autoname" style="border-radius:5px;" placeholder="Rol">
                    <label for="rol">Rol</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-grade_bahan" style="display: none">
                <label for="grade_bahan">Grade Bahan:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-grade_bahan', 'div-grade_bahan')">X</button>
                <select name="grade_bahan" id="grade_bahan" class="form-control autoname">
                    <option value="">-</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-variasi_1" style="display: none">
                <label for="variasi_1">Variasi 1:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" style="display: none" id="btn-close-variasi_1" onclick="showHide('btn-variasi_1', 'div-variasi_1')">X</button>
                <select name="variasi_1" id="variasi_1" class="form-control autoname">
                    <option value="">-</option>
                    @foreach ($variasis as $variasi)
                    <option value="{{ $variasi['nama'] }}">{{ $variasi['nama'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" id="div-varian_1" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" id="btn-close-varian_1" onclick="showHide('btn-varian_1', 'div-varian_1')">X</button>
                <div class="form-floating">
                    <input type="text" name="varian_1" id="varian_1" placeholder="Varian 1" class="form-control autoname">
                    <label for="varian_1">Varian 1</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-variasi_2" style="display: none">
                <label for="variasi_2">Variasi 2:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-variasi_2', 'div-variasi_2')">X</button>
                <select name="variasi_2" id="variasi_2" class="form-control autoname">
                    <option value="">-</option>
                    @foreach ($variasis as $variasi)
                    <option value="{{ $variasi['nama'] }}">{{ $variasi['nama'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" id="div-varian_2" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-varian_2', 'div-varian_2')">X</button>
                <div class="form-floating">
                    <input type="text" name="varian_2" id="varian_2" placeholder="Varian 2" class="form-control autoname">
                    <label for="varian_2">Varian 2</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-ukuran" style="display: none">
                <label for="ukuran">Ukuran</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-ukuran', 'div-ukuran')">X</button>
                <select name="ukuran" id="ukuran" class="form-control autoname" pattern="ukuran">
                    <option value="">-</option>
                    @foreach ($ukurans as $ukuran)
                    <option value="{{ $ukuran['label'] }}">{{ $ukuran['label'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" id="div-jahit" style="display: none">
                <label for="jahit">Jahit</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-jahit', 'div-jahit')">X</button>
                <select name="jahit" id="jahit" class="form-control autoname" pattern="jahit">
                    <option value="">-</option>
                    @foreach ($jahits as $jahit)
                    <option value="{{ $jahit['label'] }}">{{ $jahit['label'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-busa" style="display: none">
                <label for="busa">Busa</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-busa', 'div-busa')">X</button>
                <select name="busa" id="busa" class="form-control autoname" pattern="busa">
                    <option value="">-</option>
                    @foreach ($busas as $busa)
                    <option value="{{ $busa['label'] }}">{{ $busa['label'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" id="div-sayap" style="display: none">
                <label for="sayap">Sayap:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-sayap', 'div-sayap')">X</button>
                <select name="sayap" id="sayap" class="form-control autoname" pattern="sayap">
                    <option value="">-</option>
                    @foreach ($sayaps as $sayap)
                    <option value="{{ $sayap['label'] }}">{{ $sayap['label'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-list" style="display: none">
                <label for="list">List</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-list', 'div-list')">X</button>
                <select name="list" id="list" class="form-control autoname" pattern="List">
                    <option value="">-</option>
                    @foreach ($lists as $list)
                    <option value="{{ $list['label'] }}">{{ $list['label'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" id="div-alas" style="display: none">
                <label for="alas">Alas:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-alas', 'div-alas')">X</button>
                <select name="alas" id="alas" class="form-control autoname">
                    <option value="">-</option>
                    @foreach ($alass as $alas)
                    <option value="{{ $alas['label'] }}">{{ $alas['label'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-tipe_packing" style="display: none">
                <label for="tipe_packing">Tipe Packing:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-tipe_packing', 'div-tipe_packing')">X</button>
                <select name="tipe_packing" id="tipe_packing" class="form-select autoname">
                    <option value="colly">colly</option>
                    <option value="dus">dus</option>
                </select>
            </div>
            <div class="col" id="div-aturan_packing" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-aturan_packing', 'div-aturan_packing')">X</button>
                <div class="form-floating">
                    <input type="number" name="aturan_packing" id="aturan_packing" value="150" class="form-control autoname">
                    <label for="aturan_packing">Aturan Packing</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-harga">
                <div class="form-floating">
                    <input type="number" name="harga" id="harga" class="form-control">
                    <label for="harga">Harga</label>
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-keterangan" style="display: none">
                <label for="keterangan">Keterangan:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-keterangan', 'div-keterangan')">X</button>
                <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Keterangan"></textarea>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-nama">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
                <div id="valid-belum_ada" class="feedback valid-feedback">Produk belum ada!</div>
                <div id="invalid-sudah_ada" class="feedback invalid-feedback">Produk sudah ada!</div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-nama_nota">
                <label for="nama_nota">Nama Nota:</label>
                <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota">
            </div>
        </div>

        <div class="mb-2" id="div-foto_barang" style="display:none">
            <label for="foto_barang" class="form-label">Foto Barang:</label>
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-foto_barang', 'div-foto_barang')">X</button>
            <input class="form-control mb-3" type="file" id="foto_barang" name="foto_barang[]" onchange="previewImage(this.id, 'foto_barang-preview');">
            <div class="text-center">
                <img id="foto_barang-preview" style="max-width: 17rem">
            </div>
        </div>

        <div class="border border-info p-1">
            <small style="color:gray;font-size:0.8rem">
                <ul>
                    <li>Nama dan Nama Nota yang disarankan akan terinput otomatis</li>
                    @if ($tipe==="SJ-Variasi"||$tipe==="SJ-Kombinasi"||$tipe==="SJ-T.Sixpack"||$tipe==="SJ-Motif"||$tipe==="SJ-Standar"||$tipe==="SJ-Japstyle")
                    <li>Tipe Packing dan Aturan Packing apabila tidak ditentukan, sudah ada setting default nya, yakni tipe_packing = 'colly' dan aturan_packing = 150pcs</li>
                    @endif
                </ul>
            </small>
        </div>

        {{-- Validation Error --}}
        <input type="hidden" name="validation_error" class="@error('validation_error') is-invalid @enderror">
        @error('validation_error')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div>
            Opsi:<br>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-bahan" onclick="showHide('div-bahan', this.id)">+Bahan</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-ukuran" onclick="showHide('div-ukuran', this.id)">+Ukuran</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-jahit" onclick="showHide('div-jahit', this.id)">+Jahit</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-grade_bahan" onclick="showHide('div-grade_bahan', this.id)">+Grade Bahan</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-variasi_1" onclick="showHide('div-variasi_1', this.id)">+Variasi-1</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-varian_1" onclick="showHide('div-varian_1', this.id)">+Varian-1</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-variasi_2" onclick="showHide('div-variasi_2', this.id)">+Variasi-2</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-varian_2" onclick="showHide('div-varian_2', this.id)">+Varian-2</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-alas" onclick="showHide('div-alas', this.id)">+Alas</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-busa" onclick="showHide('div-busa', this.id)">+Busa</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-sayap" onclick="showHide('div-sayap', this.id)">+Sayap</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-list" onclick="showHide('div-list', this.id)">+List</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-keterangan" onclick="showHide('div-keterangan', this.id)">+Keterangan</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-tipe_packing" onclick="showHide('div-tipe_packing', this.id)">+TipePacking</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-aturan_packing" onclick="showHide('div-aturan_packing', this.id)">+AturanPacking</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-foto_barang" onclick="showHide('div-foto_barang', this.id)">+Foto</button>
        </div>

        <br><br>
        <div class="row mb-2">
            <div class="col text-center">
                <button type="button" class="col btn btn-primary" onclick="cekProduk('nama')">Cek Produk</button>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="col btn btn-warning">Tambah {{ $tipe }}</button>
            </div>
        </div>
    </form>
</div>

<script>
const tipe = {!! json_encode($tipe, JSON_HEX_TAG) !!};
const bahans = {!! json_encode($bahans, JSON_HEX_TAG) !!};
const varians = {!! json_encode($varians, JSON_HEX_TAG) !!};
const ukurans = {!! json_encode($ukurans, JSON_HEX_TAG) !!};
const jahits = {!! json_encode($jahits, JSON_HEX_TAG) !!};
const alass = {!! json_encode($alass, JSON_HEX_TAG) !!};
const busas = {!! json_encode($busas, JSON_HEX_TAG) !!};
/*Tsixpack*/
const tsixpacks = {!! json_encode($tsixpacks, JSON_HEX_TAG) !!};
/*Kombinasi*/
const kombinasis = {!! json_encode($kombinasis, JSON_HEX_TAG) !!};
const lists = {!! json_encode($lists, JSON_HEX_TAG) !!};
/*Motif*/
const motifs = {!! json_encode($motifs, JSON_HEX_TAG) !!};
/*Japstyle*/
// const japstyles = {-!! json_encode($japstyles, JSON_HEX_TAG) !!};
/*Standar*/
const standars = {!! json_encode($standars, JSON_HEX_TAG) !!};
const sayaps = {!! json_encode($sayaps, JSON_HEX_TAG) !!};
/*Jok Assy*/
const jokassies = {!! json_encode($jokassies, JSON_HEX_TAG) !!};
const tankpads = {!! json_encode($tankpads, JSON_HEX_TAG) !!};
const stikers = {!! json_encode($stikers, JSON_HEX_TAG) !!};
const rols = {!! json_encode($rols, JSON_HEX_TAG) !!};
const busastangs = {!! json_encode($busastangs, JSON_HEX_TAG) !!};
const rotans = {!! json_encode($rotans, JSON_HEX_TAG) !!};
/*Produks*/
const produks = {!! json_encode($produks, JSON_HEX_TAG) !!};

console.log('tankpads',tankpads);
console.log('stikers',stikers);
console.log('rols',rols);
console.log('rotans',rotans);

var attToShow = new Array();
var btnToShow = new Array();
var noticedInputs = new Array();

if (tipe === 'SJ-Variasi') {
    attToShow=['div-bahan','div-variasi_1'];
    btnToShow=['btn-varian_1','btn-ukuran','btn-jahit','btn-variasi_2','btn-varian_2'];
    noticedInputs=['bahan','variasi_1','varian_1','variasi_2','varian_2','ukuran','jahit']
}

if (tipe === 'SJ-Kombinasi') {
    attToShow=['div-kombinasi'];
    btnToShow=['btn-variasi_1','btn-close-variasi_1','btn-varian_1','btn-grade_bahan','btn-bahan','btn-close-bahan','btn-ukuran','btn-jahit','btn-list'];
    noticedInputs=['kombinasi','bahan','grade_bahan','variasi_1','varian_1','ukuran','jahit','list']
}

if (tipe === 'SJ-Motif') {
    attToShow=['div-motif'];
    btnToShow=['btn-grade_bahan','btn-bahan','btn-close-bahan','btn-ukuran','btn-jahit'];
    noticedInputs=['motif','bahan','grade_bahan','ukuran','jahit']
}

if (tipe === 'SJ-T.Sixpack') {
    attToShow=['div-bahan','div-tsixpack'];
    btnToShow=['btn-grade_bahan','btn-ukuran','btn-jahit','btn-alas','btn-busa'];
    noticedInputs=['bahan','grade_bahan','tsixpack','variasi_1','varian_1','ukuran','jahit','alas','busa']
}

if (tipe === 'SJ-Japstyle') {
    attToShow=['div-bahan','div-japstyle'];
    noticedInputs=['bahan','japstyle']
}

if (tipe === 'SJ-Standar') {
    attToShow=['div-standar'];
    btnToShow=['btn-grade_bahan','btn-bahan','btn-close-bahan','btn-alas','btn-sayap','btn-busa'];
    noticedInputs=['standar','bahan','grade_bahan','alas','busa','sayap']
}

if (tipe === 'Jok Assy') {
    attToShow=['div-jokassy'];
    noticedInputs=['jokassy']
}

if (tipe === 'Tankpad') {
    attToShow=['div-tankpad'];
    noticedInputs=['tankpad']
}

if (tipe === 'Stiker') {
    attToShow=['div-stiker'];
    noticedInputs=['stiker']
}

if (tipe === 'Busa-Stang') {
    attToShow=['div-busastang'];
    noticedInputs=['busastang']
}

if (tipe === 'Rotan') {
    attToShow=['div-rotan'];
    noticedInputs=['rotan']
}

if (tipe === 'Rol') {
    attToShow=['div-rol'];
    noticedInputs=['rol']
}

toShow(attToShow);toShow(btnToShow);

function toShow(params) {
    params.forEach(param => {
        console.log(param);
        document.getElementById(param).style.removeProperty('display');
    });
}

$('#bahan').autocomplete({source:bahans,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#varian_1').autocomplete({source:varians,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#varian_2').autocomplete({source:varians,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#ukuran').autocomplete({source:ukurans,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#jahit').autocomplete({source:jahits,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#tsixpack').autocomplete({source:tsixpacks,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#alas').autocomplete({source:alass,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#busa').autocomplete({source:busas,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#sayap').autocomplete({source:sayaps,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#list').autocomplete({source:lists,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#kombinasi').autocomplete({source:kombinasis,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#motif').autocomplete({source:motifs,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#jokassy').autocomplete({source:jokassies,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#standar').autocomplete({source:standars,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#tankpad').autocomplete({source:tankpads,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#stiker').autocomplete({source:stikers,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#busastang').autocomplete({source:busastangs,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#rol').autocomplete({source:rols,select:function(event,ui){this.value=ui.item.value;autoname();}});
$('#rotan').autocomplete({source:rotans,select:function(event,ui){this.value=ui.item.value;autoname();}});

function previewImage(image_id, preview_id) {
    console.log('image_id');console.log(image_id);
    console.log('preview_id');console.log(preview_id);
    const img = document.querySelector(`#${image_id}`);
    const imgPreview = document.querySelector(`#${preview_id}`);

    // const oFReader = new FileReader();
    // oFReader.readAsDataURL(img.files[0]);

    // oFReader.onload = function (oFREvent) {
    //     imgPreview.src = oFREvent.target.result;
    // }

    const blob = URL.createObjectURL(img.files[0]);
    imgPreview.src = blob;
}

function autoname() {
    // console.log('run autoname');
    var nama = nama_nota = '';
    var i = 0;
    noticedInputs.forEach(id => {
        var input = document.getElementById(id);
        // console.log('id',id);
        // console.log('input',input);
        $div_input = $(`#div-${id}`);
        // console.log(`#div-${id}, display:`,$div_input.css('display'));
        if ($div_input.css('display') !== 'none'&&input.value!==null&&input.value!=='') {
            if (i===0) {
                if (tipe!=='Tankpad'&&tipe!=='Busa-Stang'&&tipe!=='Stiker'&&tipe!=='Rol'&&tipe!=='Jok Assy'&&tipe!=='Rotan') {
                    nama_nota += 'SJ ';
                } else {
                    if (tipe==='Stiker') {
                        nama += `${tipe} `;
                        nama_nota += `${tipe} `;
                    }
                }
            }
            if (id==='bahan') {
                if (tipe!=='SJ-Variasi'&&tipe!=='SJ-T.Sixpack'&&tipe!=='SJ-Japstyle') {
                    nama += ` b.`;
                    nama_nota += ` b.`;
                }
            } else if (id==='grade_bahan') {
                if (input.value!=='A') {
                    nama += '(';
                    nama_nota += '(';
                }
            } else if(id==='ukuran'){
                nama += ' + uk.';
                nama_nota += ' + uk.';
            } else if (id==='jahit') {
                nama += ' + jht.';
                nama_nota += ' + jht.';
            } else if (id==='kombinasi') {
                nama += `Kombinasi `;
                nama_nota += `Kombinasi `;
            } else if (id==='motif') {
                nama += 'Motif ';
                nama_nota += 'Motif ';
            } else if (id==='standar') {
                nama += 'Standar ';
                nama_nota += 'Standar ';
            }  else if (id==='jokassy') {
                nama += 'Jok Assy ';
                nama_nota += 'Jok Assy ';
            }  else if (id==='rotan') {
                nama += 'Rotan ';
                nama_nota += 'Rotan ';
            }  else if (id==='tankpad') {
                nama += 'TP ';
                nama_nota += 'TP ';
            } else {
                if (i===1||id==='varian_1'||id==='varian_2') {
                    nama += ' ';
                    nama_nota += ' ';
                } else if (i>1) {
                    nama += ' + ';
                    nama_nota += ' + ';
                }
            }

            if (id==='grade_bahan') {
                if (input.value!=='A') {
                    nama += `${input.value})`;
                    nama_nota += `${input.value})`;
                }
            } else if (id==='ukuran') {
                console.log(input.value);
                var res_ukuran=ukurans.find(ukuran=>ukuran.value===input.value);
                // console.log(find_ukuran);
                nama += `${input.value}`;
                nama_nota += `${res_ukuran.nama_nota}`;
            } else if (id==='rol') {
                nama += `${input.value} Rol`;
                nama_nota += `${input.value} Rol`;
            } else {
                nama += `${input.value}`;
                nama_nota += `${input.value}`;
            }

        }

        i++;
    });

    document.getElementById('nama').value = nama;
    document.getElementById('nama_nota').value = nama_nota;
}

document.querySelectorAll('.autoname').forEach(input => {
    input.addEventListener('change', event=>{autoname();});
});

document.getElementById('formAddProduk').addEventListener('submit', event=> {
    event.preventDefault();
    let result = cekProduk('nama');

    if (result) {
        event.currentTarget.submit();
    }

    return false;
});

function cekProduk(id) {
    var nama = document.getElementById(id).value;
    let res = produks.find(obj=>obj.nama===nama);
    console.log(res);
    document.querySelectorAll('.feedback').forEach(feedback=>{feedback.style.display='none'});
    if (typeof res==='undefined') {
        console.log('Produk belum ada!');
        document.getElementById('valid-belum_ada').style.display = 'block';
        return true;
    } else {
        console.log('Produk sudah ada!');
        document.getElementById('invalid-sudah_ada').style.display = 'block';
        return false;
    }
}

function showHide(toshow, tohide) {
        $(`#${toshow}`).show();
        $(`#${tohide}`).hide();
    }

// document.getElementById('formAddProduk').addEventListener('submit', event=> {
//     event.preventDefault();
//     const namaProduk = document.getElementById('nama').value;
//     let result = cekProduk(namaProduk);

//     setTimeout(() => {
//         console.log(result);
//         if (result) {
//             event.target.submit();
//         }
//     }, 1000);

//     return false;
// });

// function cekProduk(nama) {
//     let result;
//     $.ajax({
//         url: `{{ route('cekProduk') }}`,
//         type: 'GET',
//         data: {nama:nama},
//         success: function (res) {
//             if (res.length===0) {
//                 console.log('Produk belum ada!');
//                 result = true;
//             } else {
//                 console.log('Produk sudah ada!');
//                 result = false;
//             }
//         }
//     });

//     // setTimeout(() => {
//     //     console.log(result);
//     //     return result;
//     // }, 300);

//     console.log(result);
//         return result;
// }

</script>

<style>

</style>
@endsection


