@extends('layouts/main_layout')

@section('content')

<div class="container">
    <h2>SPK Baru: Input Item</h2>
</div>

<form action="/spk/inserting-general-db" method="POST" id="form_spk_item" class="m-1em" name="form_spk_item">
<div class="container">
    @csrf
    <label for="nama_item" class="form-label">Nama Item:</label>
    <input id="nama_item" type="text" name="nama_lengkap" class="form-control">
    <label for="jumlah" class="form-label">Jumlah:</label>
    <div class="row">
        <div class="col-4">
            <input id="jumlah" type="number" name="jumlah" class="form-control" min="1">
        </div>
    </div>

    <br>
    <p><span class="fw-bold">Specs:</span></p>
    <div id="spesifikasi-item" class="alert alert-primary" style="min-height: 20vh">
        <table>
            <tr id="tr-id-produk" class="item-spec"><td>ID-Produk</td><td>:</td><td id="id-produk"></td></tr>
            <tr id="tr-tipe" class="item-spec"><td>Tipe</td><td>:</td><td id="nama-tipe"></td></tr>
            <tr id="tr-bahan" class="item-spec"><td>Bahan</td><td>:</td><td id="nama-bahan"></td></tr>
            <tr id="tr-kombinasi" class="item-spec"><td>Kombinasi</td><td>:</td><td id="nama-kombinasi"></td></tr>
            <tr id="tr-tsixpack" class="item-spec"><td>T.Sixpack</td><td>:</td><td id="nama-tsixpack"></td></tr>
            <tr id="tr-japstyle" class="item-spec"><td>Japstyle</td><td>:</td><td id="nama-japstyle"></td></tr>
            <tr id="tr-motif" class="item-spec"><td>Motif</td><td>:</td><td id="nama-motif"></td></tr>
            <tr id="tr-standar" class="item-spec"><td>Kombinasi</td><td>:</td><td id="nama-standar"></td></tr>
            <tr id="tr-variasi-1" class="item-spec"><td>Variasi</td><td>:</td><td id="nama-variasi-1"></td></tr>
            <tr id="tr-variasi-2" class="item-spec"><td>Variasi-2</td><td>:</td><td id="nama-variasi-2"></td></tr>
            <tr id="tr-ukuran" class="item-spec"><td>Ukuran</td><td>:</td><td id="nama-ukuran"></td></tr>
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


    <div style="height: 30vh"></div>
        {{-- <br><br>


        <div id="divAvailableOptions" class="position-fixed bottom-5em w-calc-100-1em">
            Available options:
            <div id="container_options">
                {!! $available_options !!}
            </div>

        </div> --}}



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
    // const bahans = {-!! json_encode($bahans, JSON_HEX_TAG) !!};
    // const attsjvariasis = {-!! json_encode($attsjvariasis, JSON_HEX_TAG) !!};
    // const varians = {-!! json_encode($varians, JSON_HEX_TAG) !!};
    // const variasi_hargas = {-!! json_encode($variasi_hargas, JSON_HEX_TAG) !!};
    // const specs = {-!! json_encode($specs, JSON_HEX_TAG) !!};
    // const kombinasis = {-!! json_encode($kombinasis, JSON_HEX_TAG) !!};
    // const tsixpacks = {-!! json_encode($tsixpacks, JSON_HEX_TAG) !!};
    // const japstyles = {-!! json_encode($japstyles, JSON_HEX_TAG) !!};
    // const motifs = {-!! json_encode($motifs, JSON_HEX_TAG) !!};
    // const standars = {-!! json_encode($standars, JSON_HEX_TAG) !!};
    // const tankpads = {-!! json_encode($tankpads, JSON_HEX_TAG) !!};
    // const stikers = {-!! json_encode($stikers, JSON_HEX_TAG) !!};
    // const busastangs = {-!! json_encode($busastangs, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log('produks');console.log(produks);
    }
    // console.log('attsjvariasis');console.log(attsjvariasis);
    // console.log('variasi_hargas');console.log(variasi_hargas);

    $("#nama_item").autocomplete({
        source: produks,
        select: function(event, ui) {
            // console.log(ui.item);
            $(".item-spec").hide();

            // const [nama_bahan, display_tr_bahan, nama_variasi_1, display_tr_variasi_1, nama_variasi_2, display_tr_variasi_2,
            // nama_ukuran, display_tr_ukuran, nama_jahit, display_tr_jahit, nama_kombinasi, display_tr_kombinasi, nama_tsixpack, display_tr_tsixpack,
            // nama_japstyle, display_tr_japstyle, tipe_bahan, display_tr_tipe_bahan, nama_motif, display_tr_motif, nama_standar, display_tr_standar,
            // nama_tankpad, display_tr_tankpad, nama_stiker, display_tr_stiker, nama_busastang, display_tr_busastang] = getItemSpecs(ui.item);

            showItemSpecs(ui.item);

            // apply textContent
            document.getElementById("id-produk").textContent = ui.item.id;
            $("#tr-id-produk").show();
            document.getElementById("nama-tipe").textContent = ui.item.tipe;
            $("#tr-tipe").show();
            // document.getElementById("nama-bahan").textContent = nama_bahan;
            // document.getElementById("tr-bahan").style.display = display_tr_bahan;
            // document.getElementById("nama-variasi-1").textContent = nama_variasi_1;
            // document.getElementById("tr-variasi-1").style.display = display_tr_variasi_1;
            // document.getElementById("nama-variasi-2").textContent = nama_variasi_2;
            // document.getElementById("tr-variasi-2").style.display = display_tr_variasi_2;

            // document.getElementById("nama-jahit").textContent = nama_jahit;
            // document.getElementById("tr-jahit").style.display = display_tr_jahit;
            // document.getElementById("nama-kombinasi").textContent = nama_kombinasi;
            // document.getElementById("tr-kombinasi").style.display = display_tr_kombinasi;
            // document.getElementById("nama-tsixpack").textContent = nama_tsixpack;
            // document.getElementById("tr-tsixpack").style.display = display_tr_tsixpack;
            // document.getElementById("nama-japtyle").textContent = nama_japtyle;
            // document.getElementById("tr-japtyle").style.display = display_tr_japtyle;

            // document.getElementById("nama-standar").textContent = nama_standar;
            // document.getElementById("tr-standar").style.display = display_tr_standar;
            // document.getElementById("nama-tankpad").textContent = nama_tankpad;
            // document.getElementById("tr-tankpad").style.display = display_tr_tankpad;
            // document.getElementById("nama-stiker").textContent = nama_stiker;
            // document.getElementById("tr-stiker").style.display = display_tr_stiker;
            // document.getElementById("nama-busastang").textContent = nama_busastang;
            // document.getElementById("tr-busastang").style.display = display_tr_busastang;

            $("#produk-id").val(ui.item.id);
            $("#produk-harga").val(ui.item.harga);
            document.getElementById("harga-pcs").textContent = `Rp ${formatHarga(ui.item.harga.toString())},-`;
            document.getElementById("tr-harga-pcs").style.display = 'table-row';
        }
    });

    function showItemSpecs(chosen_item) {
        // let display_tr_bahan, display_tr_variasi_1, display_tr_variasi_2, display_tr_ukuran, display_tr_jahit, display_tr_kombinasi,
        // display_tr_tsixpack, display_tr_japstyle, display_tr_motif, display_tr_standar, display_tr_tankpad,
        // display_tr_stiker = 'none';
        // let nama_bahan, nama_variasi_1, nama_variasi_2, nama_ukuran, nama_jahit = '-';

        if (chosen_item.tipe === 'SJ-Variasi') {
            $.ajax({
                type: 'GET',
                url: `/bahan-from-produk-id?produk_id=${chosen_item.id}`,
                success: function (data) {
                    console.log(data);
                    document.getElementById("nama-bahan").textContent = data[0].nama;
                    document.getElementById("tr-bahan").style.display = 'table-row';
                }
            });
            // // tipe
            // // bahan
            // let bahan = bahans.find(x=>x.id === chosen_item.bahan_id);
            // nama_bahan = bahan.label;
            // display_tr_bahan = 'table-row';
            // console.log('bahan: ', bahan);
            // // variasi
            // // variasi-1
            // let attsjvariasi_1 = attsjvariasis.find(x => x.produk_id === chosen_item.id);
            // let variasi_1 = variasi_hargas.find(x => x.id === attsjvariasi_1.variasi_id);
            // nama_variasi_1 = variasi_1.nama;
            // display_tr_variasi_1 = 'table-row';
            // //variasi-2
            // let attsjvariasi_2 = null;
            // let idx_2 = attsjvariasi_1.id;

            // console.log(attsjvariasi_1);
            // console.log(attsjvariasi_1.id);
            // console.log(idx_2);
            // console.log(`produk_id urutan ke-${idx_2}`);console.log(attsjvariasis[idx_2].produk_id);
            // console.log('produk_id yang dicari');console.log(attsjvariasi_1.produk_id);
            // if (attsjvariasis[idx_2].produk_id === attsjvariasi_1.produk_id) {
            //     attsjvariasi_2 = attsjvariasis[idx_2];
            //     let variasi_2 = variasi_hargas.find(x => x.id === attsjvariasi_2.variasi_id);
            //     nama_variasi_2 = variasi_2.nama;
            //     display_tr_variasi_2 = 'table-row';
            // }
            // console.log(attsjvariasi_2);

            // // ukuran
            // let ukuran = null;
            // if (chosen_item.ukuran_id !== null) {
            //     ukuran = ukurans.find(x => x.id === chosen_item.ukuran_id);
            //     nama_ukuran = ukuran.nama;
            //     display_tr_ukuran = 'table-row';
            // }

            // // jahit
            // let jahit = null;
            // if (chosen_item.jahit_id !== null) {
            //     jahit = jahits.find(x => x.id === chosen_item.jahit_id);
            //     nama_jahit = jahit.nama;
            //     display_tr_jahit = 'table-row';
            // }
        } else if (chosen_item.tipe === 'SJ-Motif') {
            $.ajax({
                type: 'GET',
                url: `/get-motif-from-produk-id?produk_id=${chosen_item.id}`,
                success: function (data) {
                    document.getElementById("nama-motif").textContent = data[0].nama;
                    document.getElementById("tr-motif").style.display = 'table-row';
                }
            });
            $.ajax({
                type: 'GET',
                url: `/get-specs-from-produk-id?produk_id=${chosen_item.id}`,
                success: function (data) {
                    showJahitUkuranBusaTipeBahan(data);
                }
            });
        }

        // return [nama_bahan, display_tr_bahan, nama_variasi_1, display_tr_variasi_1, nama_variasi_2, display_tr_variasi_2,
        // nama_ukuran, display_tr_ukuran, nama_jahit, display_tr_jahit, nama_kombinasi, display_tr_kombinasi, nama_tsixpack, display_tr_tsixpack,
        // nama_japstyle, display_tr_japstyle, tipe_bahan, display_tr_tipe_bahan, nama_motif, display_tr_motif, nama_standar, display_tr_standar,
        // nama_tankpad, display_tr_tankpad, nama_stiker, display_tr_stiker, nama_busastang, display_tr_busastang];
    }

    function showJahitUkuranBusaTipeBahan(specs) {
        specs.forEach(spec => {
            document.getElementById(`nama-${spec.kategori}`).textContent = spec.nama;
            document.getElementById(`tr-${spec.kategori}`).style.display = 'table-row';
        });
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


