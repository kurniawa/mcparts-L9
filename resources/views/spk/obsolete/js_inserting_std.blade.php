<script>
    const standars = {!! json_encode($standars, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log(standars);
    }

    // const pilih_standars = `
    //     <div>Pilih Standar:</div>
    //     <input type="text" id="standar" name="standar" class="input-normal" style="border-radius:5px;">
    //     <input type="hidden" id="standar_id" name="standar_id">
    //     <input type="hidden" id="standar_harga" name="standar_harga">
    // `;

    document.getElementById("tipe").value = "std";
    // document.getElementById("div_pilih_standar").innerHTML = pilih_standars;
    document.getElementById("div_option_jml").innerHTML = box_jml;
    document.getElementById("div_input_jml").innerHTML = input_jml;
    document.getElementById("div_option_ktrg").innerHTML = box_ktrg;
    document.getElementById("div_ta_ktrg").innerHTML = ta_ktrg;

    const available_options = ["box_jml", "box_ktrg"];

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


</script>
