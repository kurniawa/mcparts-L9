<script>
    const mode = {!! json_encode($mode, JSON_HEX_TAG) !!};
    const tipe = {!! json_encode($tipe, JSON_HEX_TAG) !!};
    const tspjaps = {!! json_encode($tspjaps, JSON_HEX_TAG) !!};


    /*Untuk tspjap ada tambahan variable, yakni d_bahan_a dan d_bahan_b*/
    const d_bahan_a = {!! json_encode($d_bahan_a, JSON_HEX_TAG) !!};
    const d_bahan_b = {!! json_encode($d_bahan_b, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log('tspjaps');
        console.log(tspjaps);
        console.log('d_bahan_a');
        console.log(d_bahan_a);
        console.log('d_bahan_b');
        console.log(d_bahan_b);
    }

    const element_properties = `
        <br>
        Pilih Tipe Bahan:
        <div id='div_pilih_tipe_bahan'>
            <select id='tipe_bahan' name='tipe_bahan' class='form-select' onchange='setAutocomplete_D_Bahan();'>
                <option value='A'>Bahan(A)</option>
                <option value='B'>Bahan(B)</option>
            </select>
        </div>
        <br>
        Pilih Bahan:
        <div id='div_pilih_bahan'>
            <input type='text' id='bahan' name='bahan' class='input-normal' style='border-radius:5px;'>
            <input type='hidden' id='bahan_id' name='bahan_id'>
        </div>
        <br>
        <div>Pilih T.Sixpack/Japstyle:</div>
        <select id='select_tspjap' name='tspjap_id' class='form-select' onchange='assignTspjapIDValue(this.selectedIndex);'></select>
        <input type='hidden' id='tspjap' name='tspjap'>
        <input type='hidden' id='tspjap_harga' name='tspjap_harga'>
        `;

    document.getElementById('container_property_spk_item').innerHTML = element_properties;

    var htmlSelectTspjap = '';
    for (let i = 0; i < tspjaps.length; i++) {
        htmlSelectTspjap += `
            <option value=${tspjaps[i].id}>${tspjaps[i].value}</option>
        `;
    }

    document.getElementById("tipe").value = "tspjap";
    document.getElementById("select_tspjap").innerHTML = htmlSelectTspjap;
    document.getElementById("div_option_jml").innerHTML = box_jml;
    document.getElementById("div_input_jml").innerHTML = input_jml;
    document.getElementById("div_option_ktrg").innerHTML = box_ktrg;
    document.getElementById("div_ta_ktrg").innerHTML = ta_ktrg;

    /*
    Karena ini mode edit, maka kita perlu untuk menentukan value yang sesuai dengan spk_item yang ingin
    diedit. Untuk assign value nya dibantu dengan looping. Looping ini di butuhkan karena sebelumnya
    kita tidak get kombi_id dan harga nya. Lalu fungsi autocompletenya nanti tetap akan berjalan.

    Properti umum yang perlu di assign adalah judul.
    Lalu action dari form yang berkaitan
    Lalu textContent dari button
    */

    /*
    Untuk tspjap, perlu perbandingan assign beberapa value, yakni tipe bahan dari spk_item
    bahan_id dari spk_item
    tspjap_id dari spk_item
    dan properti ini harusnya dapat ditemukan pada produk properties
    */

    var judul = '<h2>';
    if (mode === 'SPK_BARU') {
        assignTspjapIDValue(0);
        judul += 'SPK Baru - ';
    } else if (mode === 'edit') {
        judul += 'Edit SPK Item - ';
        const spk_item = {!! json_encode($spk_item, JSON_HEX_TAG) !!};
        console.log('spk_item');
        console.log(spk_item);
        document.form_spk_item.action = '/spk/edit_spk_item-db';

        const produk = {!! json_encode($produk, JSON_HEX_TAG) !!};
        console.log('produk:');
        console.log(produk);
        const produk_props = JSON.parse(produk.properties);
        console.log('produk_props:');
        console.log(produk_props);

        // Untuk tspjap ini dibandingkan dengan yang ada di properties nya saja.

        /*
        PEMILIHAN TIPE BAHAN
        Untuk menentukan tipe bahan, strateginya adalah memilih select option yang value nya sama dengan
        produk_props.tipe_bahan. Nanti setelah ditemukan option yang mana, maka dapat diperoleh index
        dari option tersebut. Lalu getElementById dari select dan set selectedIndex sama dengan index
        yang tadi sudah diperoleh.
        */
        var selected_tipe_bahan = document.querySelector(`#tipe_bahan option[value=${produk_props.tipe_bahan}]`);
        // console.log('selected_tipe_bahan');
        // console.log(selected_tipe_bahan);

        var index_selected_tipe_bahan = selected_tipe_bahan.index;
        // console.log('index_selected_tipe_bahan:');
        // console.log(index_selected_tipe_bahan);

        document.getElementById('tipe_bahan').selectedIndex = index_selected_tipe_bahan;

        /*
        PEMILIHAN BAHAN
        Pemilihan Bahan dapat dilakukan apabila produk_props.bahan_id dan produk_props.bahan diketahui.
        Strateginya adalah, jika tipe_bahan === A maka kita mencari array dari d_bahan_a. Jika tipe_bahan
        === B maka kita mencari dari d_bahan_b. Lalu kita akan menggunakan fungsi find() untuk mencari
        dari Array.
        */

        if (typeof produk_props.bahan_id !== 'undefined') {
            var bahan_id_selected;
            if (produk_props.tipe_bahan === 'A') {
                bahan_id_selected = d_bahan_a.find( function ({id}) {
                    id === produk_props.bahan_id;
                });
            } else {
                bahan_id_selected = d_bahan_b.find( function ({id}) {
                    id === produk_props.bahan_id;
                });
            }
            console.log('bahan_id_selected');
            console.log(bahan_id_selected);
        }

        /*
        PEMILIHAN JENIS tspjap
        Ikuti petunjuk PEMILIHAN TIPE BAHAN untuk melakukan PEMILIHAN JENIS tspjap ini. Artinya kita
        perlu mengakses kembali produk.props dan ambil value dari tspjap_id.

        Setelah value disamakan, tentunya kita perlu set tspjap dan harganya

        Menentukan harga dari produk.props['tspjap_id']. Dengan diketahuinya tspjap_id maka kita dapat
        mencari pada array tspjaps yang memiliki id yang sesuai.
        */

        var selected_tspjap = document.querySelector(`#select_tspjap option[value="${produk_props.tspjap_id}"]`);
        var index_selected_tspjap = selected_tspjap.index;
        document.getElementById('select_tspjap').selectedIndex = index_selected_tspjap;
        var tspjap_now = tspjaps.find(({ id }) => id === produk_props['tspjap_id']);
        console.log('tspjap_now');
        console.log(tspjap_now);
        document.getElementById('tspjap').value = tspjap_now['label'];
        document.getElementById('tspjap_harga').value = tspjap_now['harga'];
        // for (let i = 0; i < tspjaps.length; i++) {
        //     if (tspjaps[i].id === produk_props.tspjap_id) {
        //         document.getElementById('tspjap').value = produk.nama;
        //         // document.getElementById('tspjap_id').value = tspjaps[i].id;
        //         document.getElementById('tspjap_harga').value = tspjaps[i].harga;
        //     }
        // }

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

        var container_input_hidden = document.getElementById('container_input_hidden');
        container_input_hidden.innerHTML = `
            <input type='hidden' name='spk_id' value=${spk_item.spk_id}>
            <input type='hidden' name='produk_id_old' value=${produk.id}>
            <input type='hidden' name='spk_produk_id' value=${spk_item.id}>
        `;
    }

    judul += 'T. Sixpack / Japstyle</h2>';
    document.getElementById('judul').innerHTML = judul;
    const available_options = ["box_jml", "box_ktrg"];

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
            show_options(available_options);
        }
    });
    }

    /*
    Secara default, select akan terpilih index 0.
    Oleh karena itu di assign terlebih dahulu value2 yang berkaitan dengan index 0 ini.
    */
    function assignTspjapIDValue(selectedIndex) {
        // console.log(selectedIndex);
        document.getElementById('tspjap').value = tspjaps[selectedIndex].value;
        document.getElementById('tspjap_harga').value = tspjaps[selectedIndex].harga;
    }



</script>
