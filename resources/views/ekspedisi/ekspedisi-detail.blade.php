@extends('layouts.main_layout')

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

<div id="areaClosingDotMenu" onclick="closingDotMenuContent();"></div>

<div class="grid-2-10_auto mt-1em ml-1em">
    <div>
        <img class="w-2em" src="/img/icons/truck.svg">
    </div>
    <h2>Detail Ekspedisi:</h2>
</div>
<div style="text-align: center"><h1 id="nama_ekspedisi"></h1></div>
<div class="ml-1em mr-1em">

    <div class="grid-2-15-auto grid-row-gap-0_5em">
        <img class="w-2_5em" src="/img/icons/address.svg" alt="">
        <div id="alamatEkspedisi"></div>
        <div><img class="w-2_5em" src="/img/icons/call.svg" alt=""></div>
        <div id="kontakEkspedisi"></div>
        <span>Ktrg.:</span>
        <textarea class="form-control" readonly>{{ $ekspedisi['ktrg'] }}</textarea>
        <img class="w-2_5em" src="/img/icons/boy.svg" alt="">
        <div class="font-weight-bold">Daftar Pelanggan dengan Ekspedisi ini:</div>
        <img class="w-2_5em" src="/img/icons/letter.svg" alt="">
        <div class="font-weight-bold">Daftar Surat Jalan dengan Ekspedisi ini:</div>
    </div>
</div>

<style>
    #showDotMenuContent {
        display: none;
        top: 3em;
        right: 1.5em;
        border: 1px solid #E4E4E4;
    }

    .dotMenuItem:hover {
        background-color: grey;
    }
</style>

<script>
    const ekspedisi = {!! json_encode($ekspedisi, JSON_HEX_TAG) !!};
    const my_csrf = {!! json_encode($csrf, JSON_HEX_TAG) !!};
    const arr_alamat_eks = JSON.parse(ekspedisi.alamat);

    console.log('ekspedisi');
    console.log(ekspedisi);
    console.log('arr_alamat_eks');
    console.log(arr_alamat_eks);

    var nama_ekspedisi = ekspedisi.nama;
    if (ekspedisi.bentuk !== null) {
        nama_ekspedisi = `${ekspedisi.bentuk}. ${ekspedisi.nama}`;
    }
    document.getElementById('nama_ekspedisi').textContent = nama_ekspedisi;

    var htmlAlamatEkspedisi = "";
    arr_alamat_eks.forEach(alamat_eks => {
        htmlAlamatEkspedisi += `${alamat_eks}<br>`;
    });

    document.getElementById('alamatEkspedisi').innerHTML = htmlAlamatEkspedisi;
    document.getElementById('kontakEkspedisi').textContent = ekspedisi.no_kontak;

    // $id = <-?php echo $id ?>;

    // $(document).ready(function() {
    //     $.ajax({
    //         url: "05-02-get-ekspedisi.php",
    //         type: "POST",
    //         async: false,
    //         data: {
    //             id: $id
    //         },
    //         success: function(responseText) {
    //             console.log(responseText);
    //             $ekspedisi = JSON.parse(responseText);
    //             console.log($ekspedisi);
    //             $bentukEkspedisi = $ekspedisi[0].bentuk;
    //             $namaEkspedisi = $ekspedisi[0].nama;
    //             $alamatEkspedisi = $ekspedisi[0].alamat;
    //             $alamatEkspedisiBr = $ekspedisi[0].alamat.replace(new RegExp('\r?\n', 'g'), '<br />');
    //             $kontakEkspedisi = $ekspedisi[0].kontak;
    //             $keterangan = $ekspedisi[0].keterangan;
    //             console.log($alamatEkspedisi);
    //             console.log($alamatEkspedisi.replace(new RegExp('\r?\n', 'g'), '<br />'));
    //             $("#bentukPerusahaan").html($bentukEkspedisi);
    //             $("#namaEkspedisi").html($namaEkspedisi);
    //             $("#alamatEkspedisi").html($alamatEkspedisiBr);
    //             $("#kontakEkspedisi").html($kontakEkspedisi);
    //         }
    //     });
    // });

    function showMenu() {
        $("#showDotMenuContent").toggle(200);
        $("#areaClosingDotMenu").css("display", "block");

    }

    function closingDotMenuContent() {
        $("#showDotMenuContent").toggle();
        $("#areaClosingDotMenu").css("display", "none");

    }

    // function moveToEditEkspedisi() {
    //     $("#pageDetailEkspedisi").toggle(1000);
    //     $("#pageEditEkspedisi").toggle(1000);
    //     $("#showDotMenuContent").toggle();
    //     $("#areaClosingDotMenu").toggle();
    //     history.pushState(null, null, "./edit-ekspedisi");
    // }

    // function backToEkspedisi() {
    //     window.location.replace("05-01-ekspedisi.php");
    // }

    document.getElementById("konfirmasiHapusEkspedisi").addEventListener("click", function() {
        var deleteProperties = {
            title: "Yakin ingin menghapus Ekspedisi ini?",
            yes: "Ya",
            no: "Batal",
            table: "ekspedisis",
            column: "id",
            columnValue: ekspedisi.id,
            action: "/ekspedisi/hapus",
            csrf: my_csrf,
            goBackNumber: -2,
            goBackStatement: "Daftar Ekspedisi"
        };

        var deletePropertiesStringified = JSON.stringify(deleteProperties);
        showLightBoxGlobal(deletePropertiesStringified);
    });
</script>

@endsection
