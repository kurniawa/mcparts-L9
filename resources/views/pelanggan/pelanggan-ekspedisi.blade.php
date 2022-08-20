@extends('layouts/main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8rem ml-1_5rem" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div>
        <h2 style="color: white">Pelanggan: Relasi Dengan Ekspedisi</h2>
    </div>
</header>

<div id="" class="m-3">
    <h5>Relasi Pelanggan: {{ $pelanggan['nama'] }} dengan Ekspedisi</h5>
</div>

<div id="divEkspedisi" class="m-3"></div>
<form action="/pelanggan/tambah-ekspedisi-db" method="POST" class="m-3">
    @csrf
    <div style="font-weight:bold">Tambah Ekspedisi:</div>
    <div style="max-width: 10rem;display:inline-block;">
        <label for="tipe_ekspedisi">Tipe:</label>
        <select name="tipe_ekspedisi" id="tipe_ekspedisi">
            <option value="UTAMA">UTAMA</option>
            <option value="CADANGAN">CADANGAN</option>
            <option value="TRANSIT">TRANSIT</option>
        </select>
    </div>
    <div style="display:inline-block; max-width:70%">
        <label for="ipt_pilih_ekspedisi">Pilih Ekspedisi:</label>
        <input name="ekspedisi_nama" id="ipt_pilih_ekspedisi" type="text" class="form-control @error('ekspedisi_nama') is-invalid @enderror" >
        @error('ekspedisi_nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    {{-- <input name="pulau" id="pulau" class="form-control" type="text" placeholder="Pulau"> --}}
    <input id="ipt_id_ekspedisi_terpilih" type="hidden" name="ekspedisi_id">
    <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
    <br><br>

    <div>
        <button type="submit" class="h-4em bg-color-orange-2 w-100 grid-1-auto">
            <span class="justify-self-center font-weight-bold">Konfirmasi</span>
        </button>
    </div>
</form>

<script>
    const pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
    const ekspedisis = {!! json_encode($ekspedisis, JSON_HEX_TAG) !!};
    const pelanggan_ekspedisis = {!! json_encode($pelanggan_ekspedisis, JSON_HEX_TAG) !!};
    const label_ekspedisis = {!! json_encode($label_ekspedisis, JSON_HEX_TAG) !!};
    const my_csrf = {!! json_encode($csrf, JSON_HEX_TAG) !!};

    // const list_of_pulaus = {-!! json_encode($list_of_pulaus, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log('pelanggan');console.log(pelanggan);
        console.log('ekspedisis');console.log(ekspedisis);
        console.log('pelanggan_ekspedisis');console.log(pelanggan_ekspedisis);
        console.log('ekspedisis.length');console.log(ekspedisis.length);
        console.log('label_ekspedisis');console.log(label_ekspedisis);
        // console.log('list_of_pulaus');console.log(list_of_pulaus);
    }

    var html_ekspedisi = 'Pelanggan ini belum memiliki Ekspedisi.';

    if (ekspedisis.length !== 0) {
        html_ekspedisi = `
            <span style="font-weight: bold">Pelanggan ini sudah memiliki Ekspedisi, yakni:</span>
        `;
        // console.log("cust_id");
        // console.log(cust_id);

        html_ekspedisi += '<table style="width:100%">';
        i_ekspedisi=0;
        ekspedisis.forEach(ekspedisi => {
            var html_alamat_ekspedisi = '';
            var arr_alamat_ekspedisi = JSON.parse(ekspedisi.alamat);
            arr_alamat_ekspedisi.forEach(baris_alamat_ekspedisi => {
                html_alamat_ekspedisi += baris_alamat_ekspedisi + '<br>';
            });

            var html_ekspedisi_dropdown = `
            <div id="dd-${i_ekspedisi}" class='border p-2' style='display:none'>
                <table style='width:100%'>
                    <tr><td style='padding:1rem'><img src='/img/icons/address.svg' style='width:2em'></td><td>${html_alamat_ekspedisi}</td></tr>
                    <tr>
                        <td style='padding:1rem'><img src='/img/icons/call.svg' style='width:2em'></td><td>${ekspedisi.no_kontak}</td>
                        <td style='text-align:right'>
                            <form action='/ekspedisi/detail' method='GET' style='display:inline-block'>
                                <input type='hidden' name='ekspedisi_id' value='${ekspedisi.id}'>
                                <button type='submit' class='btn btn-warning'>Detail</button>
                            </form>
                            <form action='/pelanggan/hapus-relasi-ekspedisi' method='POST' style='display:inline-block' onsubmit='return confirm("Anda yakin ingin menghapus ekspedisi ${ekspedisi.nama}? (${ekspedisi.nama} nantinya tidak lagi menjadi ekspedisi dari ${pelanggan.nama}!)")'>
                                <input type='hidden' name='_token' value='${my_csrf}'>
                                <input type='hidden' name='pelanggan_id' value='${pelanggan.id}'>
                                <input type='hidden' name='ekspedisi_id' value='${ekspedisi.id}'>
                                <button type='submit' class='btn btn-danger'>Hapus</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            `;

            html_ekspedisi += `
            <tr><td style="text-align:center"><img src="/img/icons/truck.svg" style="width:2rem"></td><td>${ekspedisi.nama}</td><td>tipe: ${pelanggan_ekspedisis[i_ekspedisi].tipe}</td><td id='dd-icon-${i_ekspedisi}' style="text-align:center" onclick="showDD('#dd-${i_ekspedisi}', '#dd-icon-${i_ekspedisi}');"><img src="/img/icons/dropdown.svg" style="width:1em"></td></tr>
            <tr><td colspan='4'>${html_ekspedisi_dropdown}</td></tr>
            `;
            i_ekspedisi++;
        });
        html_ekspedisi += `</table>`;

    }
    $('#divEkspedisi').html(html_ekspedisi);

    $('#ipt_pilih_ekspedisi').autocomplete({
        source: label_ekspedisis,
        select: function (event, ui) {
            if (show_console) {
                console.log(ui.item);
            }
            $('#ipt_id_ekspedisi_terpilih').val(ui.item.id);
        }
    });

    // $("#pulau").autocomplete({
    //     source: list_of_pulaus,
    //     select: function(event, ui) {
    //         if (show_console) {
    //             console.log(ui.item);
    //         }
    //         $("#pulau_id").val(ui.item.id);
    //         autcompleteIptDaerah();
    //     }
    // });


</script>
@endsection
