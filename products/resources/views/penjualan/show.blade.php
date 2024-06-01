@extends('layouts.master')

@section('title', 'Detail Penjualan')

@section('top', 'Detail Penjualan')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label>Tanggal</label>
                <p>{{ $penjualan->tanggal }}</p>
            </div>
            <div class="form-group">
                <label>Nama Produk</label>
                <p>{{ $penjualan->product->name }}</p>
            </div>
            <div class="form-group">
                <label>Varian Produk</label>
                <p>{{ $penjualan->variant->name ?? '-' }}</p>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <p>{{ $penjualan->quantity }}</p>
            </div>
            <div class="form-group">
                <label>Total</label>
                <p>Rp{{number_format($penjualan->total, 0, ',', '.')  }}</p>
            </div>
            <a href="{{ route('penjualans.index') }}" class="btn btn-dark justify-content-md-end">Back</a>
        </div>
    </div>
</div>
@endsection