@extends('layouts/main_layout')

@section('content')

<div class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
</div>

<div class="threeDotMenu" style="z-index: 200">
    <div class="threeDot">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
    <div class="divThreeDotMenuContent">
        <div class="threeDotMenuItem" onclick="moveToPageEditCustomer();">
            <img class="w-1em" src="/img/icons/edit.svg" alt="">
            <div class="">Edit Informasi Pelanggan</div>
        </div>
        <div class="threeDotMenuItem" onclick="toTambahEkspedisi();">
            <img class="w-1em" src="/img/icons/edit.svg" alt="">
            <div class="">Tambah Ekspedisi</div>
        </div>
        <div class="threeDotMenuItem" onclick="moveToEditReseller();">
            <img class="w-1em" src="/img/icons/edit.svg" alt="">
            <div class="">Tetapkan Reseller</div>
        </div>
        <form action="/sj/sj-printOut" method='POST'>
            <button id="downloadExcel" type="submit" class="threeDotMenuItem">
                <img src="/img/icons/download.svg" alt=""><span>Print Out Surat Jalan</span>
            </button>
            @csrf
        </form>
        <div id="konfirmasiHapusPelanggan" class="threeDotMenuItem">
            <img src="/img/icons/trash-can.svg" alt=""><span>Hapus Pelanggan</span>
        </div>
    </div>
</div>

<div id="areaClosingDotMenu" onclick="closingDotMenuContent();"></div>

<div class="ml-1em mr-0_5em mt-0_5em">
    <div class="grid-1-auto justify-items-center">
        <div id="customerAbbr" class="circle-medium bg-color-soft-red grid-1-auto font-weight-bold justify-items-center">{{ $pelanggan['initial'] }}</div>
        <h2 id="customerName" class="">Nama Customer</h2>
    </div>
</div>

<!-- INFO PELANGGAN DAN EKSPEDISI -->
<div class="grid-2-50_50 grid-row-gap-0_5em grid-column-gap-0_5em ml-0_5em mr-0_5em">

    <div class="b-1px-solid-grey">

        <div class="h-10em">
            <div class="grid-1-auto justify-items-center">
                <img class="w-2_5em" src="/img/icons/address.svg" alt="">
            </div>
            <div id="customerInfo" class="mt-0_5em font-size-0_9em font-weight-bold">Alamat Customer</div>
        </div>

    </div>

</div>
<!-- END - INFO PELANGGAN DAN EKSPEDISI -->

<div id="divReseller"></div>

<!-- DAFTAR PRODUK CUSTOMER INI -->
<div class="ml-0_5em mr-0_5em mt-1em">

    <div class="grid-2-10_auto grid-row-gap-0_5em">
        <img class="w-2_5em" src="/img/icons/shopping-cart.svg" alt="">
        <div style="font-weight:bold;">Daftar Produk Orderan Pelanggan ini:</div>
    </div>
</div>
<!-- END - DAFTAR PRODUK CUSTOMER INI -->

<div id="containerOrderanPelanggan" class="m-1em"></div>
</div>

<script>
// const show_console = true;

var pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
var pelanggan_ekspedisis = {!! json_encode($pelanggan_ekspedisis, JSON_HEX_TAG) !!};
var ekspedisis = {!! json_encode($ekspedisis, JSON_HEX_TAG) !!};
const my_csrf = {!! json_encode($csrf, JSON_HEX_TAG) !!}

if (show_console) {
    console.log("pelanggan");
    console.log(pelanggan);
    console.log("pelanggan_ekspedisis");
    console.log(pelanggan_ekspedisis);
    console.log("ekspedisis");
    console.log(ekspedisis);
}



</script>

@endsection
