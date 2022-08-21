@extends('layouts.main_layout')

@extends('layouts.navbar')

@section('content')

<div class="container">
    <h2>Produk Baru</h2>
    <h6>Tipe: {{ $tipe }}</h6>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-2">
            <div class="col" id="div-bahan" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" id="btn-close-bahan" onclick="showHide('btn-bahan', 'div-bahan')" style="display: none">X</button>
                <div class="form-floating">
                    <input type="text" name="bahan" id="bahan" placeholder="Bahan" class="form-control">
                    <label for="bahan">Bahan</label>
                </div>
            </div>
            <div class="col"></div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-kombinasi" style="display: none">
                <div class="form-floating">
                    <input type="text" id="kombi" name="kombi" class="form-control" style="border-radius:5px;" placeholder="Kombinasi">
                    <label for="kombi">Kombinasi</label>
                </div>
                <input type="hidden" id="kombi_id" name="kombi_id">
                <input type="hidden" id="kombi_harga" name="kombi_harga">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-motif" style="display: none">
                <div class="form-floating">
                    <input type="text" id="motif" name="motif" class="form-control" style="border-radius:5px;" placeholder="Motif">
                    <label for="motif">Motif</label>
                </div>
                <input type="hidden" id="motif_id" name="motif_id">
                <input type="hidden" id="motif_harga" name="motif_harga">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-standar" style="display: none">
                <div class="form-floating">
                    <input type="text" id="standar" name="standar" class="form-control" style="border-radius:5px;" placeholder="Standar">
                    <label for="standar">Standar</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-jokassy" style="display: none">
                <div class="form-floating">
                    <input type="text" id="jokassy" name="jokassy" class="form-control" style="border-radius:5px;" placeholder="Jok Assy">
                    <label for="jokassy">Jok Assy</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-tankpad" style="display: none">
                <div class="form-floating">
                    <input type="text" id="tankpad" name="tankpad" class="form-control" style="border-radius:5px;" placeholder="Tankpad">
                    <label for="tankpad">Tankpad</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-stiker" style="display: none">
                <div class="form-floating">
                    <input type="text" id="stiker" name="stiker" class="form-control" style="border-radius:5px;" placeholder="Stiker">
                    <label for="stiker">Stiker</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-busastang" style="display: none">
                <div class="form-floating">
                    <input type="text" id="busastang" name="busastang" class="form-control" style="border-radius:5px;" placeholder="Busa Stang">
                    <label for="busastang">Busa Stang</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-rotan" style="display: none">
                <div class="form-floating">
                    <input type="text" id="rotan" name="rotan" class="form-control" style="border-radius:5px;" placeholder="Rotan">
                    <label for="rotan">Rotan</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-rol" style="display: none">
                <div class="form-floating">
                    <input type="text" id="rol" name="rol" class="form-control" style="border-radius:5px;" placeholder="Rol">
                    <label for="rol">Rol</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-grade_bahan" style="display: none">
                <label for="grade_bahan">Grade Bahan:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-grade_bahan', 'div-grade_bahan')">X</button>
                <select name="grade_bahan" id="grade_bahan" class="form-control">
                    <option value="A">A</option>
                    <option value="B">B</option>
                </select>
            </div>
            <div class="col" id="div-alas" style="display: none">
                <label for="alas">Alas:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-alas', 'div-alas')">X</button>
                <select name="alas" id="alas" class="form-control">
                    <option value="Alas">Alas</option>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-variasi1" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" style="display: none" id="btn-close-variasi1" onclick="showHide('btn-variasi1', 'div-variasi1')">X</button>
                {{-- <div class="form-floating">
                    <input type="text" name="variasi_1" id="variasi_1" placeholder="Variasi 1" class="form-control">
                    <label for="variasi_1">Variasi 1</label>
                </div> --}}
                <label for="variasi_1">Variasi 1:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" style="display: none" id="btn-close-variasi1" onclick="showHide('btn-variasi1', 'div-variasi1')">X</button>
                <select name="variasi_1" id="variasi_1" class="form-control">
                    @foreach ($variasis as $variasi)
                    <option value="{{ $variasi['nama'] }}">{{ $variasi['nama'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" id="div-varian1" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" id="btn-close-varian1" onclick="showHide('btn-varian1', 'div-varian1')">X</button>
                <div class="form-floating">
                    <input type="text" name="varian_1" id="varian_1" placeholder="Varian 1" class="form-control">
                    <label for="varian_1">Varian 1</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-variasi2" style="display: none">
                {{-- <div class="form-floating">
                    <input type="text" name="variasi_2" id="variasi_2" placeholder="Variasi 2" class="form-control">
                    <label for="variasi_2">Variasi 2</label>
                </div> --}}
                <label for="variasi_2">Variasi 2:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-variasi2', 'div-variasi2')">X</button>
                <select name="variasi_2" id="variasi_2" class="form-control">
                    @foreach ($variasis as $variasi)
                    <option value="{{ $variasi['nama'] }}">{{ $variasi['nama'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col" id="div-varian2" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-varian2', 'div-varian2')">X</button>
                <div class="form-floating">
                    <input type="text" name="varian_2" id="varian_2" placeholder="Varian 2" class="form-control">
                    <label for="varian_2">Varian 2</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-ukuran" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-ukuran', 'div-ukuran')">X</button>
                <div class="form-floating">
                    <input type="text" name="ukuran" id="ukuran" placeholder="Ukuran" class="form-control">
                    <label for="ukuran">Ukuran</label>
                </div>
            </div>
            <div class="col" id="div-jahit" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-jahit', 'div-jahit')">X</button>
                <div class="form-floating">
                    <input type="text" name="jahit" id="jahit" placeholder="Jahit" class="form-control">
                    <label for="jahit">Jahit</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-busa" style="display: none">
                <label for="busa">Busa</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-busa', 'div-busa')">X</button>
                <input name="busa" id="busa" class="form-control">
            </div>
            <div class="col" id="div-sayap" style="display: none">
                <label for="sayap">Sayap:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-sayap', 'div-sayap')">X</button>
                <input name="sayap" id="sayap" class="form-control">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-list" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-list', 'div-list')">X</button>
                <div class="form-floating">
                    <input type="text" name="list" id="list" class="form-control" pattern="List">
                    <label for="list">List</label>
                </div>
            </div>
            <div class="col" id="div-alas" style="display: none">
                <label for="alas">Alas:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-alas', 'div-alas')">X</button>
                <input name="alas" id="alas" class="form-control">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-tipe_packing" style="display: none">
                <label for="tipe_packing">Tipe Packing:</label>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-tipe_packing', 'div-tipe_packing')">X</button>
                <select name="tipe_packing" id="tipe_packing" class="form-select">
                    <option value="colly">colly</option>
                    <option value="dus">dus</option>
                </select>
            </div>
            <div class="col" id="div-aturan_packing" style="display: none">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-aturan_packing', 'div-aturan_packing')">X</button>
                <div class="form-floating">
                    <input type="number" name="aturan_packing" id="aturan_packing" value="150" class="form-control">
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
                <div class="form-floating">
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
                    <label for="nama">Nama</label>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col" id="div-nama_nota">
                <div class="form-floating">
                    <input type="text" name="nama_nota" id="nama_nota" class="form-control" placeholder="Nama Nota">
                    <label for="nama_nota">Nama Nota</label>
                </div>
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

        <div>
            Opsi:<br>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-bahan" onclick="showHide('div-bahan', this.id)">+Bahan</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-ukuran" onclick="showHide('div-ukuran', this.id)">+Ukuran</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-jahit" onclick="showHide('div-jahit', this.id)">+Jahit</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-grade_bahan" onclick="showHide('div-grade_bahan', this.id)">+Grade Bahan</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-variasi1" onclick="showHide('div-variasi1', this.id)">+Variasi-1</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-varian1" onclick="showHide('div-varian1', this.id)">+Varian-1</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-variasi2" onclick="showHide('div-variasi2', this.id)">+Variasi-2</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-varian2" onclick="showHide('div-varian2', this.id)">+Varian-2</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-alas" onclick="showHide('div-alas', this.id)">+Alas</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-busa" onclick="showHide('div-busa', this.id)">+Busa</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-sayap" onclick="showHide('div-sayap', this.id)">+Sayap</button>
            <button type="button" class="btn btn-outline-primary btn-sm" style="display: none" id="btn-list" onclick="showHide('div-list', this.id)">+List</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-keterangan" onclick="showHide('div-keterangan', this.id)">+Keterangan</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-tipe_packing" onclick="showHide('div-tipe_packing', this.id)">+TipePacking</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-aturan_packing" onclick="showHide('div-aturan_packing', this.id)">+AturanPacking</button>
        </div>

        <br><br>
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="col btn-warning">Tambah {{ $tipe }}</button>
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
const sayaps = {!! json_encode($sayaps, JSON_HEX_TAG) !!};
const lists = {!! json_encode($lists, JSON_HEX_TAG) !!};

console.log('ukurans',ukurans);

var attToShow = new Array();
var btnToShow = new Array();

if (tipe === 'SJ-Variasi') {
    attToShow=['div-bahan','div-variasi1'];
    btnToShow=['btn-varian1','btn-ukuran','btn-jahit','btn-variasi2','btn-varian2'];
}

if (tipe === 'SJ-Kombinasi') {
    attToShow=['div-kombinasi'];
    btnToShow=['btn-variasi1','btn-close-variasi1','btn-varian1','btn-grade_bahan','btn-bahan','btn-close-bahan','btn-ukuran','btn-jahit','btn-list'];
}

if (tipe === 'SJ-Motif') {
    attToShow=['div-motif'];
    btnToShow=['btn-grade_bahan','btn-bahan','btn-close-bahan','btn-ukuran','btn-jahit'];
}

if (tipe === 'SJ-T.Sixpack') {
    attToShow=['div-bahan'];
    btnToShow=['btn-grade_bahan','btn-ukuran','btn-jahit','btn-alas','btn-busa'];
}

if (tipe === 'SJ-Japstyle') {
    attToShow=['div-bahan'];
}

if (tipe === 'SJ-Standar') {
    attToShow=['div-standar'];
    btnToShow=['btn-grade_bahan','btn-bahan','btn-close-bahan','btn-alas','btn-sayap','btn-busa'];
}

if (tipe === 'Jok Assy') {
    attToShow=['div-jokassy'];
}

if (tipe === 'Tankpad') {
    attToShow=['div-tankpad'];
}

if (tipe === 'Stiker') {
    attToShow=['div-stiker'];
}

if (tipe === 'Busa-Stang') {
    attToShow=['div-busastang'];
}

if (tipe === 'Rotan') {
    attToShow=['div-rotan'];
}

if (tipe === 'Rol') {
    attToShow=['div-rol'];
}

toShow(attToShow);toShow(btnToShow);

function toShow(params) {
    params.forEach(param => {
        console.log(param);
        document.getElementById(param).style.removeProperty('display');
    });
}

$('#bahan').autocomplete({source:bahans,});
$('#varian_1').autocomplete({source:varians,});
$('#varian_2').autocomplete({source:varians,});
$('#ukuran').autocomplete({source:ukurans,});
$('#jahit').autocomplete({source:jahits,});
$('#alas').autocomplete({source:alass,});
$('#busa').autocomplete({source:busas,});
$('#sayap').autocomplete({source:sayaps,});
$('#list').autocomplete({source:lists,});

</script>

<style>

</style>
@endsection


