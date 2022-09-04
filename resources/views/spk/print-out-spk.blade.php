@extends('layouts.main_layout')

@section('content')

{{-- <div id="containerPrintOutSPK" class="p-0_5em"> --}}

<div id="divTableToPrint" class="row">
    {{-- <div id="divTableToPrint" class="grid-2-auto grid-column-gap-0_5em"> --}}
    @for ($j = 0; $j < 2; $j++)
    <div class="col">
        <table style="width: 100%;">
            <tr>
                <td colspan="3" style="text-align: center;"><span style="font-weight: bold;">SURAT PERINTAH KERJA<br>PENGAMBILAN STOK</span></td>
            </tr>
            <tr>
                <td>NO.</td>
                <td>{{ $spk['id'] }}</td>
                <td rowspan="3" style='text-align:center;'><span style="font-weight:bold;">@if ($j === 0) ASLI @else COPY @endif</span></td>
            </tr>
            <tr>
                <td>TGL.</td>
                <td>{{ date('d-m-Y', strtotime($spk['created_at'])) }}</td>
                {{-- <td></td> --}}
            </tr>
            <tr>
                <td>UTK.</td>
                <td>{{ $pelanggan_nama }}</td>
                {{-- <td></td> --}}
            </tr>
            <tr>
                <th colspan='2' style="text-align: center">ITEM PRODUKSI</th>
                <th style="text-align: center">JUMLAH</th>
            </tr>

            @for ($i = 0; $i < 15; $i++)
            @if ($i < count($spk_produks))
            <tr>
                <td colspan='2'>
                    <div>{{ $produks[$i]['nama'] }}</div>
                    @if ($spk_produks[$i]['ktrg'] !== null)
                    <div style='font-style: italic;color:gray' class="fw-bold">{{ $spk_produks[$i]['ktrg'] }}</div>
                    @endif
                </td>
                <td>{{ $spk_produks[$i]['jumlah'] }}</td>
            </tr>
            @else
            <tr style="height: 1.5em;">
                <td colspan='2'></td>
                <td></td>
            </tr>
            @endif
            @endfor
            <tr>
                <td colspan='2' style='font-weight: bold; text-align: right;'>
                    Total
                    <div style='display: inline-block;width: 0.5em;'></div>
                </td>
                <td style='font-weight: bold;'>{{ $spk['jumlah_total'] }}</td>
            </tr>
        </table>
    </div>
    @endfor
</div>

<br><br>


<div class="text-center" class="no_print">
    <button type="submit" id='goToMainMenu' class="btn btn-warning" onclick="goBack();">Kembali ke SPK</button>
</div>

<style>
    table {
        border-collapse: collapse;
        border: 1px solid black;
    }

    table td {
        border: 1px solid black;
    }

    @media print {
        .no_print {
            display: none;
        }

        .divLogError {
            display: none;
        }

        .divLogWarning {
            display: none;
        }

        .divLogOK {
            display: none;
        }

        #goToMainMenu {
            display: none;
        }

        @page {
            size: A4;
            /* DIN A4 standard, Europe */
            margin: 0 5mm 0 5mm;
            padding-top: 0;
        }

        html,
        body {
            width: 210mm;
            /* height: 297mm; */
            height: 282mm;
            /* font-size: 11px; */
            background: #FFF;
            overflow: visible;
        }

        body {
            padding-top: 0mm;
        }
    }
</style>

@endsection

