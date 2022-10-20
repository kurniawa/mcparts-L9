@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container mt-2">
    <div class="d-flex align-items-center">
        <img class="w-2_5rem" src="{{ asset('img/icons/pencil.svg') }}">
        <span class="fs-2 ms-2">Edit Ekspedisi Sr. Jalan: {{ $srjalan['no_srjalan'] }}</span>
    </div>
    <table class="mt-2">
        <tr><th>Pelanggan</th><th>:</th><th>{{ $pelanggan['nama'] }}</th></tr>
        @if ($reseller !== null)
        <tr><td></td><td></td><td><span style="font-weight: bold">{{ $reseller['nama'] }}</span> sebagai Reseller untuk Nota ini</td></tr>
        @endif
        <tr><th>Tanggal</th><th>:</th><td>{{ date('d-m-Y', strtotime($srjalan['created_at'])) }}</td></tr>
    </table>
    <br>
    <table>
        <tr>
            <td>Ekspedisi Normal(terpilih)</td><td>:</td>
            <td>
                @if ($ekspedisi_chosen!==null)
                {{ $ekspedisi_chosen['nama'] }}
                @else
                -
                @endif
            </td>
        </tr>
        <tr>
            <td>Ekspedisi Transit(terpilih)</td><td>:</td>
            @if ($transit_chosen==null)
            <td>-</td>
            @else
            <td>{{ $transit_chosen['nama'] }}</td>
            @endif
        </tr>
    </table>
    <br>

    <form action="{{ route('sjEditEkspedisiDB') }}" method="POST">
        @csrf
        <div class="row border rounded p-3 border-2">
            {{-- Ekspedisi Normal --}}
            <h4>Pilih Ekspedisi yang tersedia untuk Pelanggan ini:</h4>
            <div class="col">
                <h5 class="mt-3">Ekspedisi Normal</h5>
                <div>
                    <input type="radio" name="ekspedisi_normal_id" id="ekspedisi_normal_id_none" value="none">
                    <label for="ekspedisi_normal_id_none">None</label>
                </div>
                @for ($i = 0; $i < count($ekspedisi_normals); $i++)
                <div>
                    <input type="radio" name="ekspedisi_normal_id" id="ekspedisi_normal_id_{{ $i }}" value={{ $ekspedisi_normals[$i]['id'] }}>
                    <label for="ekspedisi_normal_id_{{ $i }}">{{ $ekspedisi_normals[$i]['nama'] }}</label>
                </div>
                @endfor
            </div>

            {{-- Ekspedisi Transit --}}

            <div class="col">
                <h5 class="mt-3">Ekspedisi Transit</h5>
                <div>
                    <input type="radio" name="ekspedisi_transit_id" id="ekspedisi_transit_id_none" value="none">
                    <label for="ekspedisi_transit_id_none">None</label>
                </div>
                @for ($i = 0; $i < count($ekspedisi_transits); $i++)
                <div>
                    <input type="radio" name="ekspedisi_transit_id" id="ekspedisi_transit_id_{{ $i }}" value={{ $ekspedisi_transits[$i]['id'] }}>
                    <label for="ekspedisi_transit_id_{{ $i }}">{{ $ekspedisi_transits[$i]['nama'] }}</label>
                </div>
                @endfor
            </div>

            <input type="hidden" name="srjalan_id" value="{{ $srjalan['id'] }}">
            <div class="text-center mt-3">
                <button class="btn btn-warning">Konfirmasi</button>
            </div>
        </div>
    </form>
</div>

<div style="height: 10rem"></div>

<style>

</style>

<script>

</script>

@endsection
