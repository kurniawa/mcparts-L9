@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="d-flex mt-2">
        <img class="w-2rem" src="{{ asset('img/icons/pencil.svg') }}" alt="">
        <h2 class="ms-2">Edit Nama Item Nota {{ $nota['no_nota'] }}</h2>
    </div>

    <table class="mt-2">
        <tr><th>Pelanggan</th><th>:</th><th>{{ $pelanggan['nama'] }}</th></tr>
        @if ($reseller !== null)
        <tr><td></td><td></td><td><span style="font-weight: bold">{{ $reseller['nama'] }}</span> sebagai Reseller untuk Nota ini</td></tr>
        @endif
        <tr><th>Tanggal Nota</th><th>:</th><td>{{ date('d-m-Y', strtotime($nota['created_at'])) }}</td></tr>
        <tr><th>Nama Item Nota (asli)</th><th>:</th><td>{{ $produk['nama_nota'] }}</td></tr>
        <tr><th>Nama Item Nota (khusus pelanggan ini)</th><th>:</th><td>{{ $namanota_khusus_pelanggan }}</td></tr>
        <tr><th>Nama Item Nota (saat ini)</th><th>:</th><td>{{ $namanota_now }}</td></tr>
    </table>
    <br>

    {{-- UBAH Nama Berdasarkan Histori --}}
    <form action="{{ route('pilih_nama_nota_item') }}" method="POST" class="border border-primary rounded border-2 p-2" onsubmit="return formValidation1()";>
        <h4>Ubah Nama Dari Pilihan Yang Tersedia</h4>
        <div class="row">
            <div class="col border-end border-success border-2 p-2">
                <h5>Nama Item Nota (asli)</h5>
                <table>
                    <tr><th>Nama</th><th></th></tr>
                    <tr>
                        <td>{{ $produk['nama_nota'] }}</td>
                        <td>
                            <input type="radio" class="pilih_nama" name="data_nama" id="" value='{"table":"produks","nama":"{{ $produk['nama_nota'] }}"}'>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <h5>Nama Khusus Pelanggan</h5>
                <table>
                    <tr><th>Tgl.</th><th>Nama</th><th></th></tr>
                    @foreach ($pelanggan_namaproduks as $pelanggan_namaproduk)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($pelanggan_namaproduk['created_at'])) }}</td>
                        <td>{{ $pelanggan_namaproduk['nama_nota'] }}</td>
                        <td>
                            <input type="radio" class="pilih_nama" name="data_nama" id="" value='{"id":{{ $pelanggan_namaproduk["id"] }},"table":"pelanggan_namaproduks","nama":"{{ $pelanggan_namaproduk["nama_nota"] }}"}'>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="invalid-feedback" id="inv-pilih-nama"></div>

        <div class="text-center mt-2">
            <input type='hidden' name='nota_id' value={{ $nota['id'] }}>
            <input type='hidden' name='spk_produk_nota_id' value={{ $spk_produk_nota['id'] }}>
            <input type='hidden' name='spk_produk_id' value={{ $spk_produk['id'] }}>
            <input type='hidden' name='produk_id' value={{ $produk['id'] }}>
            <input type='hidden' name='jumlah_selesai' value={{ $spk_produk['jml_selesai'] }}>
            <input type='hidden' name='pelanggan_id' value={{ $pelanggan['id'] }}>
            <input type='hidden' name='reseller_id' value={{ $reseller_id }}>
            <button type="submit" class="btn btn-warning">Konfirmasi Ubah Nama</button>
        </div>
        @csrf
    </form>

    {{-- Input Nama Baru --}}
    <form class="border border-success rounded border-2 p-2" action="{{ route('input_nama_nota_item') }}" method="POST" onsubmit="return validateNama();">
        @csrf
        <h4>Input Nama Nota Item</h4>
        <table>
            <tr>
                <td>Nama Nota Item</td><td>:</td>
                <td>
                    <input id="nama_baru" type='text' name='nama_baru' class="form-control" required>
                    <div class="invalid-feedback" id="invalid-feedback-nama-baru"></div>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="alert alert-primary">Nama ini akan ditetapkan menjadi "Nama Khusus" untuk pelanggan ini.</td>
            </tr>
            <tr>
                <td>
                    <input type='hidden' name='nota_id' value={{ $nota['id'] }}>
                    <input type='hidden' name='spk_produk_nota_id' value={{ $spk_produk_nota['id'] }}>
                    <input type='hidden' name='spk_produk_id' value={{ $spk_produk['id'] }}>
                    <input type='hidden' name='produk_id' value={{ $produk['id'] }}>
                    <input type='hidden' name='jumlah_selesai' value={{ $spk_produk['jml_selesai'] }}>
                    <input type='hidden' name='pelanggan_id' value={{ $pelanggan['id'] }}>
                    <input type='hidden' name='reseller_id' value={{ $reseller_id }}>
                </td>
            </tr>
        </table>
        <div class="text-center">
            <button class="btn btn-warning" type="submit">Konfirmasi Ubah Nama</button>
        </div>
    </form>
</div>

<script>

function formValidation1() {
    var pilih_namas=document.querySelectorAll(".pilih_nama");
    var ada_terpilih='no';
    pilih_namas.forEach(pilih_nama => {
        if (pilih_nama.checked===true) {
            ada_terpilih='yes';
        }
    });

    if (ada_terpilih==='no') {
        document.getElementById('inv-pilih-nama').textContent='Salah satu nya harus dipilih terlebih dahulu!';
        $('#inv-pilih-nama').show();
        return false;
    } else {
        return true;
    }
    return false;
}

function validateNama() {
    var nama_baru=document.getElementById("nama_baru").value.trim();
    console.log(nama_baru);
    if (nama_baru==='') {
        return false;
    } else {
        return true;
    }
    return false;
}
</script>

<style>
    th,td{
        padding-right: 1rem;
    }
</style>
@endsection
