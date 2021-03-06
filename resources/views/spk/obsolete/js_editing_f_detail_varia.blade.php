<script>
    const mode = {!! json_encode($mode, JSON_HEX_TAG) !!};
    const tipe = {!! json_encode($tipe, JSON_HEX_TAG) !!};
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

    var props_alternate_ukuran = {
        btn_hide: "close_ukuran",
        btn_show: "box_ukuran",
        id: "div_select_ukuran",
        type: "select",
        opt_to_reset: "sel_ukuran",
    };
    props_alternate_ukuran = JSON.stringify(props_alternate_ukuran);

    var props_alternate_jht = {
        btn_hide: "close_jht",
        btn_show: "box_jht",
        id: "div_select_jht",
        type: "select",
        opt_to_reset: "sel_jahit",
    };
    props_alternate_jht = JSON.stringify(props_alternate_jht);

    /*
    Fungsi alternate_show() nya saya taro di inserting_spk_item-2.blade.php
    */

    const box_ukuran = `<div id="box_ukuran" class="box" onclick='alternate_show(this.id, ${props_alternate_ukuran});'>+ Ukuran</div>`;
    const box_jht = `<div id="box_jht" class="box" onclick='alternate_show(this.id, ${props_alternate_jht});'>+ Jahit</div>`;

    const pilih_bahan = `
        <div>Pilih Bahan:</div>
        <input type="text" id="bahan" name="bahan" class="input-normal" style="border-radius:5px;">
        <input type="hidden" id="bahan_id" name="bahan_id">
        <input type="hidden" id="bahan_harga" name="bahan_harga">
    `;


    document.getElementById('container_property_spk_item').innerHTML = `
        <div id='div_pilih_bahan'></div>
        <div id='div_pilih_variasi'></div><br>
        <div id='div_select_ukuran'></div><br>
        <div id='div_select_jht'></div><br>
    `;

    document.getElementById("div_pilih_bahan").innerHTML = pilih_bahan;

    document.getElementById('container_options').innerHTML = `
        <div style='display:inline-block;' id='div_box_jml'></div>
        <div style='display:inline-block;' id='div_box_ukuran'></div>
        <div style='display:inline-block;' id='div_box_jht'></div>
        <div style='display:inline-block;' id='div_box_ktrg'></div>
    `;

    var pilih_variasi = `
    <div class="mt-1em">Pilih Variasi:</div>
    <select id="variasi" name="variasi" class="p-0_5em" style="border-radius:5px;">
    `;

    var select_ukuran =
        `<div id="select_ukuran">
            Pilih Ukuran:
            <div class="grid-2-auto_10">
                <select id="sel_ukuran" name="ukuran" style="border-radius:5px;padding:0.5em;">
                    <option value="" disabled selected>Pilih Jenis Ukuran</option>`;

    var select_jht =
        `<div id="select_jht">
            Tambah Jahit Kepala:
            <div class="grid-2-auto_10">
                <select id="sel_jahit" name="jahit" style="border-radius:5px;padding:0.5em;">
                    <option value="" disabled selected>Pilih Jenis Jahit</option>`;

    /*
    Ketiga elemen diatas masih belum selesai, karena masih harus dicek terlebih dahulu, apakah
    laman ini berkenaan dengan SPK_BARU atau edit.
    */

    /*
    Untuk Varia di tentukan agak beda metode nya, karena select option value nya dari elemen2 di hlmn
    ini banyak yang berupa json. Jadi dipilih metode looping dibandingkan harus cari value dan index
    dari option2 yang ada.
    */

    /*
    Disini ada sebagian elemen yang ditentukan terlebih dahulu innerHTML nya, dikarena ketika selection
    nanti ternyata dibutuhkan beberapa elemen yang sudah ready.
    */
    document.getElementById("div_box_jml").innerHTML = box_jml;
    document.getElementById("div_input_jml").innerHTML = input_jml;
    document.getElementById("div_box_ktrg").innerHTML = box_ktrg;
    document.getElementById("div_ta_ktrg").innerHTML = ta_ktrg;


    if (mode === 'SPK_BARU' || mode === 'INSERTING VARIA FROM DETAIL') {

        /*
        Dibawah ini ada beberapa elemen yang saya set sebagai hidden, karena saya pikir pada saat
        spk baru->variasi, maka tampilan nya minimalis terlebih dahulu. Saya pake fungsi hide dari
        jquery untuk mensinkronkan kan show nya yang juga menggunakan jquery. Jadi serasa lebih rapi
        aja.
        */

        $('#div_pilih_variasi').hide();
        $('#div_select_ukuran').hide();
        $('#div_select_jht').hide();


        varias.forEach(varia => {
            var value = {
                id: varia.id,
                nama: varia.nama,
                harga: varia.harga
            };
            value = JSON.stringify(value);

            pilih_variasi += `
            <option value='${value}'>${varia.nama}</option>
            `;

        });

        if (typeof ukurans !== "undefined") {
            ukurans.forEach(uk => {
                var value = {
                    id: uk.id,
                    nama: uk.nama,
                    nama_nota: uk.nama_nota,
                    harga: uk.harga
                };
                value = JSON.stringify(value);

                select_ukuran += `
                    <option value='${value}'>${uk.nama}</option>
                `;
            });
        }

        if (typeof jahits !== "undefined") {
            jahits.forEach(jht => {
                var value = {
                    id: jht.id,
                    nama: jht.nama,
                    harga: jht.harga
                };
                value = JSON.stringify(value);

                select_jht += `
                    <option value='${value}'>${jht.nama}</option>
                `;

            });
        }

        document.getElementById('judul').innerHTML = `<h2>SPK Baru - SJ Varia</h2>`;

    } else if(mode === 'edit') {
        const spk_item = {!! json_encode($spk_item, JSON_HEX_TAG) !!};
        console.log('spk_item');
        console.log(spk_item);

        const produk = {!! json_encode($produk, JSON_HEX_TAG) !!};
        console.log(produk);
        const produk_props = JSON.parse(produk.properties);
        console.log(produk_props);
        document.getElementById('judul').innerHTML = `<h2>Edit SPK Item - SJ Varia</h2>`;

        /* METHODE UNTUK MENENTUKAN SELECT OPTION VARIASI */

        // var options_variasi = document.querySelectorAll('#variasi option');
        // console.log(options_variasi);
        // console.log(options_variasi[0].value);

        varias.forEach(varia => {
            var value = {
                id: varia.id,
                nama: varia.nama,
                harga: varia.harga
            };
            value = JSON.stringify(value);
            // console.log('perbandingan:');
            // console.log(varia.id);
            // console.log(produk_props.variasi_id);
            if (varia.id === produk_props.variasi_id) {
                pilih_variasi += `
                    <option value='${value}' selected>${varia.nama}</option>
                `;
            } else {
                pilih_variasi += `
                <option value='${value}'>${varia.nama}</option>
                `;
            }

        });

        /* METHODE UNTUK MENENTUKAN SELECT OPTION UKURAN */

        if (typeof ukurans !== "undefined") {
            ukurans.forEach(uk => {
                var value = {
                    id: uk.id,
                    nama: uk.nama,
                    nama_nota: uk.nama_nota,
                    harga: uk.harga
                };
                value = JSON.stringify(value);

                if (uk.id === produk_props.ukuran_id) {
                    select_ukuran += `
                        <option value='${value}' selected>${uk.nama}</option>
                    `;
                } else {
                    select_ukuran += `
                        <option value='${value}'>${uk.nama}</option>
                    `;
                }

            });
        }

        /* METHODE UNTUK MENENTUKAN JAHIT */

        if (typeof jahits !== "undefined") {
            jahits.forEach(jht => {
                var value = {
                    id: jht.id,
                    nama: jht.nama,
                    harga: jht.harga
                };
                value = JSON.stringify(value);
                if (jht.id === produk_props.jahit_id) {
                    select_jht += `
                        <option value='${value}' selected>${jht.nama}</option>
                    `;
                } else {
                    select_jht += `
                        <option value='${value}'>${jht.nama}</option>
                    `;
                }
            });
        }

        var bahan = document.getElementById('bahan');
        var bahan_id = document.getElementById('bahan_id');
        var bahan_harga = document.getElementById('bahan_harga');

        /* METHODE UNTUK MENGISI INPUT BAHAN */
        for (let i = 0; i < bahans.length; i++) {
            if (bahans[i].id === produk_props.bahan_id) {
                bahan.value = bahans[i].value;
                bahan_id.value = bahans[i].id;
                bahan_harga.value = bahans[i].harga;
            }
        }

        var jumlah = document.getElementById('jumlah');
        var ktrg = document.getElementById('ktrg');
        jumlah.value = spk_item.jumlah;
        if (typeof spk_item.ktrg !== 'undefined') {
            ktrg.value = spk_item.ktrg;
        }
        $('#div_ta_ktrg').show();
        $('#div_input_jml').show();
        var btn_submit = document.getElementById('btn_submit');
        btn_submit.textContent = 'KONFIRMASI EDIT';

        document.form_spk_item.action = '/spk/edit_spk_item-db';

        var container_input_hidden = document.getElementById('container_input_hidden');
        container_input_hidden.innerHTML = `
            <input type='hidden' name='spk_id' value=${spk_item.spk_id}>
            <input type='hidden' name='produk_id_old' value=${produk.id}>
            <input type='hidden' name='spk_produk_id' value=${spk_item.id}>
        `;

    }

    pilih_variasi += `
        </select>
    `;

    select_ukuran += `
                </select>
                <span id="close_ukuran" class="ui-icon ui-icon-closethick justify-self-center" onclick='alternate_show(this.id, ${props_alternate_ukuran});'></span>
            </div>
        </div>`;

    select_jht += `
                </select>
                <span id="close_jht" class="ui-icon ui-icon-closethick justify-self-center" onclick='alternate_show(this.id, ${props_alternate_jht});'></span>
            </div>
        </div>`;

    /* PENENTUAN SEMUA INNER HTML */
    document.getElementById("tipe").value = "varia";
    document.getElementById("div_pilih_variasi").innerHTML = pilih_variasi;
    document.getElementById("div_box_ukuran").innerHTML = box_ukuran;
    document.getElementById("div_select_ukuran").innerHTML = select_ukuran;
    document.getElementById("div_box_jht").innerHTML = box_jht;
    document.getElementById("div_select_jht").innerHTML = select_jht;

    const available_options = ["box_jml", "box_jht", "box_ukuran", "box_ktrg"];

    /*
    Jadi nanti ketika habis ketik dan pilih bahan, akan otomatis tampil select: Pilih Variasi dan
    box2 available options juga di show disini. Kalo untuk edit SPK fungsi show nya jadi ga begitu
    berarti, karena memang elemen nya sudah show dari sebelumnya.
    */
    $("#bahan").autocomplete({
        source: bahans,
        select: function(event, ui) {
            // console.log(ui.item);
            $("#bahan_id").val(ui.item.id);
            $("#bahan_harga").val(ui.item.harga);
            $('#div_pilih_variasi').show();
            show_options(available_options);
        }
    });


    function show_options(available_options) {
        // console.log(available_options);

        available_options.forEach(option => {
            document.getElementById(option).style.display = "block";
        });
    }


</script>
