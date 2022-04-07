<script>
    const mode = {!! json_encode($mode, JSON_HEX_TAG) !!};
    const tipe = {!! json_encode($tipe, JSON_HEX_TAG) !!};
    const stikers = {!! json_encode($stikers, JSON_HEX_TAG) !!};
    const att_stiker = {!! json_encode($att_stiker, JSON_HEX_TAG) !!};
    console.log(stikers);

    document.getElementById('container_property_spk_item').innerHTML = '<div id="div_pilih_stiker"></div>';

    const element_properties = `
    <br>
    Pilih Stiker:
    <div id='div_input_stiker'>
    <input type='text' id='stiker' name='stiker' class='input-normal' style='border-radius:5px;'>
    <input type='hidden' id='stiker_id' name='stiker_id'>
    <input type='hidden' id='stiker_harga' name='stiker_harga'>
    </div>
    `;

    document.getElementById("tipe").value = "stiker";
    document.getElementById('div_pilih_stiker').innerHTML = element_properties;
    document.getElementById("div_option_jml").innerHTML = box_jml;
    document.getElementById("div_input_jml").innerHTML = input_jml;
    document.getElementById("div_option_ktrg").innerHTML = box_ktrg;
    document.getElementById("div_ta_ktrg").innerHTML = ta_ktrg;

    var judul = '<h2>';
    if (mode === 'SPK_BARU') {
        judul += 'SPK Baru - ';
    } else if (mode === 'edit') {
        judul += 'Edit SPK Item - ';

        const spk_item = {!! json_encode($spk_item, JSON_HEX_TAG) !!};
        console.log('spk_item');
        console.log(spk_item);
        const produk = {!! json_encode($produk, JSON_HEX_TAG) !!};
        console.log('produk');
        console.log(produk);
        const produk_props = JSON.parse(produk.properties);
        console.log('produk_props');
        console.log(produk_props);

        for (let i = 0; i < stikers.length; i++) {
            if (stikers[i].id === produk_props.stiker_id) {
                document.getElementById('stiker').value = stikers[i].label;
                document.getElementById('stiker_id').value = stikers[i].id; 
                document.getElementById('stiker_harga').value = stikers[i].harga;
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
    judul += 'Stiker</h2>';

    document.getElementById('judul').innerHTML = judul;

    const available_options = ["box_jml", "box_ktrg"];

    $("#stiker").autocomplete({
        source: stikers,
        select: function(event, ui) {
            // console.log(ui.item);
            $("#stiker_id").val(ui.item.id);
            $("#stiker_harga").val(ui.item.harga);
            // show_select_variasi();
            show_options(available_options);
        }
    });


</script>
