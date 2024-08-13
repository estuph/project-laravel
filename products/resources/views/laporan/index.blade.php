@extends('layouts.master')

@section('title', 'Laporan')

@section('top', 'Generate Laporan')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('laporan.generate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tanggal_awal">Tanggal Awal:</label>
                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_akhir">Tanggal Akhir:</label>
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Generate Laporan</button>
            </form>
        </div>
    </div>
</div>
@endsection
