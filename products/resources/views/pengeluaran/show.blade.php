@extends('layouts.master')

@section('title' , 'Detail Pengeluaran')
@section('top' , 'Detail Pengeluaran')

@section('content')
<div class="container">
    <div class="form-group">
        <label for="created_at">Tanggal:</label>
        <p>{{ $pengeluaran->tanggal }}</p>
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan:</label>
        <p>{{ $pengeluaran->keterangan }}</p>
    </div>
    <div class="form-group">
        <label for="jumlah">Jumlah:</label>
        <p>Rp{{number_format($pengeluaran->jumlah, 0, ',', '.')  }}</p>
    </div>
    <a href="{{ route('pengeluarans.index') }}" class="btn btn-dark">Back</a>
</div>
@endsection
