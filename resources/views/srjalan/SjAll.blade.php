@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <form action="{{ route('SjAll_DB') }}" method="POST">
        @csrf
        <div class="alert alert-success mt-2">Semua Item di SPK akan diinput ke SrJalan Baru atau ke SrJalan yang sudah ada.</div>
        @if (count($srjalans)!==0)
        <div class="alert alert-primary">Sudah ada pilihan SrJalan untuk SPK ini.</div>
        <label for="srjalan">Pilih SrJalan:</label>
        <div class="form-check mt-2">
            @foreach ($srjalans as $srjalan)
            <input class="form-check-input" type="radio" name="srjalan_id" id="sj-{{ $srjalan }}" value="{{ $srjalan }}">
            <label class="form-check-label" for="sj-{{ $srjalan }}">SrJalan-{{ $srjalan }}</label>
            @endforeach
        </div>
        <input type="hidden" name="mode" value="N-Ava">
        @else
        <div class="alert alert-primary">Belum ada pilihan SrJalan. Setelah pilih lanjut, akan dibuat SrJalan baru otomatis.</div>
        @endif

        <div class="text-center mt-3"><a href="{{ route('SPK-Detail',['spk_id'=>$spk_id]) }}" class="btn btn-danger">Batal</a></div>
        <div class="text-center mt-1"><button type="submit" name="spk_id" value="{{ $spk_id }}" class="btn btn-warning">Lanjut</button></div>
    </form>
</div>
@endsection
