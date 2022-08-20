@extends('layouts/main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8rem ml-1_5rem" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
</header>

<div class="m-0_5em">

    <div>
        <h2>Pilihan SPK Berdasarkan Pelanggan</h2>
    </div>
    @if (count($av_spks) === 0)
    <div class="alert alert-primary">
        Belum ada pilihan SPK atau Item dari SPK yang tersedia untuk dibuatkan Nota nya!
    </div>
    @endif

    <div id="divTitleDesc" class="grid-1-auto justify-items-center mt-0_5em"></div>

    <input id="inputHargaTotalSPK" type="hidden">

</div>
<div id="divItemList2" class="p-1em">
    <form action="/nota/tambah-item-pilih-item" method="GET">
        <input type="hidden" name="reseller_id" value={{ $reseller_id }}>
        <input type="hidden" name="nota_id" value={{ $nota_id }}>
        <table style="width:100%;" id="tableItemList">
            @for ($i = 0 ; $i < count($av_spks) ; $i++)
            <tr>
                <td class='p-2'>
                    <input type='checkbox' name='' value='' class='cbox' id="cbox-{{ $i }}">
                    <input type="hidden" name="spk_id[]" value={{ $av_spks[$i]['id'] }} class='cbox-data-{{ $i }}'>
                </td>
                <td class='p-2'>{{ $av_spks[$i]['no_spk'] }}, {{ $nama_spks[$i] }}</td>
                <td class='p-2'>Jumlah.T: {{ $av_spks[$i]['jumlah_total'] }}</td>
                <td class='p-2 dd-toggle' id='dd-toggle-{{ $i }}'><img class='w-0_7em' src='/img/icons/dropdown.svg'></td>
            </tr>
            <tr id='dd-{{ $i }}' class="dd">
                <td colspan=4>
                    <table style='width:100%'>
                        <tr><th>Nama</th><th>Jml.</th></tr>
                        @for ($j = 0 ; $j < count($arr_spk_produks[$i]) ; $j++)
                        <tr>
                        <td>{{ $arr_produks[$i][$j]['nama_nota'] }}</td>
                        <td>{{ $arr_spk_produks[$i][$j]['jumlah'] }}</td>
                        </tr>
                        @endfor
                    </table>
                </td>
            </tr>
            @endfor
        </table>

        <div id="divMarginBottom" style="height: 20vh;"></div>

        <button id="btnKonfirmasi" type="submit" class="btn-warning-full" style="display:">Lanjut</button>
    </form>
</div>

<div id="divMarginBottom" style="height: 20vh;"></div>

<script>
    const pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
    const daerah = {!! json_encode($daerah, JSON_HEX_TAG) !!};
    const reseller = {!! json_encode($reseller, JSON_HEX_TAG) !!};
    const av_spks = {!! json_encode($av_spks, JSON_HEX_TAG) !!};
    const arr_spk_produks = {!! json_encode($arr_spk_produks, JSON_HEX_TAG) !!};
    const arr_produks = {!! json_encode($arr_produks, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log('pelanggan');console.log(pelanggan);
        console.log('reseller');console.log(reseller);
        console.log('av_spks');console.log(av_spks);
        console.log('arr_spk_produks');console.log(arr_spk_produks);
        console.log('arr_produks');console.log(arr_produks);
    }

    var cbox = document.querySelectorAll('.cbox');
    if (cbox.length !== null) {
        for (let i = 0; i < cbox.length; i++) {
            let a_cbox = document.getElementById(`cbox-${i}`); // mesti pake let supaya bisa bind, jadi tidak kehilangan fungsi eventHandler nya
            let cbox_data = document.querySelectorAll(`.cbox-data-${i}`);
            // if (show_console) {
            //     console.log(`cbox-${i}`);console.log(a_cbox);
            //     console.log(`.cbox-data-${i}`);console.log(cbox_data);
            // }
            // SET AS DISABLED
            cbox_data.forEach(data => {
                data.disabled = true;
            });
            a_cbox.addEventListener('click', function () {
                console.log('clicked');
                if (a_cbox.checked === true) {
                    cbox_data.forEach(data => {
                        data.disabled = false;
                    });
                } else {
                    cbox_data.forEach(data => {
                        data.disabled = true;
                    });
                }
            });
        }
    }
    var dd_length = document.querySelectorAll('.dd-toggle').length;
    if (dd_length !== 0) {
        for (let i = 0; i < dd_length; i++) {
            $dd_toggle = $(`#dd-toggle-${i}`);
            $dd = $(`#dd-${i}`);
            // SET DISPLAY NONE
            $dd.hide();
            $dd_toggle.click(function () {
                if ($dd.css('display') === 'none') {
                    $dd.show(300);
                    $(`#dd-toggle-${i} img`).attr("src", "/img/icons/dropup.svg");
                } else {
                    $dd.hide(300);
                    $(`#dd-toggle-${i} img`).attr("src", "/img/icons/dropdown.svg");
                }
            });
        }

    }

    // Menentukan head dari table
    var htmlCusts = ``;
    var date_today = getDateToday();

    function showBtnKonfirmasi(i, j) {
        // console.log(i,j);
        var jumlah_checked = 0;
        var c_boxes = document.querySelectorAll(`.c-boxPNota-${i}`);
        var ipt_hiddens = document.querySelectorAll(`.iptHidden-${i}${j}`);
        // console.log(ipt_hiddens);
        // var ipt_hidden2 = document.querySelectorAll(`.${ipt_hidden_class2}`);
        // console.log(c_boxes)
        var ipt_hidden_all = document.querySelectorAll('.iptHidden');

        ipt_hidden_all.forEach(ipt_hidden => {
            ipt_hidden.disabled = true;
        });

        for (let k = 0; k < c_boxes.length; k++) {
            // console.log(c_boxes[k]);
            if (c_boxes[k].checked === true) {
                // console.log(ipt_hiddens);
                document.querySelector(`.iptHidden_notaID-${i}${k}`).disabled = false;
                document.querySelector(`.iptHidden_resellerID-${i}${k}`).disabled = false;
                jumlah_checked++;
            }
        }


        if (jumlah_checked > 0) {
            document.getElementById("btnKonfirmasi").style.display = "block";
        } else {
            document.getElementById("btnKonfirmasi").style.display = "none";
        }
    }

</script>

@endsection
