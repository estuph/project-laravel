@extends('layouts.master')

@section('title', 'Edit Pengeluaran')

@section('top', 'Edit Pengeluaran')

@section('content')
<div class="container">
    <form action="{{ route('pengeluarans.update', $pengeluaran->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $pengeluaran->tanggal }}" required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $pengeluaran->keterangan }}" required>
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah:</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $pengeluaran->jumlah }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{route('pengeluarans.index')}}" class="btn btn-dark">Back</a>
    </form>
</div>
@endsection
