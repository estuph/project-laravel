@extends('layouts.master')

@section('title', 'Edit Penjualan')

@section('top', 'Edit Penjualan')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Form Edit Penjualan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('penjualans.update', $penjualan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Produk</label>
                    <select name="product_id" class="form-control" required>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $penjualan->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Variant</label>
                    <select name="variant_id" class="form-control" required>
                        @foreach($variants as $variant)
                        <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $penjualan->tanggal }}" required>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $penjualan->quantity }}" required>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="price" step="0.01" class="form-control" value="{{ $penjualan->price }}" required>
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <input type="number" name="total" step="0.01" class="form-control" value="{{ $penjualan->total }}" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('penjualans.index') }}" class="btn btn-dark">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection


