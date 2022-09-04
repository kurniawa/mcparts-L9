@extends('layouts.main_layout')

@section('content')

<div class="container">
    <h2>SPK Baru: Input Item</h2>
</div>

<form action="{{ route($route) }}" method="POST" id="form_spk_item" class="m-1em" name="form_spk_item" onsubmit="return formValidation();" novalidate>
    <input type="hidden" name="spk_id" value="{{ $spk_id }}">
<div class="container">
    @csrf
    <label for="nama_item" class="form-label">Nama Item:</label>
    <input id="nama_item" type="text" name="nama_lengkap" class="form-control" required>
    <input id="produk_id" type="hidden" name="produk_id">
    <div class="invalid-feedback" id="feedback-produk-id">Item harus dipilih dari daftar yang ada.</div>
    <label for="jumlah" class="form-label">Jumlah:</label>
    <div class="row">
        <div class="col-4">
            <input id="jumlah" type="number" name="jumlah" class="form-control" min="1" required>
        </div>
    </div>
    <div class="invalid-feedback" id="feedback-jumlah">Jumlah harus diisi.</div>

    <br>
    <p><span class="fw-bold">Specs:</span></p>
    <div id="spesifikasi-item" class="alert alert-primary" style="min-height: 20vh">
        <table>
            <tr id="tr-produk-id" class="item-spec"><td>ID-Produk</td><td>:</td><td id="produk-id"></td></tr>
            <tr id="tr-tipe" class="item-spec"><td>Tipe</td><td>:</td><td id="nama-tipe"></td></tr>
            <tr id="tr-bahan" class="item-spec"><td>Bahan</td><td>:</td><td id="nama-bahan"></td></tr>
            <tr id="tr-kombinasi" class="item-spec"><td>Kombinasi</td><td>:</td><td id="nama-kombinasi"></td></tr>
            <tr id="tr-tsixpack" class="item-spec"><td>T.Sixpack</td><td>:</td><td id="nama-tsixpack"></td></tr>
            <tr id="tr-grade_bahan" class="item-spec"><td>Grade Bahan</td><td>:</td><td id="nama-grade_bahan"></td></tr>
            <tr id="tr-japstyle" class="item-spec"><td>Japstyle</td><td>:</td><td id="nama-japstyle"></td></tr>
            <tr id="tr-motif" class="item-spec"><td>Motif</td><td>:</td><td id="nama-motif"></td></tr>
            <tr id="tr-standar" class="item-spec"><td>Standar</td><td>:</td><td id="nama-standar"></td></tr>
            <tr id="tr-variasi-1" class="item-spec"><td>Variasi-1</td><td>:</td><td id="nama-variasi-1"></td></tr>
            <tr id="tr-varian-1" class="item-spec"><td>Varian-1</td><td>:</td><td id="nama-varian-1"></td></tr>
            <tr id="tr-variasi-2" class="item-spec"><td>Variasi-2</td><td>:</td><td id="nama-variasi-2"></td></tr>
            <tr id="tr-varian-2" class="item-spec"><td>Varian-2</td><td>:</td><td id="nama-varian-2"></td></tr>
            <tr id="tr-ukuran" class="item-spec"><td>Ukuran</td><td>:</td><td id="nama-ukuran"></td></tr>
            <tr id="tr-busa" class="item-spec"><td>Busa</td><td>:</td><td id="nama-busa"></td></tr>
            <tr id="tr-alas" class="item-spec"><td>Alas</td><td>:</td><td id="nama-alas"></td></tr>
            <tr id="tr-sayap" class="item-spec"><td>Sayap</td><td>:</td><td id="nama-sayap"></td></tr>
            <tr id="tr-list" class="item-spec"><td>List</td><td>:</td><td id="nama-list"></td></tr>
            <tr id="tr-jahit" class="item-spec"><td>Jahit</td><td>:</td><td id="nama-jahit"></td></tr>
            <tr id="tr-tankpad" class="item-spec"><td>Tankpad</td><td>:</td><td id="nama-tankpad"></td></tr>
            <tr id="tr-stiker" class="item-spec"><td>Stiker</td><td>:</td><td id="nama-stiker"></td></tr>
            <tr id="tr-busastang" class="item-spec"><td>Busastang</td><td>:</td><td id="nama-busastang"></td></tr>
            <tr id="tr-harga-pcs" class="item-spec"><td>Harga/pcs</td><td>:</td><td id="harga-pcs"></td></tr>
            <tr id="tr-harga-t" class="item-spec"><td>Harga.t</td><td>:</td><td id="harga-t"></td></tr>
        </table>
    </div>

    <input type="hidden" name="produk-id" id="produk-id">
    <input type="hidden" name="produk-harga" id="produk-harga">

    <div class="text-center mt-3"><button type="submit" class="btn btn-warning fw-bold">Tambah Item ke SPK</button></div>

    {{-- <input id="mode" type="hidden" name="mode" value="{{ $mode }}"> --}}
    {{-- Pada mode insert baru, spk_id akan bernilai null, sedangkan pada mode inserting from detail, spk_id akan diketahui --}}
    <input id="temp_spk_id" type="hidden" name="temp_spk_id" value="{{ $temp_spk_id }}">
    <div id="container_input_hidden"></div>
</form>

<script>
    const produks = {!! json_encode($produks, JSON_HEX_TAG) !!};

    // console.log('produks');console.log(produks);
    // console.log('attsjvariasis');console.log(attsjvariasis);
    // console.log('variasi_hargas');console.log(variasi_hargas);

    $("#nama_item").autocomplete({
        source: produks,
        select: function(event, ui) {
            // console.log(ui.item);
            $(".item-spec").hide();

            showItemSpecs(ui.item);
            // apply textContent
            document.getElementById("produk-id").textContent = ui.item.id;
            $("#tr-produk-id").show();
            document.getElementById("nama-tipe").textContent = ui.item.tipe;
            $("#tr-tipe").show();

            $("#produk-id").val(ui.item.id);
            $("#produk_id").val(ui.item.id);
            $("#produk-harga").val(ui.item.harga);
            document.getElementById("harga-pcs").textContent = `Rp ${formatHarga(ui.item.harga.toString())},-`;
            document.getElementById("tr-harga-pcs").style.display = 'table-row';
        }
    });


    function showItemSpecs(chosen_item) {

        console.log(chosen_item);
        $.ajax({
            type:'GET',
            url:`/get-spesifikasi_produk?produk_id=${chosen_item.id}`,
            // url:`{{ route('getSpesifikasiProduk',['produk_id'=>1]) }}`,
            success:function (result) {
                console.log(result);
                if (result['bahan']!==null) {
                    document.getElementById("nama-bahan").textContent = result.bahan.nama;
                    document.getElementById("tr-bahan").style.display = 'table-row';
                }
                if (result['kombinasi']!==null) {
                    document.getElementById("nama-kombinasi").textContent = result.kombinasi.nama;
                    document.getElementById("tr-kombinasi").style.display = 'table-row';
                }
                if (result['tsixpack']!==null) {
                    document.getElementById("nama-tsixpack").textContent = result.tsixpack.nama;
                    document.getElementById("tr-tsixpack").style.display = 'table-row';
                }
                if (result['japstyle']!==null) {
                    document.getElementById("nama-japstyle").textContent = result.japstyle.nama;
                    document.getElementById("tr-japstyle").style.display = 'table-row';
                }
                if (result['motif']!==null) {
                    document.getElementById("nama-motif").textContent = result.motif.nama;
                    document.getElementById("tr-motif").style.display = 'table-row';
                }
                if (result['standar']!==null) {
                    document.getElementById("nama-standar").textContent = result.standar.nama;
                    document.getElementById("tr-standar").style.display = 'table-row';
                }
                if (result['tankpad']!==null) {
                    document.getElementById("nama-tankpad").textContent = result.tankpad.nama;
                    document.getElementById("tr-tankpad").style.display = 'table-row';
                }
                if (result['stiker']!==null) {
                    document.getElementById("nama-stiker").textContent = result.stiker.nama;
                    document.getElementById("tr-stiker").style.display = 'table-row';
                }
                if (result['busastang']!==null) {
                    document.getElementById("nama-busastang").textContent = result.busastang.nama;
                    document.getElementById("tr-busastang").style.display = 'table-row';
                }
                if (result['rol']!==null) {
                    document.getElementById("nama-rol").textContent = result.rol.nama;
                    document.getElementById("tr-rol").style.display = 'table-row';
                }
                if (result['rotan']!==null) {
                    document.getElementById("nama-rotan").textContent = result.rotan.nama;
                    document.getElementById("tr-rotan").style.display = 'table-row';
                }
                if (result['specs']!==null) {
                    result['specs'].forEach(spec => {
                        document.getElementById(`nama-${spec.kategori}`).textContent = spec.nama;
                        document.getElementById(`tr-${spec.kategori}`).style.display = 'table-row';
                    });
                }
                if (result['variasis']!==null) {
                    for (let i = 0; i < result['variasis'].length; i++) {
                        document.getElementById(`nama-variasi-${i+1}`).textContent = result.variasis[i].nama;
                        document.getElementById(`tr-variasi-${i+1}`).style.display = 'table-row';
                    }
                }
                if (result.varians!==null) {
                    for (let i = 0; i < result.varians.length; i++) {
                        if (result.varians[i] !== null) {
                            document.getElementById(`nama-varian-${i+1}`).textContent = result.varians[i].nama;
                            document.getElementById(`tr-varian-${i+1}`).style.display = 'table-row';
                        }
                    }
                }

            },
        });

    }

    function formValidation() {
        $produk_id = $("#produk-id");
        $jumlah = $("#jumlah");

        $("#feedback-produk-id").hide();
        $("feedback-jumlah").hide();

        if ($produk_id.val() === '' || $jumlah.val() === '') {
            if ($produk_id.val() === '') {
                $("#feedback-produk-id").show();
            }
            if ($jumlah.val() === '') {
                $("#feedback-jumlah").show();
            }
            return false;
        }
        return true;
    }
</script>

<style>
    td {
        padding-left: 1rem;
    }
    .item-spec {
        display: none;
    }
</style>
@endsection


