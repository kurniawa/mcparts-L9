@extends('layouts/main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div>
        <h2 style="color: white">Pelanggan: Edit Info Pelanggan</h2>
    </div>
</header>

<form action="/pelanggan/pelanggan-edit-db" method="POST">
    @csrf
    <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
    <div class="ml-1em mr-1em mt-2em">
        <label for="nama" style="font-weight: bold">Nama:</label>
        <input name="nama_pelanggan" id="nama" class="form-control @error('nama_pelanggan') is-invalid @enderror" type="text" placeholder="Nama/Perusahaan/Pabrik" value="{{ $pelanggan['nama'] }}">
        @error('nama_pelanggan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <label style="font-weight:bold">Alamat:</label>
        <div id="div_alamat_cust"></div>
        <div id="btn_tbh_baris" class="btn btn-secondary">+ Tambah Baris Alamat</div>
        <br><br>

        <label for="ipt_negara" style="font-weight: bold">Negara:</label>
        <input id="ipt_negara" type="text" name="negara" class="form-control" placeholder="Negara">
        <input id="ipt_negara_id" type="hidden" name="negara_id">

        <div class="grid-2-auto grid-column-gap-1em mt-1em">
            <div>
                <label for="pulau" style="font-weight: bold">Pulau:</label>
                <input name="pulau" id="pulau" class="form-control @error('pulau') is-invalid @enderror" type="text" placeholder="Pulau">
                <input type="hidden" id="pulau_id" name="pulau_id">
                @error('pulau')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="daerah" style="font-weight: bold">Daerah:</label>
                <input name="daerah" id="daerah" class="form-control @error('daerah') is-invalid @enderror" type="text" placeholder="Daerah">
                <input type="hidden" id="daerah_id" name="daerah_id">
                @error('daerah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="grid-2-auto grid-column-gap-1em mt-1em">
            <div>
                <label for="kontak" style="font-weight: bold">No. Kontak:</label>
                <input name="kontak_pelanggan" id="kontak" class="input-1 pb-1em" type="text" placeholder="No. Kontak">
            </div>
            <div>
                <label for="singkatan" style="font-weight: bold">Initial/Singkatan:</label>
                <input name="singkatan_pelanggan" id="singkatan" class="input-1 pb-1em" type="text" placeholder="Singkatan (opsional)">
            </div>
        </div>

        <br>
        <label for="keterangan" style="font-weight:bold">Keterangan lain:</label>
        <textarea id="keterangan" class="mt-1em pt-1em pl-1em text-area-mode-1" name="keterangan" placeholder="Keterangan lain (opsional)"></textarea>
        <br>
        <br>
        <h6>Apakah Pelanggan ini akan ditetapkan sebagai Reseller juga?</h6>
        <input type="radio" name="is_reseller" id="is_reseller_no" value="tidak" checked> <label for="is_reseller_no">TIDAK</label>
        <br>
        <input type="radio" name="is_reseller" id="is_reseller_yes" value="yes"> <label for="is_reseller_yes">YA</label>
    </div>

    <br><br>

    <div class="m-1em">
        <button type="submit" class="h-4em bg-color-orange-2 w-100 grid-1-auto">
            <span class="justify-self-center font-weight-bold">Konfirmasi Perubahan</span>
        </button>
    </div>
</form>

<script>
    const pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
    const negara = {!! json_encode($negara, JSON_HEX_TAG) !!};
    const pulau = {!! json_encode($pulau, JSON_HEX_TAG) !!};
    const daerah = {!! json_encode($daerah, JSON_HEX_TAG) !!};
    const label_negaras = {!! json_encode($label_negaras, JSON_HEX_TAG) !!};
    const label_pulaus = {!! json_encode($label_pulaus, JSON_HEX_TAG) !!};
    const arr_label_daerahs = {!! json_encode($arr_label_daerahs, JSON_HEX_TAG) !!};

    var iLabelDaerahs = 0;

    if (show_console) {
        console.log('pelanggan');console.log(pelanggan);
        console.log('negara');console.log(negara);
        console.log('pulau');console.log(pulau);
        console.log('daerah');console.log(daerah);
        console.log('label_pulaus');console.log(label_pulaus);
        console.log('arr_label_daerahs');console.log(arr_label_daerahs);
    }

    /* NEGARA, PULAU, DAERAH */

    $ipt_negara = $('#ipt_negara');
    $ipt_negara_id = $('#ipt_negara_id');
    var ipt_pulau = document.getElementById('pulau');
    var ipt_pulau_id = document.getElementById('pulau_id');
    var ipt_daerah = document.getElementById('daerah');
    var ipt_daerah_id = document.getElementById('daerah_id');

    $ipt_negara.val(negara.nama);
    $ipt_negara_id.val(negara.id);

    $ipt_negara.autocomplete({
        source: label_negaras,
        select: function(event, ui) {
            $ipt_negara_id.val(ui.item.id);
            ubahNegara(ui.item.id);
        }
    });

    ubahNegara(parseInt($ipt_negara_id.val())); // Settingan awal page behavior untuk pulau dan daerah

    if (pulau !== null) {
        ipt_pulau.value = pulau.nama;
        ipt_pulau_id.value = pulau.id;
        iLabelDaerahs = pulau.id-1;

        if (show_console) {
            console.log(`arr_label_daerahs[${iLabelDaerahs}]`);console.log(arr_label_daerahs[iLabelDaerahs]);
        }

        $('#daerah').autocomplete({
            source: arr_label_daerahs[iLabelDaerahs],
            select: function(event, ui) {
                if (show_console) {
                    console.log(ui.item);
                }
                $('#daerah_id').val(ui.item.id);
            }
        });
    }

    if (daerah !== null) {
        ipt_daerah.value = daerah.nama;
        ipt_daerah_id.value = daerah.id;
    }

    $("#pulau").autocomplete({
        source: label_pulaus,
        select: function(event, ui) {
            if (show_console) {
                console.log(ui.item);
            }
            $("#pulau_id").val(ui.item.id);
            autcompleteIptDaerah();
        }
    });

    function autcompleteIptDaerah() {
        iLabelDaerahs = $('#pulau_id').val()-1;
        if (show_console) {
            console.log('iLabelDaerahs:');console.log(iLabelDaerahs);
        }
        $('#daerah').autocomplete({
            source: arr_label_daerahs[iLabelDaerahs],
            select: function(event, ui) {
                if (show_console) {
                    console.log(ui.item);
                }
                $('#daerah_id').val(ui.item.id);
            }
        });
    }

    function ubahNegara(idNegaraTerpilih) {
        // if (show_console) {
        //     console.log('idNegaraTerpilih');console.log(idNegaraTerpilih);
        // }
        if (idNegaraTerpilih !== 1) {
            ipt_pulau.value = '-';
            ipt_pulau.readOnly = true;
            ipt_pulau_id.value = null;
            /*
            Fungsi ini belum selesai karena belum ada tindakan untuk daerah nya harus
            jadi gimana, ketika negara diubah.
            */
           return;
        }
        ipt_pulau.readOnly = false;
        ipt_pulau.value = pulau.nama;
        ipt_pulau_id.value = pulau.id;
    }

    /* ALAMAT */

    var htmlAlamatEks = '';
    var i_arrAlamatEks = 1;
    const arr_alamat_cust = JSON.parse(pelanggan.alamat);

    if (show_console === true) {
        console.log('arr_alamat_cust');
        console.log(arr_alamat_cust);
    }

    arr_alamat_cust.forEach(alamat_eks => {
        htmlAlamatEks += `<label>Baris ${i_arrAlamatEks}:<br></label><input class="form-control" type="text" name='alamat_pelanggan[]' value="${alamat_eks}">`;
        i_arrAlamatEks++;
    });

    document.getElementById('div_alamat_cust').innerHTML = htmlAlamatEks;

    document.getElementById('btn_tbh_baris').addEventListener('click', function () {
        var label_tbh_baris = document.createElement('label');
        label_tbh_baris.textContent = `Baris ${i_arrAlamatEks}:`;
        var ipt_tbh_baris = document.createElement('input');
        ipt_tbh_baris.name = "alamat_pelanggan[]";
        ipt_tbh_baris.className = "form-control";
        ipt_tbh_baris.type = "text";
        document.getElementById('div_alamat_cust').appendChild(label_tbh_baris);
        document.getElementById('div_alamat_cust').appendChild(ipt_tbh_baris);
        i_arrAlamatEks++;
    });

    /* NO KONTAK & SINGKATAN & KETERANGAN LAIN */
    if (pelanggan.no_kontak !== null) {
        document.getElementById('kontak').value = pelanggan.no_kontak;
    }
    if (pelanggan.initial !== null) {
        document.getElementById('singkatan').value = pelanggan.initial;
    }
    if (pelanggan.ktrg !== null) {
        document.getElementById('keterangan').value = pelanggan.ktrg;
    }
</script>

<style>
    #divToggleReseller {
        height: 1.5em;
    }

    .btn-atas-kanan {
        display: inline;
        border-radius: 25px;
        background-color: #FFED50;
        padding: 0.5em 1em 0.5em 1em;
        position: absolute;
        top: 1em;
        right: 0.5em;
    }

    .div-filter-icon {
        justify-self: end;
    }

    .icon-small-circle {
        border-radius: 100%;
        width: 2.5em;
        height: 2.5em;
        position: relative;
    }

    .circle-medium {
        border-radius: 100%;
        width: 2.5em;
        height: 2.5em;
    }

    .icon-img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .div-cari-filter {
        border-bottom: 0.5px solid #E4E4E4;
    }

</style>
@endsection
