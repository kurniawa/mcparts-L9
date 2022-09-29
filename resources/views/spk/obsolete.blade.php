@extends('layouts/main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8rem ml-1_5rem" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div class="justify-self-right pr-0_5em">
        <a href="{{ route('SPKBaru-AddItem') }}" class="btn btn-warning btn-sm fw-bold">+ Tambah Item</a>
    </div>
</header>

<div class="threeDotMenu" style="z-index: 200">
    <div class="threeDot">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
    <div class="divThreeDotMenuContent">
        {{-- <form method='post' action="nota/nota-editNota" id="" class="threeDotMenuItem">
            <img src="/img/icons/edit.svg" alt=""><span>Edit Nota</span>
        </form> --}}
        <!-- <div id="downloadExcel" class="threeDotMenuItem" onclick="goToPrintOutSPK();">
            <img src="img/icons/download.svg" alt=""><span>Download Excel</span>
        </div> -->
        <form action="/ekspedisi/edit" method='GET'>
            <button id="" type="submit" class="threeDotMenuItem">
                <img src="/img/icons/edit.svg" alt=""><span>Edit Ekspedisi</span>
            </button>
            <input type="hidden" name="ekspedisi_id" value={{ $ekspedisi['id'] }}>
        </form>
        {{-- <form action="/nota/nota-hapus" method='POST'>
            @csrf
            <button id="hapusNota" type="submit" class="threeDotMenuItem" id="konfirmasiHapusEkspedisi" style="width: 100%">
                <img src="/img/icons/trash-can.svg" alt=""><span>Hapus Nota</span>
            </button>
            <input type="hidden" name="nota_id" value={{ $nota['id'] }}>
        </form> --}}
        <div id="konfirmasiHapusEkspedisi" class="threeDotMenuItem">
            <img src="/img/icons/trash-can.svg" alt=""><span>Hapus Ekspedisi</span>
        </div>
        <!-- <div id="deleteSPK" class="threeDotMenuItem" onclick="goToDeleteSPK();">
            <img src="img/icons/trash-can.svg" alt=""><span>Cancel/Hapus SPK</span>
        </div> -->
    </div>
</div>

<script>
    $('#divJmlTotal').hide();
    // getSPKItems();

    var spk_items = {!! json_encode($spk_items, JSON_HEX_TAG) !!};
    var produks = {!! json_encode($produks, JSON_HEX_TAG) !!};

    if (show_console === true) {
        console.log('spk_items');
        console.log(spk_items);
    }

    var htmlItemList = '';
    var totalHarga = 0;
    var jumlahTotalItem = 0;
    for (var i = 0; i < spk_items.length; i++) {
        var keterangan = "";

        if (spk_items[i].keterangan !== null) {
            keterangan = spk_items[i].keterangan.replace(new RegExp('\r?\n', 'g'), '<br />');
        }
        htmlItemList = htmlItemList +
            `<form method='POST' action='/spk/spkBaru-spkItem-editDelete' class='divItem grid-3-auto_auto_10 pt-0_5em pb-0_5em bb-1px-solid-grey'>
                @csrf
                <input type='hidden' name='spk_item_id' value=${produks[i].id}>
                <div class='divItemName grid-2-15_auto'>
                    <button type='submit' name='tipe_submit' value='hapus' id='btnRemoveItem-${i}' class='btnRemoveItem grid-1-auto justify-items-center circle-medium bg-color-soft-red');'><img style='width: 1.3em;' src='/img/icons/minus-white.svg'></button>
                    ${produks[i].nama}
                </div>
                <div class='grid-1-auto'>
                    <div class='color-green justify-self-right font-size-1_2em fw-bold'>
                        ${spk_items[i].jumlah}
                    </div>
                    <div class='color-grey justify-self-right'>Jumlah</div>
                </div>
                <!--
                    <button type='submit' name='tipe_submit' value='edit' id='btnEditItem-${i}' class='btnEditItem grid-1-auto justify-items-center circle-medium bg-color-purple-blue'><img style='width: 1.3em;' src='/img/icons/pencil2-white.svg'></button>
                -->
                <div class='pl-0_5em color-blue-purple'>${keterangan}</div>
            </form>`;

        // kita jumlah harga semua item untuk satu SPK
        totalHarga = totalHarga + parseFloat(spk_items[i].harga_item);
        jumlahTotalItem = jumlahTotalItem + parseFloat(spk_items[i].jumlah);
    }
    $('#inputHargaTotalSPK').val(totalHarga);
    if (jumlahTotalItem !== 0) {
        $('#divJmlTotal2').html(jumlahTotalItem);
        $('#divJmlTotal').show();
    }
    $('#divItemList').html(htmlItemList);
    $('#btnProsesSPK').show();

    function showEditOptItemSPK(params) {
        $('.divItem').removeClass('grid-2-auto').addClass('grid-3-auto_auto_10');
        $('.divItemName').addClass('grid-2-15_auto');
        $('.btnRemoveItem').show();
        $('.btnEditItem').show();
        $('#divBtnShowEditOptItemSPK').hide();
        $('#divBtnHideEditOptItemSPK').show();
    }

    function hideEditOptItemSPK() {
        $('.divItem').removeClass('grid-3-auto_auto_10').addClass('grid-2-auto');
        $('.divItemName').removeClass('grid-2-15_auto');
        $('.btnRemoveItem').hide();
        $('.btnEditItem').hide();
        $('#divBtnShowEditOptItemSPK').show();
        $('#divBtnHideEditOptItemSPK').hide();
    }

    hideEditOptItemSPK();

    // function editSPKItem(id, tipe) {
    //     console.log(id);
    //     console.log(tipe);

    //     if (tipe === 'sj-varia') {
    //         console.log(tipe);
    //         location.href = '03-03-02-editVariaFNewSPK.php?id=' + id + '&table=' + 'spk_item';
    //     } else if (tipe === 'sj-kombi') {
    //         console.log(tipe);
    //         location.href = '03-03-03-editKombiFNewSPK.php?id=' + id + '&table=' + 'spk_item';
    //     } else if (tipe === 'sj-std') {
    //         console.log(tipe);
    //         location.href = '03-03-04-editStdFNewSPK.php?id=' + id + '&table=' + 'spk_item';
    //     } else if (tipe === "tankpad") {
    //         console.log(tipe);
    //         location.href = '03-03-05-editTPFNewSPK.php?id=' + id + '&table=' + 'spk_item';
    //     } else {
    //         console.log(tipe);
    //         location.href = '03-03-06-editBusaStangFNewSPK.php?id=' + id + '&table=' + 'spk_item';
    //     }
    // }

    // function removeSPKItem(id) {
    //     location.href = `03-03-07-remove-item-spk.php?id=${id}`;
    // }

    $(document).ready(function() {
        // $(".productType").css("display", "none");
        $("#containerSJVaria").css("display", "none");
    });

    function toggleProductType() {
        $(".productType").toggle(500);
    }

    function toggleSJVaria() {
        history.pushState({
            page: 'SJVaria'
        }, 'test title');
        $(".productType").hide();
        $("#containerSJVaria").toggle();
        $("#containerBeginSPK").toggle();
    }
</script>
<style>
    .closingGreyArea {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: black;
        opacity: 0.2;
    }

    .lightBox {
        position: absolute;
        top: 25vh;
        left: 0.5em;
        right: 0.5em;
        height: 13em;
        background-color: white;
        padding: 1em;
    }
</style>
@endsection
