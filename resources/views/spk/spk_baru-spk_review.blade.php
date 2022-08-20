@extends('layouts/main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8rem ml-1_5rem" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div class="justify-self-right pr-0_5em">
        <!-- <a href="06-02-produk-baru.php" id="btnNewProduct" class="btn-atas-kanan2">
            + Tambah Produk Baru
        </a> -->
    </div>
</header>

<div class="b-1px-solid-grey">
    <div class="text-center">
        <h2>Surat Perintah Kerja</h2>
    </div>
    <div class="grid-3-25_10_auto m-0_5em grid-row-gap-1em">
        <div>No.</div>
        <div>:</div>
        <div class="divSPKNumber fw-bold">(Auto Generated)</div>
        <div>Tanggal</div>
        <div>:</div>
        <div class="divSPKDate fw-bold">{{ $tanggal }}</div>
        <div>Untuk</div>
        <div>:</div>
        <div class="divSPKCustomer fw-bold">
            @if ($reseller !== null)
            {{ $reseller['nama'] }}:
            @endif
            {{ $pelanggan['nama'] }} - {{ $daerah['nama'] }}
        </div>
    </div>
    <div class="grid-1-auto justify-items-right m-0_5em">
        <div>
            <img class="w-1em" src="/img/icons/edit-grey.svg" alt="">
        </div>
    </div>
</div>

<div class="divTitleDesc grid-1-auto justify-items-center mt-0_5em"></div>


<div id="divItemList" class="bt-1px-solid-grey"></div>
{{-- <input id="inputHargaTotalSPK" type="hidden" name="total_harga"> --}}

<div id="divJmlTotal" class="text-right">
    <div id="divJmlTotal2" class="fw-bold fs-5 text-success"></div>
    <div class="fw-bold color-red">Total</div>
</div>

<div id="divAddItems" class="h-9em position-relative mt-1em">
    <form method="GET" action="/spk/inserting-general" class="text-center productType">
        @csrf
        <input type="hidden" name="spk_id" value=null>
        <input type="hidden" name="mode" value="SPK_BARU">
        {{-- <button type="submit" name="tipe" value="varia" class="fw-bold position-absolute top-0 left-50 transform-translate--50_0 circle-L bg-color-orange-1 grid-1-auto justify-items-center">SJ<br>Varia</button>
        <button type="submit" name="tipe" value="kombinasi" class="fw-bold position-absolute top-1em left-35 transform-translate--50_0 circle-L bg-color-orange-1 grid-1-auto justify-items-center">Kombi<br>Motif</button>
        <button type="submit" name="tipe" value="standar" class="fw-bold position-absolute top-1em left-65 transform-translate--50_0 circle-L bg-color-orange-1 grid-1-auto justify-items-center">SJ<br>Std</button>
        <button type="submit" name="tipe" value="tankpad" class="fw-bold position-absolute top-5em left-30 transform-translate--50_0 circle-L bg-color-soft-red grid-1-auto justify-items-center">TP</button>
        <button type="submit" name="tipe" value="busastang" class="fw-bold position-absolute top-5em left-70 transform-translate--50_0 circle-L bg-color-grey grid-1-auto justify-items-center">Busa<br>Stang</button>
        <button type="submit" name="tipe" value="tspjap" class="fw-bold position-absolute transform-translate--50_0 circle-L bg-color-grey grid-1-auto justify-items-center" style="top:10em;left:30%">T.SP<br>Jap</button>
        <button type="submit" name="tipe" value="stiker" class="fw-bold position-absolute transform-translate--50_0 circle-L bg-color-grey grid-1-auto justify-items-center" style="top:10em;left:70%">Stiker</button> --}}
        {{-- <button type="submit" name="tipe" value="motif" class="fw-bold position-absolute transform-translate--50_0 circle-L bg-color-grey grid-1-auto justify-items-center" style="top:15em;left:35%">Motif</button> --}}

        <div style="height:100vh"></div>
        <button type="submit" class="position-absolute top-5em left-50 transform-translate--50_0 circle-medium bg-color-orange-2 grid-1-auto justify-items-center">
            <span class="color-white font-weight-bold font-size-1_5em">+</span>
        </button>

    </form>

</div>

<!-- EDIT ITEM SPK -->
<div id="divBtnShowEditOptItemSPK" class="text-center">
    <div class="d-inline-block btn-1 bg-color-purple-blue fw-bold color-white" onclick="showEditOptItemSPK();">Edit Item</div>
</div>
<div id="divBtnHideEditOptItemSPK" class="text-center">
    <div class="d-inline-block btn-1 fw-bold color-white" style="background-color: gray;" onclick="hideEditOptItemSPK();">Finish Editing</div>
</div>
<!-- END - EDIT ITEM SPK -->
{{-- INPUT HIDDEN YANG NANTI NYA DI KIRIM VIA POST --}}

<form action="/spk/proceed-spk" method="POST" id="containerBeginSPK" class="m-0_5em">
@csrf
    <input id="inputIDCustomer" type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
    <input type="hidden" name="reseller_id" value="{{ $reseller_id }}">
    <input type="hidden" name="tgl_pembuatan" value="{{ $tanggal }}">
    <input type="hidden" name="judul" value="{{ $judul }}">
    <input type="hidden" name="submit_type" value="proceed_spk">

    <div class="position-fixed bottom-0_5em w-calc-100-1em">
        <button type="submit" id="btnProsesSPK" class="w-100 h-4em bg-color-orange-2 grid-1-auto">
            <span class="justify-self-center font-weight-900">PROSES SPK</span>
        </button>
    </div>
</form>

{{-- <div class="divLogError"></div>
<div class="divLogWarning"></div>
<div class="divLogOK"></div>
<div class="h-4em"></div> --}}

<script>
    $('#btnProsesSPK').hide();
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

        if (spk_items[i].ktrg !== null) {
            keterangan = spk_items[i].ktrg.replace(new RegExp('\r?\n', 'g'), '<br />');
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
@endsection
