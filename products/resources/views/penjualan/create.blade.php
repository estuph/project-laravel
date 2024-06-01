@extends('layouts.master')

@section('title', 'Tambah Penjualan')

@section('top', 'Tambah Penjualan')

@section('content')
<div class="section-body">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('penjualans.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="product_id">Produk:</label>
                    <select name="product_id" id="product_id" class="form-control" required>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="variant_id">Variant:</label>
                    <select name="variant_id" id="variant_id" class="form-control" required>
                        @foreach($variants as $variant)
                        <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Jumlah:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="price">Harga:</label>
                    <input type="number" name="price" id="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
