@extends('layouts.main_layout')
@extends('layouts.navbar')
@section('content')

<form action="03-03-01-spk-selesai.php" method="POST" id="containerBeginSPK" class="m-0_5rem">

    <div class="b-1px-solid-grey">
        <div class="text-center">
            <h2>Surat Perintah Kerja</h2>
        </div>
        <div class="grid-3-25_10_auto m-0_5rem grid-row-gap-1rem">
            <div>No.</div>
            <div>:</div>
            <div id="divSPKNumber" style="font-weight: bold;">{{ $spk['no_spk'] }}</div>
            <div>Tanggal</div>
            <div>:</div>
            <div id="divTglPembuatan" style="font-weight: bold;">{{ date('d-m-Y', strtotime($spk['created_at'])) }}</div>
            <div>Tgl. Selesai</div>
            <div>:</div>
            <div style="font-weight: bold;">@if ($spk['finished_at']!==null){{ date('d-m-Y', strtotime($spk['finished_at'])) }}@endif</div>
            <div>Untuk</div>
            <div>:</div>
            @if ($reseller!==null)
            <div id="divSPKCustomer" style="font-weight: bold;">{{ $reseller['nama'] }}: {{ $pelanggan['nama'] }}-{{ $alamat['short'] }}</div>
            @else
            <div id="divSPKCustomer" style="font-weight: bold;">{{ $pelanggan['nama'] }}-{{ $alamat['short'] }}</div>
            @endif
            <input id="inputIDCustomer" type="hidden" name="inputIDCustomer">
        </div>
    </div>

</form>

<div class="container mt-3">
    <table style="width: 100%" class="">
        <tr><th>Item</th><th>Jml</th><th>Sls</th><th>N</th><th>Sr</th><th></th></tr>
        @for ($i = 0; $i < count($spk_produks); $i++)
        <tr>
            <td class="pt-2 pb-2">
                <div>{{ $produks[$i]['nama'] }}</div>
                <div style="color:gray">{{ $spk_produks[$i]['ktrg'] }}</div>
            </td>
            <td>{{ $spk_produks[$i]['jumlah'] }}@if ($spk_produks[$i]['deviasi_jml']!==0)
            @if ($spk_produks[$i]['deviasi_jml']>0)<span style="color:darkgreen">+{{ $spk_produks[$i]['deviasi_jml'] }}</span>
            @else<span style="color:darkred">{{ $spk_produks[$i]['deviasi_jml'] }} @endif @endif</td>
            <td style="color: blue">{{ $spk_produks[$i]['jml_selesai'] }}</td>
            <td style="color: darkorange">{{ $spk_produks[$i]['jml_sdh_nota'] }}</td>
            <td style="color:darkmagenta">{{ $spk_produks[$i]['jumlah_sudah_srjalan'] }}</td>
            <td id='divDropdownIcon-{{ $i }}' onclick='showDropdown({{ $i }});' class="text-center"><img class='w-0_7rem' src='{{ asset('img/icons/dropdown.svg') }}'></td>
        </tr>
        <tr class="border-bottom" id='divDetailDropdown-{{ $i }}' style="display: none">
            <td colspan="6">
                <table style="width: 100%">
                    <tr><td class="text-end">
                        <a class="btn btn-dd btn-sm me-1" href="{{ route('Deviasi',['tipe'=>'keterangan','spk_produk_id'=>$spk_produks[$i]['id']]) }}" >Ket</a>
                        <a class="btn btn-warning btn-sm me-1" href="{{ route('Deviasi',['tipe'=>'deviasi','spk_produk_id'=>$spk_produks[$i]['id']]) }}" >+/-</a>
                        <a class="btn btn-primary btn-sm me-1" href="{{ route('Deviasi',['tipe'=>'jumlah','spk_produk_id'=>$spk_produks[$i]['id']]) }}" >Jml</a>
                        <a class="btn btn-info btn-sm me-1" href="{{ route('Deviasi',['tipe'=>'selesai','spk_produk_id'=>$spk_produks[$i]['id']]) }}" >Sls</a>
                        <a class="btn btn-success btn-sm me-1" href="{{ route('Tree',['spk_produk_id'=>$spk_produks[$i]['id']]) }}" >Tree</a>
                        {{-- <a class="btn btn-info btn-sm me-1" href="{{ route('NotaItemBaru',['spk_id'=>$spk['id'],'spk_produk_id'=>$spk_produks[$i]['id']]) }}" >N+</a>
                        <a class="btn btn-success btn-sm me-1" href="{{ route('NotaItemAva',['spk_id'=>$spk['id'],'spk_produk_id'=>$spk_produks[$i]['id']]) }}" >N</a>
                        <a class="btn btn-dark btn-sm me-1" href="{{ route('SjItemBaru',['spk_id'=>$spk['id'],'spk_produk_id'=>$spk_produks[$i]['id']]) }}" >Sj+</a>
                        <a class="btn btn-secondary btn-sm me-1" href="{{ route('SjItemAva',['spk_id'=>$spk['id'],'spk_produk_id'=>$spk_produks[$i]['id']]) }}" >Sj</a> --}}
                        <form action="{{ route('hapusItemSPK') }}" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                        @csrf
                        <button type="submit" name="spk_produk_id" value="{{ $spk_produks[$i]['id'] }}" class="btn btn-danger btn-sm" >Del</button>
                        </form>
                    </td></tr>
                </table>
            </td>
        </tr>
        @endfor
    </table>
</div>

<div class="container text-end mt-2">
    <div style="font-weight:bold;color:green;font-size:2rem;">{{ $spk['jumlah_total'] }}</div>
    <div class="font-weight-bold color-red font-size-1_5rem">Total</div>
</div>



<script>
</script>

<style>

</style>
@endsection

