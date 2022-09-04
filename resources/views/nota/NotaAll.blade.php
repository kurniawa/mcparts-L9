@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <form action="{{ route('NotaAll_DB') }}" method="POST">
        @csrf
        <div class="alert alert-success mt-2">Semua Item di SPK akan diinput ke Nota Baru atau ke Nota yang sudah ada.</div>
        @if (count($notas)!==0)
        <div class="alert alert-primary">Sudah ada pilihan Nota untuk SPK ini.</div>
        <label for="nota">Pilih Nota:</label>
        <div class="form-check mt-2">
            @foreach ($notas as $nota)
            <input class="form-check-input" type="radio" name="nota_id" id="nota-{{ $nota }}" value="{{ $nota }}">
            <label class="form-check-label" for="nota-{{ $nota }}">Nota-{{ $nota }}</label>
            @endforeach
        </div>
        <input type="hidden" name="mode" value="N-Ava">
        @else
        <div class="alert alert-primary">Belum ada pilihan Nota. Setelah pilih lanjut, akan dibuat Nota baru otomatis.</div>
        @endif

        <div class="text-center mt-3"><a href="{{ route('SPK-Detail',['spk_id'=>$spk_id]) }}" class="btn btn-danger">Batal</a></div>
        <div class="text-center mt-1"><button type="submit" name="spk_id" value="{{ $spk_id }}" class="btn btn-warning">Lanjut</button></div>
    </form>
</div>
@endsection
