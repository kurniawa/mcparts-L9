@extends('layouts.main_layout')
@extends('layouts.navbar')
@section('content')


<div class="container border">
    <div class="text-end mt-1 mb-1">
        <a href="{{ route('SPK_AddItems',['temp_spk_id'=>$temp_spk['id']]) }}" class="btn btn-warning btn-sm fw-bold">+ Tambah Item</a>
    </div>

    <div class="text-center">
        <h2>Surat Perintah Kerja</h2>
    </div>
    <div class="grid-3-25_10_auto m-0_5em grid-row-gap-1em">
        <div>No.</div>
        <div>:</div>
        <div class="divSPKNumber fw-bold">(Auto Generated)</div>
        <div>Tanggal</div>
        <div>:</div>
        <div class="divSPKDate fw-bold">{{ date('d-m-Y',strtotime($temp_spk['created_at'])) }}</div>
        <div>Untuk</div>
        <div>:</div>
        <div class="divSPKCustomer fw-bold">
            @if ($reseller !== null)
            {{ $reseller['nama'] }}:
            @endif
            {{ $pelanggan['nama'] }} - {{ $alamat['short'] }}
        </div>
    </div>
    <div class="grid-1-auto justify-items-right m-0_5em">
        <div>
            <img class="w-1em" src="/img/icons/edit-grey.svg" alt="">
        </div>
    </div>
</div>

<div class="divTitleDesc grid-1-auto justify-items-center mt-0_5em"></div>

@if (session()->has('_success') && session('_success')!=='' && session('_success')!==null)
<div class="container alert alert-success mt-1">
    {{ session('_success') }}
</div>
@endif
@if (session()->has('_warning') && session('_warning')!=='' && session('_warning')!==null)
<div class="container alert alert-warning mt-1">
    {{ session('_warning') }}
</div>
@endif
@if (session()->has('_error') && session('_error')!=='' && session('_error')!==null)
<div class="container alert alert-warning mt-1">
    {{ session('_error') }}
</div>
@endif

<div id="divItemList" class="container border-top mt-3"></div>
{{-- <input id="inputHargaTotalSPK" type="hidden" name="total_harga"> --}}

<div id="divJmlTotal" class="container text-end">
    <div id="divJmlTotal2" class="fw-bold fs-5 text-success"></div>
    <div class="fw-bold color-red">Total</div>
</div>

<div id="divAddItems" class="h-9em position-relative mt-1em">
    <form method="GET" action="/spk/inserting-general" class="text-center productType">
        @csrf
        <input type="hidden" name="spk_id" value=null>
        <input type="hidden" name="mode" value="SPK_BARU">
    </form>

</div>

<div class="container mt-3">
    <form action="{{ route('delete_temp_spk') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Pembuatan SPK ini?');">
        @csrf
        <input type="hidden" name="temp_spk_id" value="{{ $temp_spk['id'] }}">
        <div class="text-center"><button type="submit" class="btn btn-danger" name="batal" value=true>Batal</button></div>
    </form>

    @if (count($temp_spk_produks)!==0)
    <form action="{{ route('ProceedSPK') }}" method="POST" id="containerBeginSPK">
        @csrf
        <input type="hidden" name="temp_spk_id" value="{{ $temp_spk['id'] }}">
        <div class="text-center mt-1">
            <button type="submit" class="btn btn-warning fw-bold">Proses SPK</button>
        </div>
    </form>
    @endif
</div>

<script>
    $('#divJmlTotal').hide();

    var produks = {!! json_encode($produks, JSON_HEX_TAG) !!};
    var temp_spk_produks = {!! json_encode($temp_spk_produks, JSON_HEX_TAG) !!};
    console.log(produks);

    var htmlItemList = '';
    var totalHarga = 0;
    var jumlahTotalItem = 0;
    for (var i = 0; i < produks.length; i++) {
        var keterangan = "";

        if (produks[i].keterangan !== null) {
            keterangan = produks[i].keterangan.replace(new RegExp('\r?\n', 'g'), '<br />');
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
                        ${temp_spk_produks[i].jumlah}
                    </div>
                    <div class='color-grey justify-self-right'>Jumlah</div>
                </div>
                <!--
                    <button type='submit' name='tipe_submit' value='edit' id='btnEditItem-${i}' class='btnEditItem grid-1-auto justify-items-center circle-medium bg-color-purple-blue'><img style='width: 1.3em;' src='/img/icons/pencil2-white.svg'></button>
                -->
                <div class='pl-0_5em color-blue-purple'>${keterangan}</div>
            </form>`;

        // kita jumlah harga semua item untuk satu SPK
        // totalHarga = totalHarga + parseFloat(produks[i].harga_item);
        jumlahTotalItem = jumlahTotalItem + parseFloat(temp_spk_produks[i].jumlah);
    }
    // $('#inputHargaTotalSPK').val(totalHarga);
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
