<script>
    const d_bahan_a = {!! json_encode($d_bahan_a, JSON_HEX_TAG) !!};
    const d_bahan_b = {!! json_encode($d_bahan_b, JSON_HEX_TAG) !!};
    const tspjaps = {!! json_encode($tspjaps, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log(d_bahan_a);
        console.log(d_bahan_b);
        console.log(tspjaps);
    }

    // const pilih_tspjaps = `
    //     <div>Pilih Sixpack/Japstyle:</div>
    //     <input type="text" id="spjap" name="spjap" class="input-normal" style="border-radius:5px;">
    //     <input type="hidden" id="spjap_id" name="spjap_id">
    //     <input type="hidden" id="spjap_harga" name="spjap_harga">
    // `;

    var htmlSelectTspjap = '';
    for (let i = 0; i < tspjaps.length; i++) {
        htmlSelectTspjap += `
            <option value=${tspjaps[i].id}>${tspjaps[i].value}</option>
        `;

    }

    document.getElementById("tipe").value = "tspjap";
    document.getElementById("div_pilih_tspjap").innerHTML = htmlSelectTspjap;
    document.getElementById("div_option_jml").innerHTML = box_jml;
    document.getElementById("div_input_jml").innerHTML = input_jml;
    document.getElementById("div_option_ktrg").innerHTML = box_ktrg;
    document.getElementById("div_ta_ktrg").innerHTML = ta_ktrg;

    const available_options = ["box_jml", "box_ktrg"];


    // $("#spjap").autocomplete({
    //     source: tspjaps,
    //     select: function(event, ui) {
    //         // console.log(ui.item);
    //         $("#spjap_id").val(ui.item.id);
    //         $("#spjap_harga").val(ui.item.harga);
    //         // show_select_variasi();
    //         // show_options(available_options);
    //     }
    // });

    // Pertama kali page load kan tipe bahan sudah terpilih yang A,
    // jadi input bahan nya langsung di set daftar bahan A
    setAutocomplete_D_Bahan();

    function setAutocomplete_D_Bahan() {
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

    /*
    Secara default, select akan terpilih index 0.
    Oleh karena itu di assign terlebih dahulu value2 yang berkaitan dengan index 0 ini.
    */

    assignTspjapIDValue(0);

    function assignTspjapIDValue(selectedIndex) {
        // console.log(selectedIndex);
        document.getElementById('tspjap').value = tspjaps[selectedIndex].value;
        document.getElementById('tspjap_harga').value = tspjaps[selectedIndex].harga;
    }


</script>
