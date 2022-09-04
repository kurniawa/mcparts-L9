@extends('layouts.main_layout')

@section('content')


<div class="alert {{ $class_div_pesan_db }}" role="alert">{{ $main_log }}</div>

@if (isset($error_logs) && count($error_logs) !== 0)
<div class="alert alert-danger" role="alert">
@foreach ($error_logs as $error_message)
    {{ $error_message }}<br>
@endforeach
</div>
@endif

@if (isset($success_logs) && count($success_logs) !== 0)
<div class="alert alert-success" role="alert">
@foreach ($success_logs as $success_message)
    {{ $success_message }}<br>
@endforeach
</div>
@endif

<div class="mt-2em text-center">
    <button id='backToSPK' class="btn-1 d-inline-block bg-color-orange-1" onclick="windowHistoryGo({{ $go_back_number }});">Kembali</button>
</div>

<script>
    // Metode reload page dengan javascript untuk nantinya pada saat pindah halaman
    sessionStorage.setItem("reload_page", true);
    reloadable_page = false; // reloadable_page di set sebagai false, supaya halaman ini jangan di reload. Fokus reload adalah untuk halaman setelah kembali.
 </script>
@endsection

{{-- <div class="threeDotMenu" style="z-index:200">
    <div class="threeDot">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
    <div class="divThreeDotMenuContent">
        <form action="/spk/edit-kop-spk" method="GET">
            <input type="hidden" name="spk_id" value={{ $spk['id'] }}>
            <button type="submit" class="threeDotMenuItem" style="width: 100%">
                <img src="/img/icons/edit.svg" alt=""><span>Edit Kop SPK</span>
            </button>
        </form>
        <form action="/spk/print-out-spk" method='POST'>
            @csrf
            <button id="downloadExcel" type="submit" class="threeDotMenuItem" style="width: 100%">
                <img src="/img/icons/download.svg" alt=""><span>Print Out SPK</span>
            </button>
            <input type="hidden" name="spk_id" value={{ $spk['id'] }}>
        </form>
        <form action="/spk/hapus-spk" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus SPK ini?');">
            @csrf
            <input type="hidden" name="spk_id" value={{ $spk['id'] }}>
            <button type="submit" class="threeDotMenuItem" style="width:100%">
                <img src="/img/icons/trash-can.svg" alt=""><span>Cancel/Hapus SPK</span>
            </button>
        </form>
        <form action="/spk/tetapkan-item-selesai" method="GET">
            <input type="hidden" name="spk_id" value={{ $spk['id'] }}>
            <button type="submit" class="threeDotMenuItem" style="width: 100%">
                <img src="/img/icons/edit.svg" alt=""><span>Tetapkan Item Selesai</span>
            </button>
        </form>
    </div>
</div> --}}
