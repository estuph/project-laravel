@extends('layouts.master')

@section('title', 'Detail Pembelian')

@section('top', 'Detail Pembelian')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Detail Pembelian</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Nama Supplier</label>
                <p>{{ $pembelian->supplier->name }}</p>
            </div>
            <div class="form-group">
                <label>Nama Produk</label>
                <p>{{ $pembelian->product->name }}</p>
            </div>
            <div class="form-group">
                <label>Varian Produk</label>
                <p>{{ $pembelian->variant->name ?? '-' }}</p>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <p>{{ $pembelian->quantity }}</p>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <p>Rp{{ number_format($pembelian->price, 0, ',', '.')  }}</p>
            </div>
            <div class="form-group">
                <label>Total</label>
                <p>Rp{{ number_format($pembelian->total, 0, ',', '.')  }}</p>
            </div>
            <a href="{{ route('pembelians.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
@endsection

